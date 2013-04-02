<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'advance-settings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'parameter'); ?>
		<?php echo $form->textField($model,'parameter',array('rows'=>6, 'cols'=>50, 'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'parameter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textField($model,'value',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

