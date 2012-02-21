<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'servicecall-updateServicecall-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php 
		$service_id=$_GET['id'];
		//echo "STR TO TIME :".strtotime($model->job_payment_date)."<br>";
		//echo "CONVERTED DATE FROM STR TO TIME :".date('d-M-y', strtotime($model->job_payment_date));
		//echo "SERVICE ID FROM URL :".$service_id;
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
		$enggDiaryModel=Enggdiary::model()->findByPk($model->engg_diary_id);
		
		//address of customer.
		$str1=$customerModel->address_line_1." ".$customerModel->address_line_2." ".$customerModel->address_line_3."\n";
		$str2=$customerModel->town."\n";
		$str3=$customerModel->postcode;
		$address=$str1." ".$str2." ".$str3;
		
		//CALCULATING VALID UNTILL.
	
		$php_warranty_date=$productModel->warranty_date;
		$php_waranty_months=$productModel->warranty_for_months;
		$warranty_until= strtotime(date("Y-M-d", $php_warranty_date) . " +".$php_waranty_months." month");
		$res=date('d-M-Y', $warranty_until);
		//echo $res;							
		
	?>
	

<table>
	<tr>
		<th></th>
		<th colspan="2"><h2>Service Ref. No.# <?php echo $model->service_reference_number;?></h2></th>
	</tr>

	<tr>
		<td>
			<h2>Customer Details</h2>
		</td>
		<td>
			<h2>Product Details</h2>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($customerModel,'fullname'); ?>
			<br>
			<?php echo $form->textField($customerModel,'fullname', array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'fullname'); ?>
			
			<?php echo "<br><b>Address</b><br>" ,
		  		 CHtml::textArea('Address', $address,  array('rows'=>4, 'cols'=>40,'disabled'=>'disabled')); ?>
		  	
		  	<?php echo $form->labelEx($customerModel,'telephone'); ?>
			<br>
			<?php echo $form->textField($customerModel,'telephone',array('disabled'=>'disabled')); ?>
			<?php echo $form->textField($customerModel,'mobile',array('disabled'=>'disabled')); ?>
			<br>
			<?php echo $form->labelEx($customerModel,'email'); ?>
			<br>
			<?php echo $form->textField($customerModel,'email',array('disabled'=>'disabled')); ?>
			<br>
			<?php echo $form->labelEx($customerModel,'notes'); ?>
			<?php echo $form->textArea($customerModel,'notes',array('disabled'=>'disabled', 'rows'=>4, 'cols'=>40)); ?>
		</td>
		<td>
			<table>
			<tr>
				<td>
					<?php echo $form->labelEx($brandModel,'name'); ?>
					<?php echo $form->textField($brandModel,'name', array('disabled'=>'disabled')); ?>
					
					<?php echo $form->labelEx($productTypeModel,'name'); ?>
					<?php echo $form->textField($productTypeModel,'name', array('disabled'=>'disabled')); ?>
					
					<?php echo $form->labelEx($productModel,'model_number'); ?>
					<?php echo $form->textField($productModel,'model_number',array('disabled'=>'disabled')); ?>
				
					<?php echo $form->labelEx($productModel,'serial_number'); ?>
					<?php echo $form->textField($productModel,'serial_number',array('disabled'=>'disabled')); ?>
					
					<?php echo $form->labelEx($productModel,'enr_number'); ?>
					<?php echo $form->textField($productModel,'enr_number',array('disabled'=>'disabled')); ?>
					
				</td>
				<td>
					
					<?php echo $form->labelEx($productModel,'purchased_from'); ?>
					<?php echo $form->textField($productModel,'purchased_from', array('disabled'=>'disabled')); ?>
					
					<?php $viewPurchaseDate=date('d-M-y', $productModel->purchase_date);?>
					<?php echo $form->labelEx($productModel,'purchase_date'); ?>
					<?php echo CHtml::textField('',$viewPurchaseDate,  array('disabled'=>'disabled')); ?>
					<?php //echo $form->textField($productModel,'purchase_date', array('disabled'=>'disabled')); ?>
					
					<?php $viewWarrantyDate=date('d-M-y', $productModel->warranty_date);?>
					<?php echo $form->labelEx($productModel,'warranty_date'); ?>
					<?php echo CHtml::textField('',$viewWarrantyDate,  array('disabled'=>'disabled')); ?>
					<?php //echo $form->textField($productModel,'warranty_date',array('disabled'=>'disabled')); ?>
				
					<?php echo $form->labelEx($productModel,'warranty_until'); ?>
					<?php 
						echo CHtml::textField('Warranty Date',$res,  array('disabled'=>'disabled'));
					?>
					
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
				</table><!-- end of product table -->
			</td>
		</tr>
