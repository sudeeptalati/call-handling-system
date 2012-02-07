<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'servicecall-existingCustomer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<!-- FIRST PART DISPLAYING CUSTOMER DETAILS -->
	
	<?php 
	$cust_id=$_GET['customer_id'];
	$customerModel=Customer::model()->findByPk($cust_id);
	
	$productModel=Product::model()->findByAttributes(
								array('customer_id'=>$cust_id)
								);
								
	//echo "PRODUCT ID :".$productModel->id; 
	?>
	
	<div class="row">
	<table>
	<tr>
		<td>
		<?php echo $form->labelEx($customerModel,'title'); ?>
		<?php echo $form->textField($customerModel,'title',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($customerModel,'title'); ?>
		</td>

		<td>
		<?php echo $form->labelEx($customerModel,'first_name'); ?>
		<?php echo $form->textField($customerModel,'first_name',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($customerModel,'first_name'); ?>
		</td>

		<td>
		<?php echo $form->labelEx($customerModel,'last_name'); ?>
		<?php echo $form->textField($customerModel,'last_name',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($customerModel,'last_name'); ?>
		</td>
		
	</tr>
	</table>
	</div>
	
	<!-- END OF CUSTOMER DETAILS -->
	
	<!-- SECOND PART OF FORM TO ENTER SERVICECALL DETAILS -->
	
	<h4>Service call details</h4>
	<div class="row">
		<?php echo $form->labelEx($model,'job_status_id'); ?>
		<?php echo "Draft";?>
		<?php //echo $form->textField($model,'job_status_id'); ?>
		<?php echo $form->error($model,'job_status_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fault_description'); ?>
		<?php echo $form->textField($model,'fault_description'); ?>
		<?php echo $form->error($model,'fault_description'); ?>
	</div>

	<div class="row">
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

	<div class="row">
		<?php echo $form->labelEx($model,'contract_id'); ?>
		<?php echo $form->textField($model,'contract_id'); ?>
		<?php echo $form->error($model,'contract_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'engineer_id'); ?>
		<?php echo $form->textField($model,'engineer_id'); ?>
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
	
	<!--<div class="row">
		<?php echo $form->labelEx($model,'created_by_user_id'); ?>
		<?php echo $form->textField($model,'created_by_user_id'); ?>
		<?php echo $form->error($model,'created_by_user_id'); ?>
	</div>

	-->

	<!--<div class="row">
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
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->