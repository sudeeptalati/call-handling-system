<?php

class DefaultController extends Controller
{
	public function filters()
	{
		return array(
		'accessControl', // perform access control for CRUD operations
		);
	}
 
	public function accessRules()
	{
		return array(
		
		array('allow', // allow authenticated user to perform 'create' and 'update' actions
		'actions'=>array('paidcustomer'),
		'users'=>array('@'),
		),
		array('allow', // allow admin user to perform 'admin' and 'delete' actions
		'actions'=>array('index','getcustomdaysdata','getexpirydate','servercode_simple_for_json'),
		'users'=>array('admin'),
		),
		array('deny',  // deny all users
		'users'=>array('*'),
		),
		);
	}//end of access rules
	
	
	
	public function actionServercode_simple_for_json()
	{
	//echo "*********** *****";
	if(isset($_POST['key']))
	{

	$k = $_POST['key'];
	//////////////////////////
	///Call the URL http://127.0.0.1/purva/test/modulemanagement/checkstatus.php?key=55555
	
	
	
	$request='http://127.0.0.1/purva/test/modulemanagement/checkstatus.php?key='.$k;
	//$request='http://127.0.0.1/purva/test/modulemanagement/testjson-after.json';
	
	$curl=Graph::model()->curl_file_get_contents($request);
	$s=json_decode($curl,true);
    //echo $curl;
	
	
	//echo $s['result']['key'];
	//echo $s['result'];
	
	///Read the JSON & get the values
	$url = 	Yii::getPathOfAlias('application.modules.graph.components');	
	$file= $url.'\graph.json';
		
	Graph::model()->file_put_contents_deep($file,$s); 

	$this->redirect(array('default/index'));


	//////////////////////////


	//$e=Graph::model()->loadjson();
	//$e['key']=$k;
	//$s=json_encode($e);
	//echo $s;

	}
	
	//$this->render('servercode_simple_for_json');
	
	}
	
	
	
