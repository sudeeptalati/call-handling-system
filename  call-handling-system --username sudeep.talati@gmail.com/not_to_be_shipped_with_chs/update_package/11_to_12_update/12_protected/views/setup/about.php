


<div id="sidemenu">
<?php include ('setup_sidemenu.php');?>
</div>









<?php 
	
$setupModel = Setup::model()->findByPk(1);
$update_url_from_db = $setupModel->version_update_url;
$request = $update_url_from_db.'/latest_callhandling_version.txt';
//echo $request;
//$request='http://www.rapportsoftware.co.uk/versions/rapport_callhandling.txt';	
$available_version = curl_file_get_contents($request, true);
$current_version=Yii::app()->params['software_version'];
?>

<!--<script type="text/javascript">-->
<!--function my_code()-->
<!--{-->
<!--	//alert("UPDATE");-->
<!--	i=0;-->
	
		<?php 
//			$i=0;
//			for ($i=0;$i<=100;$i++)
//			{
//		
//				$this->widget('zii.widgets.jui.CJuiProgressBar', array(
//					    'id'=>'progress',
//					    'value'=>$i,
//					    'htmlOptions'=>array(
//					        'style'=>'width:200px; height:20px; float:left;'
//					    ),
//					    ));
//			}
		?>
<!--}//end of function.-->
<!---->
<!--</script>-->
           
<table style="width:80%;">
<tr>
	<td style="vertical-align:top;"><h4>Version</h4></td>
	<td style="vertical-align :top;">
		<table style='width:50%'>
			<tr>
				<td>
					Your Software Version:
				</td>
				<td>
					<?php echo Yii::app()->params['software_version'];?>
				</td>
			</tr>
			<tr>
				<td>
					Latest Available Version:
				</td>
				<td>
					<?php echo $available_version ;?>
					<?php
						if($available_version!=$current_version)
						{
							$step = 1;
							//echo "Please delete all contents of update directory";
							echo CHtml::button('Update',array('submit'=>'index.php?r=setup/showUpdateProgress&curr_step='.$step));
							//echo CHtml::button('Update',array($this->showUpdateProgress($step)));
							//echo CHtml::button('Update',array('submit'=>$configModel->showProgress($step)));
						}
					?>
				</td>
			</tr>
		</table>
	</td>
</tr>

<tr>
	<td style="vertical-align:top;"><h4>Support</h4></td>
	<td style="vertical-align :top;"><a href="http://www.rapportsoftware.co.uk/index.php/support" target="_blank" >Online</a> support desk and knowledgebase</td>
</tr>

<tr>
	<td style="vertical-align:top;"><h4>Tutorials</h4></td>
	<td style="vertical-align :top;"><a href="http://www.rapportsoftware.co.uk/index.php/instructions" target="_blank" >Help tutorials</a>  on installation and use.</td>
</tr>
<tr>
	<td style="vertical-align:top;"><h4>Forums</h4></td>
	<td style="vertical-align :top;"><a href="http://www.ukwhitegoods.co.uk/forumsphpbb3/forum59/" target="_blank" >Forums </a>available for whitegoods engineers (trade access required).</td>

</tr>
<tr>
	<td style="vertical-align:top;"><h4>Designed by</h4></td>
	<td style="vertical-align :top;">			Sudeep Talati, Purva Talati 
		  	Kruthika Bethur &amp; Team</td>
</tr>

</table>


 

      <?php

function curl_file_get_contents($request)
{
$curl_req = curl_init($request);

curl_setopt($curl_req, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl_req, CURLOPT_HEADER, FALSE);

$contents = curl_exec($curl_req);

curl_close($curl_req);

return $contents;
}///end of functn curl File get contents
?>
 
 
