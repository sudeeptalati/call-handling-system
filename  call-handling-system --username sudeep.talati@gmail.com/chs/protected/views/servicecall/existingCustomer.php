<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'servicecall-existingCustomer-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	
	
	<?php 
	$cust_id=$_GET['customer_id'];
	
	//TO GET CUSTOMER DETAILS.
	$customerModel=Customer::model()->findByPk($cust_id);
	$str1=$customerModel->address_line_1;
	$str2=$customerModel->address_line_2;
	$str3=$customerModel->address_line_3."\n";
	$str4=$customerModel->town."\n";
	$str5=$customerModel->postcode;
	$address=$str1." ".$str2." ".$str3." ".$str4." ".$str5;
	//echo "address :".$address;
	
	
	//TO GET PRODUCT DETAILS.
	$productModel=Product::model()->findByAttributes(
								array('customer_id'=>$cust_id)
								);
	//CALCULATINF TIME DIFFERENCE.								
	$today=time();
	$dateToday=date('d-m-Y', $today);
	//echo $dateToday;
	$warrantyDate=$productModel->warranty_date;
	//echo "<hr> warranty date :".$warrantyDate;
	$strToday=strtotime($dateToday);
	$strWarranty=strtotime($warrantyDate);
	$diffTime=$strWarranty-$strToday;
	//echo "<hr>time diff :".$diffTime;
	$days=$diffTime/(60*60*24);
	//echo "<hr>diff in days :".$days;
	$months=floor($diffTime/(60*60*24*31));
	//echo "<hr>time diff in months :".$months;
	
	$brandModel=Brand::model()->findByPk($productModel->brand_id);
	$productTypeModel=ProductType::model()->findByPk($productModel->product_type_id);
								
									
								
	//echo "PRODUCT ID :".$productModel->id; 
	?>
	
	<!-- ***** FIRST PART DISPLAYING CUSTOMER DETAILS ******* -->
	<h2>Customer Details</h2>
	
	<div class="row">
	<table>
	<tr>
		<td>
		<?php echo $form->labelEx($customerModel,'fullname'); ?>
		<?php echo $form->textField($customerModel,'fullname',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($customerModel,'fullname'); ?>
		</td>
		<td>
		<?php echo $form->labelEx($customerModel,'telephone'); ?>
		<?php echo $form->textField($customerModel,'telephone',array('disabled'=>'disabled')),"<br>"; ?>
		<?php echo $form->textField($customerModel,'mobile',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($customerModel,'telephone'); ?>
		</td>
		<td>
		<?php echo $form->labelEx($customerModel,'email'); ?>
		<?php echo $form->textField($customerModel,'email',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($customerModel,'email'); ?>
		</td>
	</tr>
	<tr>
		<td>
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo CHtml::textArea('Address', $address,  array('disabled'=>'disabled')); ?>
		</td>
		<td>
		<?php echo $form->labelEx($customerModel,'notes'); ?>
		<?php echo $form->textArea($customerModel,'notes',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($customerModel,'notes'); ?>
		</td>
	</tr>
	</table>
	</div>
	
	<!-- END OF CUSTOMER DETAILS -->
	
	<!-- ***** SECOND PART DISPLAYING PRODUCT DETAILS ******* -->
	
	<h2>Product Details</h2>
	
	<div class="row">
	<table>
	<tr>
		<td>
		<?php echo $form->labelEx($brandModel,'name'); ?>
		<?php echo $form->textField($brandModel,'name',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($brandModel,'name'); ?>
		</td>
		<td>
		<?php echo $form->labelEx($productTypeModel,'name'); ?>
		<?php echo $form->textField($productTypeModel,'name',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($productTypeModel,'name'); ?>
		</td>
		<td>
		<?php echo $form->labelEx($productModel,'purchased_from'); ?>
		<?php echo $form->textField($productModel,'purchased_from',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($productModel,'purchased_from'); ?>
		</td>
	</tr>
	<tr>
		<td>
		<?php echo $form->labelEx($productModel,'purchase_date'); ?>
		<?php echo $form->textField($productModel,'purchase_date',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($productModel,'purchase_date'); ?>
		</td>
		<td>
		<?php echo $form->labelEx($productModel,'warranty_date'); ?>
		<?php echo $form->textField($productModel,'warranty_date',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($productModel,'warranty_date'); ?>
		</td>
		<td>
		<?php 
			if($months<=0)
			{
				echo "<b>Warranty for (months)</b><br>";
				echo CHtml::textField('','Warranty Period Experied', array('disabled'=>'disabled'));
			}
			else
			{
				echo "<b>Warranty for (months)</b><br>";
				echo CHtml::textField('Warranty Date',$months,  array('disabled'=>'disabled'));
			}
		?>
		</td>
	</tr>
	<tr>
		<td>
		<?php echo $form->labelEx($productModel,'model_number'); ?>
		<?php echo $form->textField($productModel,'model_number',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($productModel,'model_number'); ?>
		</td>
		<td>
		<?php echo $form->labelEx($productModel,'serial_number'); ?>
		<?php echo $form->textField($productModel,'serial_number',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($productModel,'serial_number'); ?>
		</td>
	</tr>
	<tr>
		<td>
		<?php echo $form->labelEx($productModel,'enr_number'); ?>
		<?php echo $form->textField($productModel,'enr_number',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($productModel,'enr_number'); ?>
		</td>
		<td>
		<?php echo $form->labelEx($productModel,'fnr_number'); ?>
		<?php echo $form->textField($productModel,'fnr_number',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($productModel,'fnr_number'); ?>
		</td>
	</tr>
	<tr>
		<td>
		<?php echo $form->labelEx($productModel,'notes'); ?>
		<?php echo $form->textArea($productModel,'notes',array('disabled'=>'disabled')); ?>
		<?php echo $form->error($productModel,'notes'); ?>
		</td>
	</tr>
	
	</table>
	</div>
	
	
	<!-- ****** THIRD PART OF FORM TO ENTER SERVICECALL DETAILS ****** -->
	
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
		<?php echo $form->labelEx($model,'insurer_reference_number'); ?>
		<?php echo $form->textField($model,'insurer_reference_number'); ?>
		<?php echo $form->error($model,'insurer_reference_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fault_date'); ?>
		<?php 
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
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fault_code'); ?>
		<?php echo $form->textField($model,'fault_code'); ?>
		<?php echo $form->error($model,'fault_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'engg_visit_date'); ?>
		<?php 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>CHtml::activeName($model, 'engg_visit_date'),
				'model'=>$model,
        		'value' => $model->attributes['engg_visit_date'],
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
		<?php //echo $form->textField($model,'engg_visit_date'); ?>
		<?php echo $form->error($model,'engg_visit_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textField($model,'notes'); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->