<?php
/* @var $this GomobileaccountController */
/* @var $model GomobileAccount */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gomobile-account-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'gomobile_account_name'); ?>
		<?php echo $form->textArea($model,'gomobile_account_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'gomobile_account_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textArea($model,'company_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_email'); ?>
		<?php echo $form->textArea($model,'contact_email',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'contact_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'no_of_rapport_users'); ?>
		<?php echo $form->textField($model,'no_of_rapport_users'); ?>
		<?php echo $form->error($model,'no_of_rapport_users'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'no_of_engineers'); ?>
		<?php echo $form->textField($model,'no_of_engineers'); ?>
		<?php echo $form->error($model,'no_of_engineers'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_on'); ?>
		<?php echo $form->textField($model,'created_on'); ?>
		<?php echo $form->error($model,'created_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_modified_on'); ?>
		<?php echo $form->textField($model,'last_modified_on'); ?>
		<?php echo $form->error($model,'last_modified_on'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->