<tr><td colspan="2" style="text-align:center">
		<h2>Service Call Details</h2>
		</td>
	</tr>
	
	<tr>
		<td>
		<?php $viewFaultDate=date('d-M-y', $model->fault_date);?>
		<?php echo $form->labelEx($model,'fault_date'); ?>
		<br>
		<?php echo CHtml::textField('',$viewFaultDate,array('disabled'=>'disabled')); ?>
		<br>
		<?php echo $form->labelEx($model,'fault_code'); ?>
		<br>
		<?php echo $form->textField($model,'fault_code',array('disabled'=>'disabled')); ?>
		<br>
		<?php echo $form->labelEx($model,'fault_description'); ?>
		<br>
		<?php echo $form->textArea($model,'fault_description',array('rows'=>4, 'cols'=>40, 'disabled'=>'disabled')); ?>
	</td>
	<td style="vertical-align:top;">
	
		<table><tr><td>
		<?php $viewVisitStartDate= date('d-M-y', $enggDiaryModel->visit_start_date);?>
		<?php echo $form->labelEx($enggDiaryModel,'visit_start_date'); ?>
		<br>
		<?php echo CHtml::textField('',$viewVisitStartDate,  array('disabled'=>'disabled')); ?>
		</td><td>
		<?php echo $form->labelEx($model,'engineer_id'); ?>
		<br>
		<?php echo $form->DropDownList($model, 'engineer_id', $productModel->getAllEngineers(), array('disabled'=>'disabled')); ?>
		<br>
		</td></tr>
		<tr><td>
		<?php echo $form->labelEx($model,'insurer_reference_number'); ?>
		<br>
		<?php echo $form->textField($model,'insurer_reference_number'); ?>
		<br></td><td>
		<?php $model->contract_id=$productModel->contract->id; ?>
		<?php echo $form->labelEx($model,'contract_id'); ?>
		<br> 
		<?php echo CHtml::activeDropDownList($model,'contract_id', $model->getAllContract(),array('disabled'=>'disabled')); ?>
		</td></tr></table>
	</td>
	</tr>
		
		<tr><td colspan="2" style="text-align:center">
		<h2>Post Service Details</h2>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $form->labelEx($model,'spares_used_status_id'); ?>
			<?php echo $form->dropDownList($model, 'spares_used_status_id', array('0'=>'Yes', '1'=>'No' ),array('disabled'=>'disabled')); ?>
			<br>			
			<?php echo $form->labelEx($model,'work_carried_out'); ?>
			<?php echo $form->textArea($model,'work_carried_out', array('rows'=>4, 'cols'=>'30', ),array('disabled'=>'disabled')); ?>
			<br>
			
			<?php $job_payment_date=date('d-M-y', $model->job_payment_date);?>
			<?php echo $form->labelEx($model,'job_payment_date'); ?>
			<?php echo CHtml::textField('',$job_payment_date,  array('disabled'=>'disabled')); ?>			
			<br>
			<br>
			<?php $job_finished_date=date('d-M-y', $model->job_finished_date);?>
			<?php echo $form->labelEx($model,'job_finished_date'); ?>
			<?php echo CHtml::textField('',$job_finished_date, array('disabled'=>'disabled')); ?>
						
			

			</td>
		<td>
			<table>
				<tr><td>
					<?php echo $form->labelEx($model,'total_cost'); ?>
					</td>
					<td>
					<?php echo $form->textField($model,'total_cost',array('disabled'=>'disabled')); ?>
					</td>
				</tr>
				<tr><td>
					<?php echo $form->labelEx($model,'vat_on_total'); ?>
					</td>
					<td>
					<?php echo $form->textField($model,'vat_on_total', array('disabled'=>'disabled')); ?>
					</td>
				</tr>
				<tr><td>
					<?php echo $form->labelEx($model,'net_cost'); ?>
					</td>
					<td>
					<?php echo $form->textField($model,'net_cost', array('disabled'=>'disabled')); ?>
					</td>
				</tr>
			</table>
			<?php echo $form->labelEx($model,'notes'); ?><br>
			<?php echo $form->textArea($model,'notes',array('rows'=>4, 'cols'=>33),array('disabled'=>'disabled')); ?>
		</td>
		
	</tr>
	
	
	
	
</table>
<?php $this->endWidget(); ?>
