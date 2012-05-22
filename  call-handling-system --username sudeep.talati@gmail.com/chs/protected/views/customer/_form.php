<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($model); ?>
	
	<?php 
		if(!empty($model->product->id))
		{
			$productModel=Product::model()->findByPk($model->product_id);
		}
		else 
		{
			$productModel=Product::model();
		}
		
	?>
	
	<!-- ******* DISPLAYING CUSTOMER  ********* -->
	
	<table>
	<tr>
		<td>
			<h2>Customer Details</h2>
		</td>
		<td>
			<h2>Product Details</h2>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">
			<?php echo $form->labelEx($model,'title'); ?>
			<?php echo $form->dropDownList($model,'title',array('Mr'=>'Mr', 'Miss'=>'Miss', 'Mrs'=>'Mrs','Mrs'=>'Mrs', 'Dr'=>'Dr',)); ?>
			<?php echo $form->error($model,'title'); ?>
			
			<?php echo $form->labelEx($model,'first_name'); ?>
			<?php echo $form->textField($model,'first_name',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'first_name'); ?>
			
			<?php echo $form->labelEx($model,'last_name'); ?>
			<?php echo $form->textField($model,'last_name',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'last_name'); ?>
			
			<?php echo $form->labelEx($model,'address_line_1'); ?>
			<?php echo $form->textField($model,'address_line_1',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'address_line_1'); ?>
			
			<?php echo $form->labelEx($model,'address_line_2'); ?>
			<?php echo $form->textField($model,'address_line_2',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'address_line_2'); ?>
			
			<?php echo $form->labelEx($model,'address_line_3'); ?>
			<?php echo $form->textField($model,'address_line_3',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'address_line_3'); ?>
			
			<?php echo $form->labelEx($model,'town'); ?>
			<?php echo $form->textField($model,'town',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'town'); ?>
			
			<?php echo $form->labelEx($model,'postcode_s'); ?>
			<?php echo $form->textField($model,'postcode_s',array('size'=>6, 'maxlength'=>4)); ?>
			<?php echo $form->textField($model,'postcode_e',array('size'=>6, 'maxlength'=>4)); ?>
			<?php echo $form->error($model,'postcode_s'); ?>
			<?php echo $form->error($model,'postcode_e'); ?>
			
			<?php
					$config=Config::model()->findByPk(1);
				 	$postcodeanwhere_account_code=$config->postcodeanywhere_account_code;
					$postcodeanwhere_license_key=$config->postcodeanywhere_license_key;
			?>
			<SCRIPT LANGUAGE=JAVASCRIPT SRC="http://services.postcodeanywhere.co.uk/popups/javascript.aspx?account_code=<?php echo $postcodeanwhere_account_code; ?>&license_key=<?php echo $postcodeanwhere_license_key; ?>"></SCRIPT>
		
			<?php echo $form->labelEx($model,'country'); ?>
			<?php echo $form->textField($model,'country',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'country'); ?>
	
			<?php echo $form->labelEx($model,'telephone'); ?>
			<?php echo $form->textField($model,'telephone',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'telephone'); ?>
			
			<?php echo $form->labelEx($model,'mobile'); ?>
			<?php echo $form->textField($model,'mobile',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'mobile'); ?>
			
			<?php echo $form->labelEx($model,'fax'); ?>
			<?php echo $form->textField($model,'fax',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'fax'); ?>
			
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'email'); ?>
			<small style="color:maroon"><br>User will be notified via email.</small>
			
			<?php echo $form->hiddenField($model,'lockcode',array('value'=>0)); ?>
			<?php echo $form->error($model,'lockcode'); ?>
			
			<?php echo $form->labelEx($model,'notes'); ?>
			<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>30)); ?>
			<?php echo $form->error($model,'notes'); ?>
		</td>
	
		<!-- ************ DISPLAYING PRODUCT DETAILS *********** -->
		<td>
		<div class="row">
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
			
			<?php echo $form->labelEx($productModel,'purchased_from'); ?>
			<?php echo $form->textField($productModel,'purchased_from',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($productModel,'purchased_from'); ?>
			
			<?php //echo $form->labelEx($productModel,'customer_id'); ?>
			<?php //CUSTOMER ID SET TO ZERO TO CHECK WHETHER NEW CUSTOMER.?>
			<?php echo $form->hiddenField($productModel,'customer_id',array('value'=>0)); ?>
			<?php echo $form->error($productModel,'customer_id'); ?>
			
			<?php //echo $form->labelEx($productModel,'purchase_date'); ?>
			<?php //echo $form->textField($productModel,'purchase_date'); ?>
			<?php //echo $form->error($productModel,'purchase_date'); ?>

				
	<?php echo $form->labelEx($productModel,'purchase_date'); ?>
		<?php 
			if(!empty($productModel->purchase_date))
			{
				$productModel->purchase_date = date('d-m-Y', $productModel->purchase_date);
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
		<?php //echo $form->textField($model,'fault_date'); ?>
		<?php echo $form->error($productModel,'warranty_date'); ?>
		
		<?php echo $form->labelEx($productModel,'warranty_date'); ?>
		<?php 
			
			if(!empty($productModel->warranty_date))
			{
				$productModel->warranty_date = date('d-m-Y', $productModel->warranty_date);
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
		<?php //echo $form->textField($model,'fault_date'); ?>
		<?php echo $form->error($productModel,'warranty_date'); ?>
		
			
			
			
	
			<?php echo $form->labelEx($productModel,'model_number'); ?>
			<?php echo $form->textField($productModel,'model_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($productModel,'model_number'); ?>
			
			<?php echo $form->labelEx($productModel,'serial_number'); ?>
			<?php echo $form->textField($productModel,'serial_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($productModel,'serial_number'); ?>
			
			<?php echo $form->labelEx($productModel,'production_code'); ?>
			<?php echo $form->textField($productModel,'production_code',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($productModel,'production_code'); ?>
			
			<?php echo $form->labelEx($productModel,'enr_number'); ?>
			<?php echo $form->textField($productModel,'enr_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($productModel,'enr_number'); ?>
			
			<?php echo $form->labelEx($productModel,'fnr_number'); ?>
			<?php echo $form->textField($productModel,'fnr_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($productModel,'fnr_number'); ?>
			
			<?php echo $form->labelEx($productModel,'discontinued'); ?>
			<?php echo $form->textField($productModel,'discontinued'); ?>
			<?php echo $form->error($productModel,'discontinued'); ?>
			
			<?php echo $form->labelEx($productModel,'warranty_for_months'); ?>
			<?php echo $form->textField($productModel,'warranty_for_months'); ?>
			<?php echo $form->error($productModel,'warranty_for_months'); ?>
			
			<?php echo $form->labelEx($productModel,'purchase_price'); ?>
			<?php echo $form->textField($productModel,'purchase_price'); ?>
			<?php echo $form->error($productModel,'purchase_price'); ?>
			
			<?php echo $form->labelEx($productModel,'notes'); ?>
			<?php echo $form->textArea($productModel,'notes',array('rows'=>6, 'cols'=>30)); ?>
			<?php echo $form->error($productModel,'notes'); ?>
			</td>
			<td colspan="2" style="vertical-align:top;">
				<?php echo $form->labelEx($productModel,'engineer_id'); ?>
				<?php //echo $form->textField($model,'engineer_id'); ?>
				<?php echo CHtml::activeDropDownList($productModel, 'engineer_id', $productModel->getAllEngineers());?>
				<?php echo $form->error($productModel,'engineer_id'); ?>
				
				<?php echo $form->labelEx($productModel,'product_type_id'); ?>
				<?php //echo $form->textField($model,'product_type_id'); ?>
				<?php echo CHtml::activeDropDownList($productModel, 'product_type_id', $productModel->getProductTypes());?>
				<?php echo $form->error($productModel,'product_type_id'); ?>
			
			</td>
			</tr>
		</table>
		</div>
	</td>
	</tr>
	</table>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Register' : 'Modify'); ?>
	</div>
	
	<?php // }//end of else of count($result).?>
<?php $this->endWidget(); ?>

</div><!-- form -->