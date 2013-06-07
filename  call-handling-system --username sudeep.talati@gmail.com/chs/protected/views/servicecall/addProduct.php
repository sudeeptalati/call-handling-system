<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'servicecall-addProduct-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>


	
	
	
	<?php 
		$cust_id=$_GET['cust_id'];
		//echo $cust_id;
		$customerModel=Customer::model()->findByPk($cust_id);
		$str = $customerModel->address_line_1." ".$customerModel->address_line_2." ".$customerModel->address_line_3."\n";
		$str1 =  $customerModel->town."\n";
		$str2 = $customerModel->postcode_s." ".$customerModel->postcode_e;
		$address = $str." ".$str1." ".$str2;
		
		$productModel = Product::model();
		
	?>
	
	<?php 
		echo $form->errorSummary($model);
		echo $form->errorSummary($productModel);
	?>
	
	<table>
	
	<tr><b><?php echo "Customer Details";?></b></tr>
	
	<tr>
	<td>
		<?php echo $form->labelEx($customerModel,'fullname'); ?>
		<?php echo $form->textField($customerModel,'fullname',array('disabled'=>'disabled')); ?>
	</td>
	<td>
		<b><?php echo "Address";?></b><br>
		<?php echo CHtml::textArea('',$address,array('disabled'=>'disabled','rows'=>3, 'cols'=>20));?>
	</td>
	</tr>
	</table>
	
	<table>
	
	<tr>
		<td><h3 style="margin-bottom:0.01px;">Service Call Details</h3></td>
	
		<td><h3 style="margin-bottom:0.01px;">Product Details</h3></td>
	</tr>
	
	<tr>
		<td style="vertical-align:top;">
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
			<?php echo $form->textArea($model,'fault_description',array('rows'=>3, 'cols'=>40)); ?>
			<?php echo $form->error($model,'fault_description'); ?>
					
			<?php echo $form->labelEx($model,'insurer_reference_number'); ?>
			<?php echo $form->textField($model,'insurer_reference_number'); ?>
			<?php echo $form->error($model,'insurer_reference_number'); ?>
					
			<?php //$model->contract_id=$productModel->contract->id; ?>
			<?php echo $form->labelEx($model,'contract_id'); ?>
			<?php //echo $form->hiddenField($model,'contract_id'); ?>
			<?php echo CHtml::activeDropDownList($model,'contract_id', $model->getAllContract()); ?>
			<?php echo $form->error($model,'contract_id'); ?>
				
			<?php echo $form->labelEx($model,'recalled_job'); ?>
			<?php echo $form->dropDownList($model,'recalled_job',array( '0'=>'No', '1'=>'Yes')); ?>
			<?php echo $form->error($model,'recalled_job'); ?>
				
			<?php echo $form->labelEx($model,'notes'); ?>
			<?php echo $form->textArea($model,'notes',array('rows'=>4, 'cols'=>40)); ?>
			<?php echo $form->error($model,'notes'); ?>
		
		</td>
		
		<td style="vertical-align:top;">
		<table>
		<tr>
			<td>
				<?php echo $form->labelEx($productModel,'contract_id'); ?>
				<?php //echo $form->textField($model,'contract_id'); ?>
				<?php echo CHtml::activeDropDownList($productModel, 'contract_id', $productModel->getAllContract());?>
				<?php echo $form->error($productModel,'contract_id'); ?>
				
				<?php echo $form->labelEx($productModel,'brand_id'); ?>
				<?php //echo $form->textField($model,'brand_id'); ?>
				<?php echo CHtml::activeDropDownList($productModel, 'brand_id', $productModel->getAllBrands());?>
				<?php echo $form->error($productModel,'brand_id'); ?>
				
				<?php echo $form->labelEx($productModel,'model_number'); ?>
				<?php echo $form->textField($productModel,'model_number',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($productModel,'model_number'); ?>
				
				<?php echo $form->labelEx($productModel,'serial_number'); ?>
				<?php echo $form->textField($productModel,'serial_number',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($productModel,'serial_number'); ?>
				
				<?php echo $form->labelEx($productModel,'enr_number'); ?>
				<?php echo $form->textField($productModel,'enr_number',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($productModel,'enr_number'); ?>
				
				<?php echo $form->labelEx($productModel,'fnr_number'); ?>
				<?php echo $form->textField($productModel,'fnr_number',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($productModel,'fnr_number'); ?>
				
				<?php echo $form->labelEx($productModel,'production_code'); ?>
				<?php echo $form->textField($productModel,'production_code',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($productModel,'production_code'); ?>
				
				<?php echo $form->labelEx($productModel,'purchase_price'); ?>
				<?php echo $form->textField($productModel,'purchase_price',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($productModel,'purchase_price'); ?>
				
				<?php echo $form->labelEx($productModel,'discontinued'); ?>
				<?php echo $form->textField($productModel,'discontinued',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($productModel,'discontinued'); ?>
				
			</td>
			<td>
				<?php echo $form->labelEx($productModel,'engineer_id'); ?>
				<?php //echo $form->textField($model,'engineer_id'); ?>
				<?php echo CHtml::activeDropDownList($productModel, 'engineer_id', Engineer::model()->getAllEnggAndCompany());?>
				<?php echo $form->error($productModel,'engineer_id'); ?>
				
				<?php echo $form->labelEx($productModel,'product_type_id'); ?>
				<?php //echo $form->textField($model,'product_type_id'); ?>
				<?php echo CHtml::activeDropDownList($productModel, 'product_type_id', $productModel->getProductTypes(), array('prompt'=>'N/A'));?>
				<?php echo $form->error($productModel,'product_type_id'); ?>
				
				<?php echo $form->labelEx($productModel,'purchased_from'); ?>
				<?php echo $form->textField($productModel,'purchased_from',array('rows'=>6, 'cols'=>50)); ?>
				<?php echo $form->error($productModel,'purchased_from'); ?>
				
				<?php echo $form->labelEx($productModel,'purchase_date'); ?>
				<?php //echo $form->textField($model,'purchase_date'); ?>
				<?php 
					if(!empty($productModel->purchase_date))
					{
						$productModel->purchase_date=date('d-m-Y');
					}
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					    'name'=>CHtml::activeName($productModel, 'purchase_date'),
						'model'=>$productModel,
		        		'value' => $productModel->attributes['purchase_date'],
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
				<?php echo $form->error($productModel,'warranty_date'); ?>
				
				<?php echo $form->labelEx($productModel,'warranty_date'); ?>
				<?php //echo $form->textField($model,'purchase_date'); ?>
				<?php 
					if(!empty($productModel->warranty_date))
					{
						$productModel->warranty_date=date('d-m-Y');
					}
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
					    'name'=>CHtml::activeName($productModel, 'warranty_date'),
						'model'=>$productModel,
		        		'value' => $productModel->attributes['warranty_date'],
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
				<?php echo $form->error($productModel,'warranty_date'); ?>
				
				<?php echo $form->labelEx($productModel,'warranty_for_months'); ?>
				<?php echo $form->textField($productModel,'warranty_for_months'); ?>
				<?php echo $form->error($productModel,'warranty_for_months'); ?>
				
				<?php echo $form->labelEx($productModel,'notes'); ?>
				<?php echo $form->textArea($productModel,'notes',array('rows'=>6, 'cols'=>30)); ?>
				<?php echo $form->error($productModel,'notes'); ?>
			</td>
		</tr>
		</table>
		</td>
		</tr>
		
		</table>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>
	
	

<?php $this->endWidget(); ?>

</div><!-- form -->