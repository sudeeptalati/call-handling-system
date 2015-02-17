<?php
/* @var $this GomobileaccountController */
/* @var $model GomobileAccount */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gomobile_account_name'); ?>
		<?php echo $form->textArea($model,'gomobile_account_name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_name'); ?>
		<?php echo $form->textArea($model,'company_name',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'contact_email'); ?>
		<?php echo $form->textArea($model,'contact_email',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'no_of_rapport_users'); ?>
		<?php echo $form->textField($model,'no_of_rapport_users'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'no_of_engineers'); ?>
		<?php echo $form->textField($model,'no_of_engineers'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_on'); ?>
		<?php echo $form->textField($model,'created_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_modified_on'); ?>
		<?php echo $form->textField($model,'last_modified_on'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->