<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
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
		
		
		/*
			$d1 = new DateTime($start_date);
			$d2 = new DateTime($end_date);
			$months = date_diff($d1,$d2);
			$count_month=(int) abs(($months->format('%R%a'))/30);
			//echo (int) abs(($months->format('%R%a'))/30);
			
			
			///First find the no of months
			
			$month_start_day_arr=array();
			$month_end_day_arr=array();
			//find the start date from the given values  for the first time

			$forloop_month=date('m',strtotime($start_date));
				
			for ($i=0;$i<$count_month;$i++)
			{	
				$forloop_month=$forloop_month+$i;
					
				if ($i==0)
				{
					$sd=date('d-m-Y',strtotime($start_date));
				}else
				{	
					$sd='01-'.$forloop_month.'-2014';
				}
				
				if ($i==date('m',strtotime($end_date)))
				{
					$ed=date('m-t-Y',strtotime($sd));
				}else{
				
					$ed=date('m-t-Y',strtotime($sd));
				}
				
				echo '<br> Start Date:	'.$sd;
				echo '------ End Date:	'.$ed;
				
				
			
				//array_push($sd,$month_start_day_arr);
				//array_push($ed,$month_end_day_arr);
				
			
			}
			// Find the End date of that month
			
			
			
			for ($i=1;$i<=$count_month;$i++)
			{
			
				$start_date=strtotime('01-'.$i.'-2014');
				$end_date=strtotime('30-'.$i.'-2014');
				
				
				
				//echo '<br>'.$start_date;
				
				//$no_of_calls= Servicecall::model()->countByAttributes(array('fault_date'=>$start_date));
				
				
				$criteria=new CDbCriteria();
				$criteria->select="fault_date";
				$criteria->addBetweenCondition('fault_date', $start_date, $end_date);
				
				
				$no_of_calls=Servicecall::model()->count($criteria);
				
				//echo '<hr>'.$no_of_calls;
				$label_date=date('M-Y',$start_date);
				$graph_data[$label_date]=$no_of_calls;
				
							
			}//end of for
			
		}//end of else
		
		*/
		
		///print_r($graph_data);
		echo json_encode($graph_data);
		 
		 

	}///end of actionGetLast7DaysData
	
	
 }////end of class

?>