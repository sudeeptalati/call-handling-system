<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'engineer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textArea($model,'first_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textArea($model,'last_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textArea($model,'company',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vat_reg_number'); ?>
		<?php echo $form->textArea($model,'vat_reg_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'vat_reg_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inactivated_by_user_id'); ?>
		<?php echo $form->textField($model,'inactivated_by_user_id'); ?>
		<?php echo $form->error($model,'inactivated_by_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inactivated_on'); ?>
		<?php echo $form->textField($model,'inactivated_on'); ?>
		<?php echo $form->error($model,'inactivated_on'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact_details_id'); ?>
		<?php echo $form->textField($model,'contact_details_id'); ?>
		<?php echo $form->error($model,'contact_details_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'delivery_contact_details_id'); ?>
		<?php echo $form->textField($model,'delivery_contact_details_id'); ?>
		<?php echo $form->error($model,'delivery_contact_details_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_by_user_id'); ?>
		<?php echo $form->textField($model,'created_by_user_id'); ?>
		<?php echo $form->error($model,'created_by_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
		<?php echo $form->error($model,'modified'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->