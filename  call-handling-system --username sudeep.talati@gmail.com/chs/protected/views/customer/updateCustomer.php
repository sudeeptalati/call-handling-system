<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-updateCustomer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<!-- FIRST PART OF FORM TO DISPLAY THE PRODUCT DETAILS. -->
	
	<?php 
	$customerId=$_GET['id'];
	//echo "CUSTOMER ID FROM URL IN UPDATE CUSTOMER FORM :".$customerId;
	
	$productModel=Product::model()->findByAttributes(
									array('customer_id'=>$customerId));
									
	$brandId=$productModel->brand_id;			
	$productTypeId=$productModel->product_type_id;	
	$engineerId=$productModel->engineer_id;					
									
	$brandModel=Brand::model()->findByPk($brandId);
	$productTypeModel=ProductType::model()->findByPk($productTypeId);
	$engineerModel=Engineer::model()->findByPk($engineerId);							
									
									
	?>
	
	<div class="row">
	<table>
	<tr>
	
		<td>
		<?php echo $form->labelEx($brandModel,'name'); ?>
		<?php echo $form->textField($brandModel,'name',array('disabled'=>'disabled')); ?>
		<?php //echo CHtml::activeDropDownList($productModel, 'brand_id', $productModel->getAllBrands());?>
		<?php echo $form->error($brandModel,'name'); ?>
		</td>

		<td>
		<?php echo $form->labelEx($productTypeModel,'name'); ?>
		<?php echo $form->textField($productTypeModel,'name',array('disabled'=>'disabled')); ?>
		<?php //echo CHtml::activeDropDownList($productModel, 'product_type_id', $productModel->getProductTypes());?>
		<?php echo $form->error($productTypeModel,'name'); ?>
		</td>
	
		<td>
		<?php echo $form->labelEx($engineerModel,'fullname'); ?>
		<?php echo $form->textField($engineerModel,'fullname',array('disabled'=>'disabled')); ?>
		<?php //echo CHtml::activeDropDownList($productModel, 'product_type_id', $productModel->getProductTypes());?>
		<?php echo $form->error($engineerModel,'fullname'); ?>
		</td>
		
		<!--<td>
		<?php echo $form->labelEx($productModel,'purchase_date'); ?>
		<?php echo $form->textField($productModel,'purchase_date'); ?>
		<?php echo $form->error($productModel,'purchase_date'); ?>
		</td>

		<td>
		<?php echo $form->labelEx($productModel,'warranty_date'); ?>
		<?php echo $form->textField($productModel,'warranty_date'); ?>
		<?php echo $form->error($productModel,'warranty_date'); ?>
		</td>

		
	
	--></tr>
	</table>
	</div>
	<!-- SECOND PART TO DISPLAY CUSTOMER TABLE FIELDS DATA. -->
	

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name'); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name'); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address_line_1'); ?>
		<?php echo $form->textField($model,'address_line_1'); ?>
		<?php echo $form->error($model,'address_line_1'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'address_line_2'); ?>
		<?php echo $form->textField($model,'address_line_2'); ?>
		<?php echo $form->error($model,'address_line_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address_line_3'); ?>
		<?php echo $form->textField($model,'address_line_3'); ?>
		<?php echo $form->error($model,'address_line_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'town'); ?>
		<?php echo $form->textField($model,'town'); ?>
		<?php echo $form->error($model,'town'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode'); ?>
		<?php echo $form->error($model,'postcode'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country'); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'telephone'); ?>
		<?php echo $form->textField($model,'telephone'); ?>
		<?php echo $form->error($model,'telephone'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'mobile'); ?>
		<?php echo $form->textField($model,'mobile'); ?>
		<?php echo $form->error($model,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fax'); ?>
		<?php echo $form->textField($model,'fax'); ?>
		<?php echo $form->error($model,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model,'product_id'); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>
	
	--><div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textField($model,'notes'); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'created_by_user_id'); ?>
		<?php echo $form->textField($model,'created_by_user_id'); ?>
		<?php echo $form->error($model,'created_by_user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
		<?php echo $form->error($model,'modified'); ?>
	</div>-->
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->