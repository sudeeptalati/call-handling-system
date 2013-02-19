<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setup-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<table style="width:600px; margin:10px;background-color: #C7E8FD;  border-radius: 15px;">
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'company'); ?>
			<?php echo $form->textArea($model,'company',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'company'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'address'); ?>
			<?php echo $form->textArea($model,'address',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'address'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'town'); ?>
			<?php echo $form->textField($model,'town',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'town'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'postcode_s'); ?>
			<?php echo $form->textField($model,'postcode_s',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'postcode_s'); ?>
		</td>
		
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'postcode_e'); ?>
			<?php echo $form->textField($model,'postcode_e',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'postcode_e'); ?>
		</td>
		
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'county'); ?>
			<?php echo $form->textField($model,'county',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'county'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'country'); ?>
			<?php echo $form->textField($model,'country',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'country'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'email'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'telephone'); ?>
			<?php echo $form->textField($model,'telephone',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'telephone'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'mobile'); ?>
			<?php echo $form->textField($model,'mobile',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'mobile'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'alternate'); ?>
			<?php echo $form->textField($model,'alternate',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'alternate'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'fax'); ?>
			<?php echo $form->textField($model,'fax',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'fax'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'postcodeanywhere_account_code'); ?>
			<?php echo $form->textField($model,'postcodeanywhere_account_code',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'postcodeanywhere_account_code'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'postcodeanywhere_license_key'); ?>
			<?php echo $form->textField($model,'postcodeanywhere_license_key',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'postcodeanywhere_license_key'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'website'); ?>
			<?php echo $form->textArea($model,'website',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'website'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'vat_reg_no'); ?>
			<?php echo $form->textField($model,'vat_reg_no',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'vat_reg_no'); ?>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($model,'company_number'); ?>
			<?php echo $form->textField($model,'company_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'company_number'); ?>
		</td>
	</tr>
	
<!-- 	<tr> -->
<!-- 		<td> -->
			<?php //echo $form->labelEx($model,'version_update_url'); ?>
			<?php //echo $form->textArea($model,'version_update_url',array('rows'=>6, 'cols'=>50)); ?>
			<?php //echo $form->error($model,'version_update_url'); ?>
<!-- 		</td> -->
<!-- 	</tr> -->
	
	</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->