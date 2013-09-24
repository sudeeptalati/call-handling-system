<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'country-codes-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'iso2'); ?>
		<?php echo $form->textArea($model,'iso2',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'iso2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'short_name'); ?>
		<?php echo $form->textArea($model,'short_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'short_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'long_name'); ?>
		<?php echo $form->textArea($model,'long_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'long_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'iso3'); ?>
		<?php echo $form->textArea($model,'iso3',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'iso3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'numcode'); ?>
		<?php echo $form->textArea($model,'numcode',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'numcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'un_member'); ?>
		<?php echo $form->textArea($model,'un_member',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'un_member'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'calling_code'); ?>
		<?php echo $form->textArea($model,'calling_code',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'calling_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cctld'); ?>
		<?php echo $form->textArea($model,'cctld',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'cctld'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->