


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'engineer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->dropDownList($model,'active', array('1'=>'Active', '0'=>'Inactive')); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textField($model,'company',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vat_reg_number'); ?>
		<?php echo $form->textField($model,'vat_reg_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'vat_reg_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textField($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>
	
	<!-- FIELDS OF CONTACT DETAILS FORM  -->
	
	<h4>Enter your address details</h4>
	
	<?php 
	if(!empty($model->contact_details_id))
	{
		$ContactDetailsModel=ContactDetails::model()->findByPk($model->contact_details_id);
	}
	else 
	{
		$ContactDetailsModel=ContactDetails::model();
	}
	?>
	
	<div class="row">
		<?php echo $form->labelEx($ContactDetailsModel,'address_line_1'); ?>
		<?php echo $form->textField($ContactDetailsModel,'address_line_1',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($ContactDetailsModel,'address_line_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($ContactDetailsModel,'address_line_2'); ?>
		<?php echo $form->textField($ContactDetailsModel,'address_line_2',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($ContactDetailsModel,'address_line_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($ContactDetailsModel,'address_line_3'); ?>
		<?php echo $form->textField($ContactDetailsModel,'address_line_3',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($ContactDetailsModel,'address_line_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($ContactDetailsModel,'town'); ?>
		<?php echo $form->textField($ContactDetailsModel,'town',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($ContactDetailsModel,'town'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($ContactDetailsModel,'postcode_s'); ?>
		<?php echo $form->textField($ContactDetailsModel,'postcode_s',array('size'=>6, 'maxlength'=>4)); ?>
		<?php echo $form->textField($ContactDetailsModel,'postcode_e',array('size'=>6, 'maxlength'=>4)); ?>
		<?php echo $form->error($ContactDetailsModel,'postcode_s'); ?>
		<?php echo $form->error($ContactDetailsModel,'postcode_e'); ?>
	</div>
	
	<!--<div class="row">
		<?php //echo $form->labelEx($ContactDetailsModel,'postcode_e'); ?>
		<?php //echo $form->textField($ContactDetailsModel,'postcode_e',array('rows'=>6, 'cols'=>50)); ?>
		<?php //echo $form->error($ContactDetailsModel,'postcode_e'); ?>
	</div>-->

	<div class="row">
		<?php echo $form->labelEx($ContactDetailsModel,'country'); ?>
		<?php echo $form->textField($ContactDetailsModel,'country',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($ContactDetailsModel,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($ContactDetailsModel,'latitudes'); ?>
		<?php echo $form->textField($ContactDetailsModel,'latitudes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($ContactDetailsModel,'latitudes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($ContactDetailsModel,'longitudes'); ?>
		<?php echo $form->textField($ContactDetailsModel,'longitudes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($ContactDetailsModel,'longitudes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($ContactDetailsModel,'mobile'); ?>
		<?php echo $form->textField($ContactDetailsModel,'mobile',array('rows'=>6, 'cols'=>50)); ?>
		<small><br>(Please enter number preceding with 44)</small>
		<?php echo $form->error($ContactDetailsModel,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($ContactDetailsModel,'telephone'); ?>
		<?php echo $form->textField($ContactDetailsModel,'telephone',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($ContactDetailsModel,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($ContactDetailsModel,'fax'); ?>
		<?php echo $form->textField($ContactDetailsModel,'fax',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($ContactDetailsModel,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($ContactDetailsModel,'email'); ?>
		<?php echo $form->textField($ContactDetailsModel,'email',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($ContactDetailsModel,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($ContactDetailsModel,'website'); ?>
		<?php echo $form->textField($ContactDetailsModel,'website',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($ContactDetailsModel,'website'); ?>
	</div>
	
	<!-- FIELDS OF CONTACT DETAILS END HERE -->

	<!--<div class="row">
		<?php //echo $form->labelEx($model,'inactivated_by_user_id'); ?>
		<?php //echo $form->textField($model,'inactivated_by_user_id'); ?>
		<?php //echo $form->error($model,'inactivated_by_user_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'inactivated_on'); ?>
		<?php //echo $form->textField($model,'inactivated_on'); ?>
		<?php //echo $form->error($model,'inactivated_on'); ?>
	</div>

	--><!--<div class="row">
		<?php //echo $form->labelEx($model,'contact_details_id'); ?>
		<?php //echo $form->textField($model,'contact_details_id'); ?>
		<?php //echo $form->error($model,'contact_details_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'delivery_contact_details_id'); ?>
		<?php //echo $form->textField($model,'delivery_contact_details_id'); ?>
		<?php //echo $form->error($model,'delivery_contact_details_id'); ?>
	</div>

	--><!--<div class="row">
		<?php //echo $form->labelEx($model,'created_by_user_id'); ?>
		<?php //echo $form->textField($model,'created_by_user_id'); ?>
		<?php //echo $form->error($model,'created_by_user_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'created'); ?>
		<?php //echo $form->textField($model,'created'); ?>
		<?php //echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'modified'); ?>
		<?php //echo $form->textField($model,'modified'); ?>
		<?php //echo $form->error($model,'modified'); ?>
	</div>

	--><div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->