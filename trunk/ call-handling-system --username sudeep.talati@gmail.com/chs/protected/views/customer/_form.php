<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

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

	<!--<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id'); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>

	--><div class="row">
		<?php echo $form->labelEx($model,'address_line_1'); ?>
		<?php echo $form->textField($model,'address_line_1',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address_line_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address_line_2'); ?>
		<?php echo $form->textField($model,'address_line_2',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address_line_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address_line_3'); ?>
		<?php echo $form->textField($model,'address_line_3',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'address_line_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'town'); ?>
		<?php echo $form->textField($model,'town',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'town'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'postcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telephone'); ?>
		<?php echo $form->textField($model,'telephone',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textField($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
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

	--><div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->