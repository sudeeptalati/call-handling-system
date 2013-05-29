


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'engineer-form',
	'enableAjaxValidation'=>false,
)); ?>
	<br><br>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
	<table style="width:700px; margin:10px; background-color: #C7E8FD;  border-radius: 15px; padding:15px;">
	<tr>
		<td>
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'first_name'); ?>
		</td>
		<td>
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'last_name'); ?>
		</td>
		<td>		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->dropDownList($model,'active', array('1'=>'Active', '0'=>'Inactive')); ?>
		<?php echo $form->error($model,'active'); ?></td>
	</tr>
	
	<tr>
		<td colspan="2"	>
		<?php echo $form->labelEx($model,'company'); ?>
		<?php echo $form->textField($model,'company',array('size'=>60)); ?>
		<?php echo $form->error($model,'company'); ?>
		</td>
		<td>
 		<?php echo $form->labelEx($model,'vat_reg_number'); ?>
		<?php echo $form->textField($model,'vat_reg_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'vat_reg_number'); ?>
		</td>
		
	</tr>
	<tr>
		<td colspan="3"	>
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>75)); ?>
		<?php echo $form->error($model,'notes'); ?>
		</td>
		
	</tr>
	</table>

	 
	
	<!-- FIELDS OF CONTACT DETAILS FORM  -->
 
	<?php 
	if(!empty($model->contact_details_id))
	{
		$contactDetailsModel=ContactDetails::model()->findByPk($model->contact_details_id);
	}
	else 
	{
		$contactDetailsModel=ContactDetails::model();
	}
	?>
	
	
	
	<table style="width:700px; margin:10px; background-color: #ADEBAD;  border-radius: 15px;padding:15px;">
	
	<tr>
		<td colspan="3"><h3 style="margin-bottom:0.01px;color:#555;"><label>Address Details</label></h3></td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'address_line_1'); ?>
			<?php echo $form->textField($contactDetailsModel,'address_line_1',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'address_line_1'); ?>
		</td>
		<td>
			<?php //echo $form->labelEx($contactDetailsModel,'address_line_2'); ?>
			<?php echo $form->textField($contactDetailsModel,'address_line_2',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'address_line_2'); ?>
		</td>
		<td>
			<?php //echo $form->labelEx($contactDetailsModel,'address_line_3'); ?>
			<?php echo $form->textField($contactDetailsModel,'address_line_3',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'address_line_3'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'town'); ?>
			<?php echo $form->textField($contactDetailsModel,'town',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'town'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'postcode_s'); ?>
			<?php echo $form->textField($contactDetailsModel,'postcode_s',array('size'=>6)); ?>
			<?php echo $form->textField($contactDetailsModel,'postcode_e',array('size'=>6)); ?>
			<?php echo $form->error($contactDetailsModel,'postcode_s'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'country'); ?>
			<?php echo $form->textField($contactDetailsModel,'country',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'country'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'telephone'); ?>
			<?php echo $form->textField($contactDetailsModel,'telephone',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'telephone'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'mobile'); ?>
			<?php echo $form->textField($contactDetailsModel,'mobile',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'mobile'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'fax'); ?>
			<?php echo $form->textField($contactDetailsModel,'fax',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'fax'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'email'); ?>
			<?php echo $form->textField($contactDetailsModel,'email',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'email'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($contactDetailsModel,'website'); ?>
			<?php echo $form->textField($contactDetailsModel,'website',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($contactDetailsModel,'website'); ?>
		</td>
	</tr>
	</table>
 
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

	-->
	
		<table style="width:700px; margin:10px; background-color: #F3B6B7;  border-radius: 15px;padding:15px;">
		<tr>
		<td>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</td>
		</tr>
		</table>
	
	
	
<?php $this->endWidget(); ?>

</div><!-- form -->