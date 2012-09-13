<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setup-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textArea($model,'company',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'town'); ?>
		<?php echo $form->textArea($model,'town',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'town'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcode_s'); ?>
		<?php echo $form->textArea($model,'postcode_s',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'postcode_s'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcode_e'); ?>
		<?php echo $form->textArea($model,'postcode_e',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'postcode_e'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'county'); ?>
		<?php echo $form->textArea($model,'county',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'county'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textArea($model,'country',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textArea($model,'email',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone'); ?>
		<?php echo $form->textArea($model,'telephone',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textArea($model,'mobile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alternate'); ?>
		<?php echo $form->textArea($model,'alternate',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'alternate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textArea($model,'fax',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcodeanywhere_account_code'); ?>
		<?php echo $form->textArea($model,'postcodeanywhere_account_code',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'postcodeanywhere_account_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcodeanywhere_license_key'); ?>
		<?php echo $form->textArea($model,'postcodeanywhere_license_key',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'postcodeanywhere_license_key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textArea($model,'website',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vat_reg_no'); ?>
		<?php echo $form->textArea($model,'vat_reg_no',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'vat_reg_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_number'); ?>
		<?php echo $form->textArea($model,'company_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'company_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcode'); ?>
		<?php echo $form->textArea($model,'postcode',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'postcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'version_update_url'); ?>
		<?php echo $form->textArea($model,'version_update_url',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'version_update_url'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->