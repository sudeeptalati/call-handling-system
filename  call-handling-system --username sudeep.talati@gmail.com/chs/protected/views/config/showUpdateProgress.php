<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-showUpdateProgress-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php 
	
	$request='http://rapportsoftware.co.uk/versions/rapport_callhandling.txt';	
	$available_version = Config::model()->curl_file_get_contents($request);
	
	?>
	
	<?php echo "Updating Software to ".$available_version."<br><br><br>";
		$message=$step_info[1];
		$currentStep = $step_info[0];
		$progressBarValue=$currentStep*16;
		
	?>
	
<?php 
		
		$this->widget('zii.widgets.jui.CJuiProgressBar', array(
					    'id'=>'progress',
					    'value'=>$progressBarValue,
					    'htmlOptions'=>array(
					        'style'=>'width:200px; height:15px; float:left; background-color:#44F44F ;background:#EFFDFF',
					        'color' => 'blue'
					    ),
					    ));
		?>
	   
<?php $this->endWidget(); ?>




<?php 
$_SESSION['message']=$_SESSION['message'].$message;
echo $_SESSION['message'];


if($currentStep != 0 && $currentStep < 7 )
{
	$next_step = $currentStep+1;
	$url=Yii::app()->baseUrl.'/Config/showUpdateProgress/?curr_step='.$next_step;
	//echo $url;
	echo "<SCRIPT LANGUAGE='javascript'>location.href='$url';</SCRIPT>";
}
else
{
	/*After printing the messages We are clearing the message variable, so that when update run again for next time gives us no error*/
	$_SESSION['message']='';

}

?>


	



</div><!-- form -->

