<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'servicecall-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->hiddenField($model,'customer_id',array('value'=>'0')); ?>
	<?php echo $form->error($model,'customer_id'); ?>
	
	<!--<div class="row">
		<?php echo $form->labelEx($model,'service_reference_number'); ?>
		<?php echo $form->textField($model,'service_reference_number'); ?>
		<?php echo $form->error($model,'service_reference_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
		<?php echo $form->error($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id'); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>

	-->
	<!--<div class="row">
		<?php echo $form->labelEx($model,'contract_id'); ?>
		<?php //echo $form->textField($model,'contract_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'contract_id', $model->getAllContract());?>
		<?php echo $form->error($model,'contract_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'engineer_id'); ?>
		<?php //echo $form->textField($model,'engineer_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'engineer_id', $model->getAllEngineers());?>
		<?php echo $form->error($model,'engineer_id'); ?>
	</div>

	--><div class="row">
		<?php echo $form->labelEx($model,'insurer_reference_number'); ?>
		<?php echo $form->textField($model,'insurer_reference_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'insurer_reference_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_status_id'); ?>
		<?php echo "Draft";?>
		<?php //echo $form->textField($model,'job_status_id'); ?>
		<?php echo $form->error($model,'job_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fault_date'); ?>
		<?php echo $form->textField($model,'fault_date'); ?>
		<?php echo $form->error($model,'fault_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fault_code'); ?>
		<?php echo $form->textField($model,'fault_code',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fault_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fault_description'); ?>
		<?php echo $form->textField($model,'fault_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fault_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'engg_visit_date'); ?>
		<?php echo $form->textField($model,'engg_visit_date'); ?>
		<?php echo $form->error($model,'engg_visit_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'work_carried_out'); ?>
		<?php echo $form->textField($model,'work_carried_out',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'work_carried_out'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'spares_used_status_id'); ?>
		<?php echo $form->textField($model,'spares_used_status_id'); ?>
		<?php echo $form->error($model,'spares_used_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total_cost'); ?>
		<?php echo $form->textField($model,'total_cost'); ?>
		<?php echo $form->error($model,'total_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vat_on_total'); ?>
		<?php echo $form->textField($model,'vat_on_total'); ?>
		<?php echo $form->error($model,'vat_on_total'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'net_cost'); ?>
		<?php echo $form->textField($model,'net_cost'); ?>
		<?php echo $form->error($model,'net_cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_payment_date'); ?>
		<?php echo $form->textField($model,'job_payment_date'); ?>
		<?php echo $form->error($model,'job_payment_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_finished_date'); ?>
		<?php echo $form->textField($model,'job_finished_date'); ?>
		<?php echo $form->error($model,'job_finished_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textField($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>
	
	<!-- FIELDS OF CUSTOMER AND PRODUCT FORM -->
	
	<h4>Enter customer details</h4>
	
	<?php 
	$customerModel=Customer::model();
	?>
	
	<div class="row">
		<?php echo $form->labelEx($customerModel,'title'); ?>
		<?php echo $form->textField($customerModel,'title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'first_name'); ?>
		<?php echo $form->textField($customerModel,'first_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'last_name'); ?>
		<?php echo $form->textField($customerModel,'last_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'last_name'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->labelEx($customerModel,'product_id'); ?>
		<?php echo $form->textField($customerModel,'product_id'); ?>
		<?php echo $form->error($customerModel,'product_id'); ?>
	</div>

	--><div class="row">
		<?php echo $form->labelEx($customerModel,'address_line_1'); ?>
		<?php echo $form->textField($customerModel,'address_line_1',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'address_line_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'address_line_2'); ?>
		<?php echo $form->textField($customerModel,'address_line_2',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'address_line_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'address_line_3'); ?>
		<?php echo $form->textField($customerModel,'address_line_3',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'address_line_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'town'); ?>
		<?php echo $form->textField($customerModel,'town',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'town'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'postcode'); ?>
		<?php echo $form->textField($customerModel,'postcode',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'postcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'country'); ?>
		<?php echo $form->textField($customerModel,'country',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'telephone'); ?>
		<?php echo $form->textField($customerModel,'telephone',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'mobile'); ?>
		<?php echo $form->textField($customerModel,'mobile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'fax'); ?>
		<?php echo $form->textField($customerModel,'fax',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'email'); ?>
		<?php echo $form->textField($customerModel,'email',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'notes'); ?>
		<?php echo $form->textField($customerModel,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'notes'); ?>
	</div>
	
	<!-- FIELDS FROM PRODUCT TABLE -->
	
	<?php 
	$productModel=Product::model();
	?>
	
	<h4>Enter Product details</h4>
	
	<div class="row">
		<?php echo $form->labelEx($productModel,'contract_id'); ?>
		<?php //echo $form->textField($model,'contract_id'); ?>
		<?php echo CHtml::activeDropDownList($productModel, 'contract_id', $productModel->getAllContract());?>
		<?php echo $form->error($productModel,'contract_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'brand_id'); ?>
		<?php //echo $form->textField($model,'brand_id'); ?>
		<?php echo CHtml::activeDropDownList($productModel, 'brand_id', $productModel->getAllBrands());?>
		<?php echo $form->error($productModel,'brand_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'product_type_id'); ?>
		<?php //echo $form->textField($model,'product_type_id'); ?>
		<?php echo CHtml::activeDropDownList($productModel, 'product_type_id', $productModel->getProductTypes());?>
		<?php echo $form->error($productModel,'product_type_id'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->labelEx($productModel,'customer_id'); ?>
		<?php echo $form->textField($productModel,'customer_id'); ?>
		<?php echo $form->error($productModel,'customer_id'); ?>
	</div>

	--><div class="row">
		<?php echo $form->labelEx($productModel,'engineer_id'); ?>
		<?php //echo $form->textField($model,'engineer_id'); ?>
		<?php echo CHtml::activeDropDownList($productModel, 'engineer_id', $productModel->getAllEngineers());?>
		<?php echo $form->error($productModel,'engineer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'purchased_from'); ?>
		<?php echo $form->textField($productModel,'purchased_from',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($productModel,'purchased_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'purchase_date'); ?>
		<?php echo $form->textField($productModel,'purchase_date'); ?>
		<?php echo $form->error($productModel,'purchase_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'warranty_date'); ?>
		<?php echo $form->textField($productModel,'warranty_date'); ?>
		<?php echo $form->error($productModel,'warranty_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'model_number'); ?>
		<?php echo $form->textField($productModel,'model_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($productModel,'model_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'serial_number'); ?>
		<?php echo $form->textField($productModel,'serial_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($productModel,'serial_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'production_code'); ?>
		<?php echo $form->textField($productModel,'production_code',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($productModel,'production_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'enr_number'); ?>
		<?php echo $form->textField($productModel,'enr_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($productModel,'enr_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'fnr_number'); ?>
		<?php echo $form->textField($productModel,'fnr_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($productModel,'fnr_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'discontinued'); ?>
		<?php echo $form->textField($productModel,'discontinued'); ?>
		<?php echo $form->error($productModel,'discontinued'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'warranty_for_months'); ?>
		<?php echo $form->textField($productModel,'warranty_for_months'); ?>
		<?php echo $form->error($productModel,'warranty_for_months'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'purchase_price'); ?>
		<?php echo $form->textField($productModel,'purchase_price'); ?>
		<?php echo $form->error($productModel,'purchase_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'notes'); ?>
		<?php echo $form->textField($productModel,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($productModel,'notes'); ?>
	</div>
	
	<!-- END OF FIELDS OF PRODUCT TABLE -->
	

	<!--<div class="row">
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

	<div class="row">
		<?php echo $form->labelEx($model,'cancelled'); ?>
		<?php echo $form->textField($model,'cancelled'); ?>
		<?php echo $form->error($model,'cancelled'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'closed'); ?>
		<?php echo $form->textField($model,'closed'); ?>
		<?php echo $form->error($model,'closed'); ?>
	</div>

	--><div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->