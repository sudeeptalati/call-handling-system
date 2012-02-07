<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<!-- FIRST PART TO DISPLAY CUSTOMER DETAILS. -->
	<?php 
	$productId=$_GET['id'];
	
	$customerModel=Customer::model()->findByAttributes(
									array('product_id'=>$productId));
	?>
	
	<div class="row">
		<?php echo $form->labelEx($customerModel,'title'); ?>
		<?php echo $form->textField($customerModel,'title',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($customerModel,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'first_name'); ?>
		<?php echo $form->textField($customerModel,'first_name',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($customerModel,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'last_name'); ?>
		<?php echo $form->textField($customerModel,'last_name',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($customerModel,'last_name'); ?>
	</div>
	
	
	
	<!-- SECOND PART TO DISPLAY FIELDS OF PRODUCT FORM. -->

	<div class="row">
		<?php echo $form->labelEx($model,'contract_id'); ?>
		<?php //echo $form->textField($model,'contract_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'contract_id', $model->getAllContract());?>
		<?php echo $form->error($model,'contract_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'brand_id'); ?>
		<?php //echo $form->textField($model,'brand_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'brand_id', $model->getAllBrands());?>
		<?php echo $form->error($model,'brand_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_type_id'); ?>
		<?php //echo $form->textField($model,'product_type_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'product_type_id', $model->getProductTypes());?>
		<?php echo $form->error($model,'product_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php echo $form->textField($model,'customer_id'); ?>
		<?php echo $form->error($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'engineer_id'); ?>
		<?php //echo $form->textField($model,'engineer_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'engineer_id', $model->getAllEngineers());?>
		<?php echo $form->error($model,'engineer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'purchased_from'); ?>
		<?php echo $form->textField($model,'purchased_from',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'purchased_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'purchase_date'); ?>
		<?php echo $form->textField($model,'purchase_date'); ?>
		<?php echo $form->error($model,'purchase_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'warranty_date'); ?>
		<?php echo $form->textField($model,'warranty_date'); ?>
		<?php echo $form->error($model,'warranty_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'model_number'); ?>
		<?php echo $form->textField($model,'model_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'model_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'serial_number'); ?>
		<?php echo $form->textField($model,'serial_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'serial_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'production_code'); ?>
		<?php echo $form->textField($model,'production_code',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'production_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enr_number'); ?>
		<?php echo $form->textField($model,'enr_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'enr_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fnr_number'); ?>
		<?php echo $form->textField($model,'fnr_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'fnr_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'discontinued'); ?>
		<?php echo $form->textField($model,'discontinued'); ?>
		<?php echo $form->error($model,'discontinued'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'warranty_for_months'); ?>
		<?php echo $form->textField($model,'warranty_for_months'); ?>
		<?php echo $form->error($model,'warranty_for_months'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'purchase_price'); ?>
		<?php echo $form->textField($model,'purchase_price'); ?>
		<?php echo $form->error($model,'purchase_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
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

	<div class="row">
		<?php echo $form->labelEx($model,'cancelled'); ?>
		<?php echo $form->textField($model,'cancelled'); ?>
		<?php echo $form->error($model,'cancelled'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->