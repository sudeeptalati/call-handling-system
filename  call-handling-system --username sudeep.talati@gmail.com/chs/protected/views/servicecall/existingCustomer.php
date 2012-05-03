<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'servicecall-existingCustomer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	
	
	<?php 
	$cust_id=$_GET['customer_id'];
	$prod_id=$_GET['product_id'];
	//echo $prod_id;
	
	
	
	//TO GET CUSTOMER DETAILS.
	$customerModel=Customer::model()->findByPk($cust_id);
	$str1=$customerModel->address_line_1;
	$str2=$customerModel->address_line_2;
	$str3=$customerModel->address_line_3."\n";
	$str4=$customerModel->town."\n";
	$str5=$customerModel->postcode_s." ".$customerModel->postcode_e;
	$address=$str1." ".$str2." ".$str3." ".$str4." ".$str5;
	//echo "address :".$address;
	

	//TO GET PRODUCT DETAILS.
//	$productModel=Product::model()->findByAttributes(
//								array('customer_id'=>$cust_id)
//								);

	$productModel=Product::model()->findByPk($prod_id);
	//CALCULATING VALID UNTILL.
	
	$php_warranty_date=$productModel->warranty_date;
	$php_waranty_months=$productModel->warranty_for_months;

	$res='';
	if (!empty($php_warranty_date))
	{
	$warranty_until= strtotime(date("Y-M-d", $php_warranty_date) . " +".$php_waranty_months." month");
	$res=date('d-M-Y', $warranty_until);
	//echo $res;							
	}							
	
	
	$brandModel=Brand::model()->findByPk($productModel->brand_id);
	$productTypeModel=ProductType::model()->findByPk($productModel->product_type_id);
								
	$model->engineer_id=$productModel->engineer_id;
	//echo $productModel->engineer->fullname;
								
	//echo "PRODUCT ID :".$productModel->id; 
	?>
	
	<!-- ***** FIRST PART DISPLAYING CUSTOMER DETAILS ******* -->
	
	<table>
	<tr><td>
			<h2>Customer Details</h2>
		</td>
		<td>	
			<h2>Product Details</h2>
		</td>		
	</tr>
	<tr>
	<td style="vertical-align:top;">
		<?php echo $form->labelEx($customerModel,'fullname'); ?>
		<?php echo $form->textField($customerModel,'fullname',array('disabled'=>'disabled')); ?>
		
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo CHtml::textArea('Address', $address,  array('disabled'=>'disabled','rows'=>4, 'cols'=>40)); ?>
		
		<?php echo $form->labelEx($customerModel,'telephone'); ?>
		<?php echo $form->textField($customerModel,'telephone',array('disabled'=>'disabled')),"<br>"; ?>
		
		<?php echo $form->textField($customerModel,'mobile',array('disabled'=>'disabled')); ?>
		
		<?php echo $form->labelEx($customerModel,'email'); ?>
		<?php echo $form->textField($customerModel,'email',array('disabled'=>'disabled')); ?>
		
		<?php echo $form->labelEx($customerModel,'notes'); ?>
		<?php echo $form->textArea($customerModel,'notes',array('disabled'=>'disabled', 'rows'=>4, 'cols'=>40)); ?>
		
	</td>
	
	<!-- END OF CUSTOMER DETAILS -->
	
	<!-- ***** SECOND PART DISPLAYING PRODUCT DETAILS ******* -->
	<?php 
		
		?>
	<td>
	<div class="row">
	<table>
	<tr>
		<td>
		<?php echo $form->labelEx($brandModel,'name'); ?>
		<?php echo $form->textField($brandModel,'name',array('disabled'=>'disabled')); ?>
		
		
		<?php echo $form->labelEx($productTypeModel,'name'); ?>
		<?php echo $form->textField($productTypeModel,'name',array('disabled'=>'disabled')); ?>
		
		
		<?php echo $form->labelEx($productModel,'model_number'); ?>
		<?php echo $form->textField($productModel,'model_number',array('disabled'=>'disabled')); ?>
		
		<?php echo $form->labelEx($productModel,'serial_number'); ?>
		<?php echo $form->textField($productModel,'serial_number',array('disabled'=>'disabled')); ?>
		
		</td>
		<td>
		<?php echo $form->labelEx($productModel,'purchased_from'); ?>
		<?php echo $form->textField($productModel,'purchased_from',array('disabled'=>'disabled')); ?>
		
		
		
		<?php 
				if (!empty($productModel->purchase_date))
				{
					$productModel->purchase_date=date('d-M-y', $productModel->purchase_date);
				}
				 echo $form->labelEx($productModel,'purchase_date');
				 echo $form->textField($productModel,'purchase_date',array('disabled'=>'disabled')); 
				 //echo CHtml::textField('Purchase Date',$viewPurschaseDate,  array('disabled'=>'disabled')); 
				
				?>
		
		<?php 	//$viewWarrantyDate='';
				if (!empty($productModel->warranty_date))
				{
					$productModel->warranty_date=date('d-M-y', $productModel->warranty_date);
				}
				?>
		<?php echo $form->labelEx($productModel,'warranty_date'); ?>
		<?php echo $form->textField($productModel,'warranty_date',array('disabled'=>'disabled')); ?>
		<?php //echo CHtml::textField('Purchase Date',$viewWarrantyDate,  array('disabled'=>'disabled')); ?>
		
		<?php echo $form->labelEx($productModel,'warranty_until'); ?>
		<?php 
			echo CHtml::textField('Warranty Date',$res,  array('disabled'=>'disabled'));
		?>
		</td>
	</tr>
	<tr>
		<td>
		<?php echo $form->labelEx($productModel,'enr_number'); ?>
		<?php echo $form->textField($productModel,'enr_number',array('disabled'=>'disabled')); ?>
		
		</td>
		<td>
		<?php echo $form->labelEx($productModel,'fnr_number'); ?>
		<?php echo $form->textField($productModel,'fnr_number',array('disabled'=>'disabled')); ?>
		
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<?php echo $form->labelEx($productModel,'notes'); ?>
		<?php echo $form->textArea($productModel,'notes',array('disabled'=>'disabled', 'rows'=>4, 'cols'=>40)); ?>
		
		</td>
	</tr>
	</table>
	<!-- end of product service table -->
	
	<!-- ******************* PREVIOUS SERVICECALLS RECORD *************** -->
	
	<tr><td colspan="6">
		<?php $model->previousCall($cust_id,$prod_id);?>
	</td></tr>
	<!-- ******************* END OF PREVIOUS SERVICECALLS RECORD *************** -->
	
	
	<!-- ****** THIRD PART OF FORM TO ENTER SERVICECALL DETAILS ****** -->
	
	<tr><td colspan="2" style="text-align:center">
		<h2>Service Call Details</h2>
		</td>
	</tr>
	
	<tr><td>
	<?php echo $form->labelEx($model,'fault_date'); ?>
		<?php 
		
			$model->fault_date=date('d-m-Y');
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>CHtml::activeName($model, 'fault_date'),
				'model'=>$model,
        		'value' => $model->attributes['fault_date'],
			    // additional javascript options for the date picker plugin
			    'options'=>array(
			        'showAnim'=>'fold',
					'dateFormat' => 'dd-mm-yy',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'height:20px;'
			    ),
			));
		?>
		<?php //echo $form->textField($model,'fault_date'); ?>
		<?php echo $form->error($model,'fault_date'); ?>
		
				<?php echo $form->labelEx($model,'fault_code'); ?>
		<?php echo $form->textField($model,'fault_code'); ?>
		<?php echo $form->error($model,'fault_code'); ?>
		
		<?php echo $form->labelEx($model,'fault_description'); ?>
		<?php echo $form->textArea($model,'fault_description',array('rows'=>4, 'cols'=>40)); ?>
		<?php echo $form->error($model,'fault_description'); ?>
	</td>
	<td>
	<?php echo $form->labelEx($model,'insurer_reference_number'); ?>
		<?php echo $form->textField($model,'insurer_reference_number'); ?>
		<?php echo $form->error($model,'insurer_reference_number'); ?>
		
		<?php //echo '<br><b>Current contract :',
//		 CHtml::textField('', $productModel->contract->name, array('disabled'=>'disabled'));?>
		 <?php //echo CHtml::textField('', $productModel->contract->id, array('disabled'=>'disabled'));?>
		<?php $model->contract_id=$productModel->contract->id; ?>
		<?php echo $form->labelEx($model,'contract_id'); ?>
		<?php //echo $form->hiddenField($model,'contract_id'); ?>
		<?php echo CHtml::activeDropDownList($model,'contract_id', $model->getAllContract()); ?>
		<?php echo $form->error($model,'contract_id'); ?>
		
		<?php echo $form->labelEx($model,'recalled_job'); ?>
		<?php echo $form->dropDownList($model,'recalled_job',array('1'=>'Yes', '0'=>'No')); ?>
		<?php echo $form->error($model,'recalled_job'); ?>
		
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>4, 'cols'=>30)); ?>
		<?php echo $form->error($model,'notes'); ?>
	

	</td>
	</tr>
	<tr><td colspan="2">
	<?php 
		echo $form->labelEx($model,'engineer_id');
		echo $form->DropDownList($model, 'engineer_id', $productModel->getAllEngineers());
		echo $form->error($model,'engineer_id');
	?>
	</td></tr>
	</table>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->