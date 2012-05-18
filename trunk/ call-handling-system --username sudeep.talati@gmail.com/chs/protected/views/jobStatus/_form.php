<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'job-status-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php
			 	if  ($model->id>50 && $model->id<100 )///id greater than 100 are custom statuses
			 	{
			 		echo $form->textField($model,'name',array('size'=>50));
			 	}
				else
				{
					echo $form->textField($model,'name',array('size'=>50, 'disabled'=>'disabled' ));
					echo "<br><small>This is  system set status, therefore above name cannot be edited</small><br><br>";	
				}
					
				?>
				
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'information'); ?>
		<?php echo $form->textArea($model,'information',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'information'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'published'); ?>
		<?php echo $form->dropDownList($model,'published',array('1'=>'Yes', '0'=>'No',));?>
		<?php echo $form->error($model,'published'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'dashboard_display'); ?>
		<?php echo $form->dropDownList($model,'dashboard_display',array('1'=>'Yes', '0'=>'No',));?>
		<?php echo $form->error($model,'dashboard_display'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'view_order'); ?>
		<?php echo $form->textField($model,'view_order'); ?>
		<?php echo $form->error($model,'view_order'); ?>
	</div>
 

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->