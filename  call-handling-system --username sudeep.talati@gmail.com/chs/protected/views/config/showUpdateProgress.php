<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-showUpdateProgress-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php 
	
	$request='http://rapportsoftware.co.uk/versions/rapport_callhandling.txt';	
	$available_version = file_get_contents($request, true);
	
	?>
	
	<?php echo "Updating Software to ".$available_version."<br><br><br>";?>
	
	<?php
	
		$msg='';
		$currentStep = $currStep;
		echo "Step ".$currentStep." of 6 steps is completed."."<br><br>";
		//echo $msg;
		//echo "currentStep = ".$currentStep."     ";
		
		if($currentStep == 1)
		{
			 
			echo "Step 1:Files succesfully downloaded!"."<br><br><br>"; 
			$progressVal = 15;
		}
		
		else if($currentStep == 2)
		{
			echo "Step 1:Files succesfully downloaded!"."<br><br>". "Step 2 completed"."<br><br><br>";
			$progressVal = 30;
		}
		
	
	?>
	
	<?php 
		
		$this->widget('zii.widgets.jui.CJuiProgressBar', array(
					    'id'=>'progress',
					    'value'=>$progressVal,
					    'htmlOptions'=>array(
					        'style'=>'width:200px; height:15px; float:left; background-color:#44F44F ;background:#EFFDFF',
					        'color' => 'blue'
					    ),
					    ));
	?>
	   
<?php $this->endWidget(); ?>

<?php 
if($currentStep < 2 )
{
	$passVal = $currentStep+1;
	echo "<SCRIPT LANGUAGE='javascript'>location.href='Config/showUpdateProgress/?curr_step=$passVal';</SCRIPT>";
}
?>

<!--	<SCRIPT LANGUAGE='javascript'>location.href='Config/showUpdateProgress/?curr_step='<?php //echo $currentStep;?></SCRIPT>-->
	<!--<script type="text/javascript">-->
	<!--  // I would like to call a url using jQuery?-->
	<!--  $.ajax({-->
	<!--    url: "<?php //echo CController::createUrl('Config/showUpdateProgress/?curr_step='.$currentStep);?>"-->
	<!--  });-->
	<!--</script>-->
	



</div><!-- form -->

