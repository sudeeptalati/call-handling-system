<div class="form">

<?php
$model->management_contact_details='Same as main contact';
$model->spares_contact_details='Same as main contact';
$model->accounts_contact_details='Same as main contact';
$model->technical_contact_details='Same as main contact';

//EVENT LISTENER FOR MANAGEMENT FIELD.
Yii::app()->clientScript->registerScript('my-management-listener',"
$('#management-checkbox-id').change(function(){
$('.management-form').toggle();
	return false;
});
");

//EVENT LISTENER FOR SPARES FIELD.
Yii::app()->clientScript->registerScript('my-spares-listener',"
$('#spares-checkbox-id').change(function(){
$('.spares-form').toggle();
	return false;
});
");

//EVENT LISTENER FOR ACCOUNTS FIELD.
Yii::app()->clientScript->registerScript('my-accounts-listener',"
$('#accounts-checkbox-id').change(function(){
$('.accounts-form').toggle();
	return false;
});
");

//EVENT LISTENER FOR TECHNICAL FIELD.
Yii::app()->clientScript->registerScript('my-technical-listener1',"
$('#technical-checkbox-id').change(function(){
$('.technical-form').toggle();
	return false;
});
");

?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contract-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'contract_type_id'); ?>
		<?php //echo $form->textField($model,'contract_type_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'contract_type_id', $model->getContractType());?>
		<?php echo $form->error($model,'contract_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->dropDownList($model,'active', array('1'=>'Yes', '0'=>'No')); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>
	
	<!-- START OF FIELDS OF CONTACT DETAILS FORM -->
	
	<?php 
	if (!empty($model->main_contact_details_id))
	{
		$contactDetailsModel=ContactDetails::model()->findByPk($model->main_contact_details_id);
	}
	else 
	{
		$contactDetailsModel=ContactDetails::model();
	}
	?>
	
	<h4>Address Details</h4>	
	
	<div class="row">
		<?php echo $form->labelEx($contactDetailsModel,'address_line_1'); ?>
		<?php echo $form->textField($contactDetailsModel,'address_line_1',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($contactDetailsModel,'address_line_1'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($contactDetailsModel,'address_line_2'); ?>
		<?php echo $form->textField($contactDetailsModel,'address_line_2',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($contactDetailsModel,'address_line_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contactDetailsModel,'address_line_3'); ?>
		<?php echo $form->textField($contactDetailsModel,'address_line_3',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($contactDetailsModel,'address_line_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contactDetailsModel,'town'); ?>
		<?php echo $form->textField($contactDetailsModel,'town',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($contactDetailsModel,'town'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contactDetailsModel,'postcode'); ?>
		<?php echo $form->textField($contactDetailsModel,'postcode',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($contactDetailsModel,'postcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contactDetailsModel,'country'); ?>
		<?php echo $form->textField($contactDetailsModel,'country',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($contactDetailsModel,'country'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($contactDetailsModel,'latitudes'); ?>
		<?php echo $form->textField($contactDetailsModel,'latitudes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($contactDetailsModel,'latitudes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contactDetailsModel,'longitudes'); ?>
		<?php echo $form->textField($contactDetailsModel,'longitudes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($contactDetailsModel,'longitudes'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contactDetailsModel,'mobile'); ?>
		<?php echo $form->textField($contactDetailsModel,'mobile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($contactDetailsModel,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contactDetailsModel,'telephone'); ?>
		<?php echo $form->textField($contactDetailsModel,'telephone',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($contactDetailsModel,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contactDetailsModel,'fax'); ?>
		<?php echo $form->textField($contactDetailsModel,'fax',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($contactDetailsModel,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contactDetailsModel,'email'); ?>
		<?php echo $form->textField($contactDetailsModel,'email',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($contactDetailsModel,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($contactDetailsModel,'website'); ?>
		<?php echo $form->textField($contactDetailsModel,'website',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($contactDetailsModel,'website'); ?>
	</div>
	
	<!-- ***********  MANAGEMENT TEXTFIELD ********** -->
	
	<div class="row">
		<?php echo $form->labelEx($model,'management_contact_details'); ?>
		<?php //echo $form->textField($model,'management_details',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->checkBox($model,'management_contact_details',array('checked'=>'checked','id'=>'management-checkbox-id')); ?>
		<?php echo "Same as above";?>
		<?php echo $form->error($model,'management_contact_details'); ?>
	</div>
	<div class="management-form" style="display:none">
		<?php echo $form->textArea($model,'management_contact_details'); ?>
		<?php echo $form->error($model,'management_contact_details'); ?>
	</div>
	
	<!-- ***********  SPARES TEXTFIELD ********** -->
	<div class="row">
		<?php echo $form->labelEx($model,'spares_contact_details'); ?>
		<?php //echo $form->textField($model,'spares_contact_details',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->checkBox($model,'spares_contact_details',array('checked'=>'checked','id'=>'spares-checkbox-id')); ?>
		<?php echo "Same as above";?>
		<?php echo $form->error($model,'spares_contact_details'); ?>
	</div>
	<div class="spares-form" style="display:none">
		<?php echo $form->textArea($model,'spares_contact_details'); ?>
		<?php echo $form->error($model,'spares_contact_details'); ?>
	</div>
 
 	<!-- ***********  ACCOUNTS TEXTFIELD ********** -->
 	
 	<div class="row">
		<?php echo $form->labelEx($model,'accounts_contact_details'); ?>
		<?php //echo $form->textField($model,'spares_contact_details',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->checkBox($model,'accounts_contact_details',array('checked'=>'checked','id'=>'accounts-checkbox-id','name'=>'myCheckBox')); ?>
		<?php echo "Same as above";?>
		<?php echo $form->error($model,'accounts_contact_details'); ?>
	</div>
	<div class="accounts-form" style="display:none">
		<?php echo $form->textArea($model,'accounts_contact_details'); ?>
		<?php echo $form->error($model,'accounts_contact_details'); ?>
	</div>
	
	<!-- ***********  TECHNICAL TEXTFIELD ********** -->
	
	<div class="row">
		<?php echo $form->labelEx($model,'technical_contact_details'); ?>
		<?php //echo $form->textField($model,'technical_contact_details',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->checkBox($model,'technical_contact_details',array('checked'=>'checked','id'=>'technical-checkbox-id','name'=>'myCheckBox')); ?>
		<?php echo "Same as above";?>
		<?php echo $form->error($model,'technical_contact_details'); ?>
	</div>
	<div class="technical-form" style="display:none">
		<?php echo $form->textArea($model,'technical_contact_details'); ?>
		<?php echo $form->error($model,'technical_contact_details'); ?>
	</div>
 	
	<!--<div class="row">
	<?php //echo $form->labelEx($model,'management_contact_details'); ?>
	<?php //echo $form->checkBox('','',array('checked'=>'checked','id'=>'my-checkbox-id','name'=>'myCheckBox')); ?>
	<?php //echo CHtml::checkBox('my-checkbox-id', array('checked'=>'checked','id'=>'my-checkbox-id','name'=>'myCheckBox'));?>
	<?php //echo "Same as above"."<br>";?>
	
	
	
	
	<?php //echo CHtml::link('Add','#',array('class'=>'add-button')); ?>
	
	</div> search-form 
	
	
	--><!-- END OF FIELDS OF CONTACT DETAILS FORM -->
	
	
	
	<!--<div class="row">
		<?php //echo $form->labelEx($model,'main_contact_details_id'); ?>
		<?php //echo $form->textField($model,'main_contact_details_id'); ?>
		<?php //echo $form->error($model,'main_contact_details_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'accounts_contact_details'); ?>
		<?php //echo $form->textField($model,'accounts_contact_details'); ?>
		<?php //echo $form->error($model,'accounts_contact_details'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'technical_contact_details'); ?>
		<?php //echo $form->textField($model,'technical_contact_details'); ?>
		<?php //echo $form->error($model,'technical_contact_details'); ?>
	</div>

	
	--><!--<div class="row">
		<?php //echo $form->labelEx($model,'inactivated_by_user_id'); ?>
		<?php //echo $form->textField($model,'inactivated_by_user_id'); ?>
		<?php //echo $form->error($model,'inactivated_by_user_id'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'inactivated_on'); ?>
		<?php //echo $form->textField($model,'inactivated_on'); ?>
		<?php //echo $form->error($model,'inactivated_on'); ?>
	</div>

	<div class="row">
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