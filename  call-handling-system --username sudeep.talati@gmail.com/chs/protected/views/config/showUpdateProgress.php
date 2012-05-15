<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'config-showUpdateProgress-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textField($model,'company'); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>
	
	<?php 
		
		$this->widget('zii.widgets.jui.CJuiProgressBar', array(
					    'id'=>'progress',
					    'value'=>$i,
					    'htmlOptions'=>array(
					        'style'=>'width:200px; height:15px; float:left; background-color:#44F44F ;background:#EFFDFF',
					        'color' => 'blue'
					    ),
					    ));
	?>					   

<?php $this->endWidget(); ?>

</div><!-- form -->