	public function actionPaidcustomer()
	{
		//echo "*********** *****";
		$this->render('paidcustomer');
	}
	
	
	public function actionIndex()
	{	
	
		$this->redirect(array('default/getexpirydate'));
			
	 
	}
	
	
	public function actionGetCustomDaysData()
	{
		//$data=CHtml::listData(Servicecall::model()->findAll(array('condition'=>'fault_date>=1404165600', 'order'=>"`fault_date` ASC")), 'id', 'fault_date');
		$start_date=$_GET['start_date'];
		$end_date=$_GET['end_date'];
		$weekdays=$_GET['weekdays'];
		$month_names = array(	"1"=>"January", 
								"2"=>"February",
								"3"=>"March",
								"4"=>"April",
								"5"=>"May",
								"6"=>"June",
								"7"=>"July",
								"8"=>"August",
								"9"=>"September",
								"10"=>"October",
								"11"=>"November",
								"12"=>"December"
							);
		
		$start_date_explode = explode("-", $start_date);
		$start_date=$start_date_explode[0].'-'.$month_names[$start_date_explode[1]].'-'.$start_date_explode[2];
		$end_date_explode = explode("-", $end_date);
		$end_date=$end_date_explode[0].'-'.$month_names[$end_date_explode[1]].'-'.$end_date_explode[2];
		
		/*
		echo '<br> STRAT DATE'.$start_date;
		echo '<br> END DATE'.$end_date;
		echo '<hr>';
		*/
		
		
		$start_date_time_format = new DateTime($start_date);
		$end_date_time_format = new DateTime($end_date);
		$interval = date_diff($start_date_time_format,$end_date_time_format);
		//$interval->format('%R%a days');
		$days_difference=$interval->format('%R%a');
	
		//echo "<br>".$days_difference;

		$show_days=array('0','1','2','3','4','5','6'); ///0 (for Sunday) through 6 (for Saturday)
	
		//$show_days=array('1','2','3','4','5'); ///0 (for Sunday) through 6 (for Saturday)
		$show_days=str_split($weekdays);

	
		$today=date('d-M-Y');
		$today_time=strtotime($today);
		
		$graph_data=array();
 
		if ($days_difference<60)
		{
			for ($i=0;$i<=$days_difference;$i++)
			{
			$d = strtotime(date("d-M-Y", strtotime($end_date)) . " -".$i." day");
			
			
			$weekday = date('w', $d);
			if (in_array($weekday, $show_days)) {
					
					$label_date=date('l d-M-Y',$d);
					$no_of_calls= Servicecall::model()->countByAttributes(array('fault_date'=>$d));
					$graph_data[$label_date]=$no_of_calls;
				}			
			}//end of for
		}///end of if $days_difference
		else
		{
		
			$months = date_diff(new DateTime($start_date),new DateTime($end_date));
			$count_month=(int) abs(($months->format('%R%a'))/30);
			//echo (int) abs(($months->format('%R%a'))/30);
				
			
			$forloop_month=date('n',strtotime($start_date));
			$forloop_year=date('Y',strtotime($start_date));
 
		
/*		
			echo $start_date;
			echo '<br> FOr LOOOP MOnth'.$forloop_month;
			echo '<br> FOr LOOOP Year'.$forloop_year;
*/		
		////First create an array of Start date of month and end date of month of 12 Months
			//for ($i=0;$i<12;$i++)///initialization for loop
			
							////if month $startdate == $month of enddate
			$sd_month=date('n',strtotime($start_date));
			$ed_month=date('n',strtotime($end_date));
			$ed_year=date('Y',strtotime($end_date));
				
			$exit=false;
			
			$i=0;
			while($exit==false)
			{
				if ($i==0)
				{
					$sd=$start_date;
				}else
				{
					$sd='01-'.$month_names[$forloop_month].'-'.$forloop_year;
				}

				if ($ed_month===date('n',strtotime($sd)) && $ed_year===date('Y',strtotime($sd)))
				{
					$ed=$end_date;
					$exit=true;
				}else
				{
					$ed=date('t-F-Y',strtotime($sd));//t gives no of days in a month
				}
				
				/*
				echo '<hr>'.$sd;
				echo '- '.$ed;
				*/
				$sd=strtotime($sd);
				$ed=strtotime($ed);
				
				$criteria=new CDbCriteria();
				$criteria->select="fault_date";
				$criteria->addBetweenCondition('fault_date', $sd, $ed);
				$no_of_calls=Servicecall::model()->count($criteria);
				
				$label_date=date('M-Y',$sd);
				//echo '<br> '.$label_date.':	'.$no_of_calls;
				
				$graph_data[$label_date]=$no_of_calls;
			
			
			
				
				$forloop_month=$forloop_month+1;
				
				if ($forloop_month>12)
				{
					$forloop_month='1';
					$forloop_year=$forloop_year+1;
				}
				
				$i++;
				
			}///end of initialization for loop 
			
			
		}
		
		///print_r($graph_data);
		echo json_encode($graph_data);

	}///end of actiongetcustomdaysdata
	
	public function actionGetExpiryDate()
	{
	
		Graph::model()->loadjson();
	
		$json_a=Graph::model()->loadjson();
		$encryption_key=$json_a['key'];
		//echo $json_a['exp_date_e'];
		$encrypted_string=$json_a['eed'];
		/*echo "<hr>";
		echo "<hr>";
		*/
		$e=Graph::model()->encrypt('31-December-2014', '12345');
		//echo $e;
		
		
		$d=Graph::model()->decrypt($encrypted_string, $encryption_key);
		
		$l=strlen($encryption_key);
		
		$d=substr($d,0,-$l);
		//echo '<br>'.$d;
		//echo '<br>'.date('d-M-Y',$d);
		
		$dd_time=$d;
	
		$t=date('d-M-Y');
		$t_time=strtotime($t);
		
		//echo '<br> Today time'.$t_time;
		//echo '<br> DECRYPETD time'.$dd_time;
	
		if ($json_a['ed']==null || $dd_time<$t_time)
		{
			$this->redirect(array('default/paidcustomer'));
		}
		else
		{
			$this->render('index');
		}
	
	}////end of GetExpiryDate
	
	
 }////end of class

?>