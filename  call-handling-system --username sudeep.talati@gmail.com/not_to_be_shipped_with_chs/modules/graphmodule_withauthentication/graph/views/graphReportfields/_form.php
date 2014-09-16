<?php
/* @var $this GraphReportfieldsController */
/* @var $model GraphReportfields */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'graph-reportfields-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'report_type'); ?>
		<?php echo $form->textField($model,'report_type'); ?>
		<?php echo $form->error($model,'report_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'field_name'); ?>
		<?php echo $form->textField($model,'field_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'field_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'field_type'); ?>
		<?php echo $form->textField($model,'field_type',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'field_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'field_relation'); ?>
		<?php echo $form->textField($model,'field_relation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'field_relation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'field_label'); ?>
		<?php echo $form->textField($model,'field_label',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'field_label'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sort_order'); ?>
		<?php echo $form->textField($model,'sort_order'); ?>
		<?php echo $form->error($model,'sort_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->