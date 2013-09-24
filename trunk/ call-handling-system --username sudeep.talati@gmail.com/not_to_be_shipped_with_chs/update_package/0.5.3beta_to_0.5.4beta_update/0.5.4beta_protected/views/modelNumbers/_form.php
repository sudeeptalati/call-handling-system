<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'model-numbers-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'model_number'); ?>
		<?php echo $form->textArea($model,'model_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'model_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'brand_id'); ?>
		<?php echo $form->textField($model,'brand_id'); ?>
		<?php echo $form->error($model,'brand_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_type_id'); ?>
		<?php echo $form->textField($model,'product_type_id'); ?>
		<?php echo $form->error($model,'product_type_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->