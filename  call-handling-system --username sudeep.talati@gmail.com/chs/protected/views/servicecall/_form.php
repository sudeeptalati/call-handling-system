<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'servicecall-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<!-- ***** FIRST PART DISPLAYING SERVICE CALL DETAILS ******* -->
	<table>
	<tr><td colspan="2" style="text-align:center">
		<h2>Service Call Details</h2>
		</td>
	</tr>
	
	<tr>
	<td style="vertical-align:top;">	
	

	
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
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>7, 'cols'=>40)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</td>

	</tr>
	<tr><td colspan="2"><hr></td></tr>
	<!-- FIELDS OF CUSTOMER AND PRODUCT FORM -->
	<tr	><td>
			<h2 style="margin-bottom:0.01px;">Customer Details</h2>
		</td>
		<td>	
			<h2 style="margin-bottom:0.01px;">Product Details</h2>
		</td>		
	</tr>
	
	<tr>
	<td style="vertical-align:top;">	
	<!-- ***** SECOND ROW - FIRST COLUMN PART DISPLAYING CUSTOMER DETAILS ******* -->
	<?php //SETTING CUSTOMER ID TO ZERO TO CHECK WEATHER NEW CUSTOMER OR NOT.?>
	<?php echo $form->hiddenField($model,'customer_id',array('value'=>'0')); ?>
	<?php echo $form->error($model,'customer_id'); ?>
	<?php 
	if(!empty($model->customer->id))
	{
		$customerModel=Customer::model()->findByPk($model->customer_id);
	}
	else 
	{
		$customerModel=Customer::model();
	}
	?>
	<?php echo $form->errorSummary($customerModel); ?>
	<div class="row">
		<?php echo $form->labelEx($customerModel,'title'); ?>
		<?php echo $form->dropDownList($customerModel,'title',array('Mr'=>'Mr', 'Miss'=>'Miss', 'Mrs'=>'Mrs','Mrs'=>'Mrs', 'Dr'=>'Dr',)); ?>
		<?php echo $form->error($customerModel,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'first_name'); ?>
		<?php echo $form->textField($customerModel,'first_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'last_name'); ?>
		<?php echo $form->textField($customerModel,'last_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'last_name'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->labelEx($customerModel,'product_id'); ?>
		<?php echo $form->textField($customerModel,'product_id'); ?>
		<?php echo $form->error($customerModel,'product_id'); ?>
	</div>

	--><div class="row">
		<?php echo $form->labelEx($customerModel,'address_line_1'); ?>
		<?php echo $form->textField($customerModel,'address_line_1',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'address_line_1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'address_line_2'); ?>
		<?php echo $form->textField($customerModel,'address_line_2',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'address_line_2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'address_line_3'); ?>
		<?php echo $form->textField($customerModel,'address_line_3',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'address_line_3'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'town'); ?>
		<?php echo $form->textField($customerModel,'town',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'town'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'postcode'); ?>
		<?php echo $form->textField($customerModel,'postcode',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'postcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'country'); ?>
		<?php echo $form->textField($customerModel,'country',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'telephone'); ?>
		<?php echo $form->textField($customerModel,'telephone',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'telephone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'mobile'); ?>
		<?php echo $form->textField($customerModel,'mobile',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'mobile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'fax'); ?>
		<?php echo $form->textField($customerModel,'fax',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'fax'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'email'); ?>
		<?php echo $form->textField($customerModel,'email',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($customerModel,'notes'); ?>
		<?php echo $form->textArea($customerModel,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($customerModel,'notes'); ?>
	</div>
	
	</td>
	
	<td style="vertical-align:top;">
	<!-- FIELDS FROM PRODUCT TABLE -->
	<table>
	<tr>
		<td style="vertical-align:top;">
	
	<?php 
	if(!empty($model->product_id))
	{
		$productModel=Product::model()->findByPk($model->product_id);
	}
	else 
	{
		$productModel=Product::model();
	}
	?>
	
	
	
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
	</td>
	
	
	<td style="vertical-align:top;">

	


	<div class="row">
		<?php echo $form->labelEx($productModel,'warranty_date'); ?>
		<?php 
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
		<?php //echo $form->textField($productModel,'warranty_date'); ?>
		<?php echo $form->error($productModel,'warranty_date'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($productModel,'contract_id'); ?>
		<?php //echo $form->textField($model,'contract_id'); ?>
		<?php echo CHtml::activeDropDownList($productModel, 'contract_id', $productModel->getAllContract());?>
		<?php echo $form->error($productModel,'contract_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'warranty_for_months'); ?>
		<?php echo $form->textField($productModel,'warranty_for_months'); ?>
		<?php echo $form->error($productModel,'warranty_for_months'); ?>
	</div>
	</td></tr>

	<tr>
		<td>
		<?php echo $form->labelEx($productModel,'enr_number'); ?>
		<?php echo $form->textField($productModel,'enr_number'); ?>
		<?php echo $form->error($productModel,'enr_number'); ?>
		</td>
		<td>
		<?php echo $form->labelEx($productModel,'fnr_number'); ?>
		<?php echo $form->textField($productModel,'fnr_number'); ?>
		<?php echo $form->error($productModel,'fnr_number'); ?>
		</td>
	</tr>
	
	
	<tr><td colspan="2"><br>	<i>Purchase Details</i></td></tr>
	<tr>
	
	<td style="vertical-align:top;">


		<div class="row">
		<?php echo $form->labelEx($productModel,'purchased_from'); ?>
		<?php echo $form->textField($productModel,'purchased_from',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($productModel,'purchased_from'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($productModel,'purchase_date'); ?>
		<?php 
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
		<?php //echo $form->textField($productModel,'purchase_date'); ?>
		<?php echo $form->error($productModel,'purchase_date'); ?>
	</div>
	
		<div class="row">
		<?php echo $form->labelEx($productModel,'purchase_price'); ?>
		<?php echo $form->textField($productModel,'purchase_price'); ?>
		<?php echo $form->error($productModel,'purchase_price'); ?>
	</div>
	</td>
	<td style="vertical-align:top;">

	
		<?php echo $form->labelEx($productModel,'notes'); ?>
		<?php echo $form->textArea($productModel,'notes',array('rows'=>8, 'cols'=>20)); ?>
		<?php echo $form->error($productModel,'notes'); ?>
	</td>
	</tr>
	<tr><td colspan="2"><div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Raise Call' : 'Save'); ?>
	</div></td></tr>
	</table><!-- END OF TABLE OF PRODUCT -->
	<!-- END OF FIELDS OF PRODUCT TABLE -->
	</td>
	</tr>
	</table>
	

<?php $this->endWidget(); ?>

</div><!-- form -->