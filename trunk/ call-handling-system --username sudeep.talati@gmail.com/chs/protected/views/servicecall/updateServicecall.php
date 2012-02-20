<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'servicecall-updateServicecall-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php 
		$service_id=$_GET['id'];
		echo "SERVICE ID FROM URL :".$service_id;
		//echo "ID FROM MODEL :".$model->id;
		$customerModel=Customer::model()->findByPk($model->customer_id);
		$productModel=Product::model()->findByPk($model->product_id);
		$brandModel=Brand::model()->findByPk($productModel->brand_id);
		$productTypeModel=ProductType::model()->findByPk($productModel->product_type_id);
		$contractModel=Contract::model()->findByPk($model->contract_id);
		$contractName=$contractModel->name;
		$contractTypeModel=ContractType::model()->findByPk($contractModel->contract_type_id);
		$engineerModel=Engineer::model()->findByPk($model->engineer_id);
		$engineerName=$engineerModel->fullname;
		
		//address of customer.
		$str1=$customerModel->address_line_1." ".$customerModel->address_line_2." ".$customerModel->address_line_3."\n";
		$str2=$customerModel->town."\n";
		$str3=$customerModel->postcode;
		$address=$str1." ".$str2." ".$str3;
		
		
	
	
	
	?>
	
	<!-- ************ CUSTOMER DEATILS******** -->
	<div class="row">
	<table>
	<tr>
		<td>
		<?php echo $form->labelEx($model,'service_reference_number'); ?>
		<?php echo $form->textField($model,'service_reference_number',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'service_reference_number'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($customerModel,'fullname'); ?>
			<?php echo $form->textField($customerModel,'fullname', array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'fullname'); ?>
		</td>
		<td>
			<td>
				<?php echo "<b>Address</b><br>" ,
		  		 CHtml::textArea('Address', $address,  array('rows'=>4, 'cols'=>20,'disabled'=>'disabled')); ?>
		</td>
		</td>
	</tr>
	
	<!-- ******** PRODUCT DETAILS *************** -->
	<tr>
		<td>
			<?php echo $form->labelEx($brandModel,'name'); ?>
			<?php echo $form->textField($brandModel,'name', array('disabled'=>'disabled')); ?>
			<?php echo $form->error($brandModel,'name'); ?>
		</td>
		<td>
			<?php echo $form->labelEx($productTypeModel,'name'); ?>
			<?php echo $form->textField($productTypeModel,'name', array('disabled'=>'disabled')); ?>
			<?php echo $form->error($productTypeModel,'name'); ?>
		</td>
	
	
	</tr>
	</table>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_status_id'); ?>
		<?php echo $form->textField($model,'job_status_id'); ?>
		<?php echo $form->error($model,'job_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fault_description'); ?>
		<?php echo $form->textField($model,'fault_description'); ?>
		<?php echo $form->error($model,'fault_description'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'contract_id'); ?>
		<?php //echo $form->textField($model,'contract_id'); ?>
		
		<?php echo $form->DropDownList($model, 'contract_id', $productModel->getAllContract());?>
		<?php echo $form->error($model,'contract_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'engineer_id'); ?>
		<?php //echo $form->textField($model,'engineer_id'); ?>
		<?php //echo CHtml::textField('',$engineerName,array('disabled'=>'disabled'));?>
		<?php echo $form->DropDownList($model, 'engineer_id', $productModel->getAllEngineers());?>
		<?php echo $form->error($model,'engineer_id'); ?>
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
		<?php echo $form->labelEx($model,'insurer_reference_number'); ?>
		<?php echo $form->textField($model,'insurer_reference_number'); ?>
		<?php echo $form->error($model,'insurer_reference_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fault_date'); ?>
		<?php echo $form->textField($model,'fault_date'); ?>
		<?php echo $form->error($model,'fault_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fault_code'); ?>
		<?php echo $form->textField($model,'fault_code'); ?>
		<?php echo $form->error($model,'fault_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'engg_visit_date'); ?>
		<?php echo $form->textField($model,'engg_visit_date'); ?>
		<?php echo $form->error($model,'engg_visit_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'work_carried_out'); ?>
		<?php echo $form->textField($model,'work_carried_out'); ?>
		<?php echo $form->error($model,'work_carried_out'); ?>
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
		<?php echo $form->textField($model,'notes'); ?>
		<?php echo $form->error($model,'notes'); ?>
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


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->