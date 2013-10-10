
<div class="form">
<table>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'uplifts-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

<!--	<div class="row">
		<?php echo $form->labelEx($model,'uplift_number'); ?>
		<?php echo $form->textField($model,'uplift_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'uplift_number'); ?>
	</div>
-->
	

<tr>
	<td>
		<?php echo $form->labelEx($model,'prefix_id'); ?>
		<?php echo $form->dropDownList($model, 'prefix_id', CHtml::listData(UpliftsConfig::model()->findAll(array('order'=>"`prefix` ASC")), 'id', 'prefix'));?>
		<?php echo $form->error($model,'prefix_id'); ?>
	</td>
	


	<td>	
		<?php echo $form->labelEx($model,'servicecall_id'); ?>
		<?php echo $form->textField($model,'servicecall_id'); ?>
		<?php echo $form->error($model,'servicecall_id'); ?>
	</td>

	<td>
		<?php //echo $form->labelEx($model,'visited_engineer_id'); ?>
		<?php echo $form->hiddenField($model,'visited_engineer_id'); ?>
		<?php //echo $form->error($model,'visited_engineer_id'); ?>

		<?php echo $form->labelEx($model,'visited_engineer_name'); ?>
		<?php echo $form->textField($model,'visited_engineer_name'); ?>
		<?php echo $form->error($model,'visited_engineer_name'); ?>
	</td>	
	
	<td>
	<?php echo $form->labelEx($model,'date_of_call'); ?>
		<?php 
			if (empty($model->date_of_call))
			{
				$model->date_of_call=date('d-m-Y');
			}
			if (!empty($model->date_of_call))
			{
				$model->date_of_call=date('d-m-Y');
			}
 
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>CHtml::activeName($model, 'date_of_call'),
				'model'=>$model,
        		'value' => $model->attributes['date_of_call'],
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
		<?php echo $form->error($model,'date_of_call'); ?>
		
	</td>	
	<td>
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php echo $form->hiddenField($model,'customer_id'); ?>
		<span id="Uplifts_customer_name"></span><br>
		<span id="Uplifts_customer_town_postcode"></span><br><br>
		<?php echo $form->error($model,'customer_id'); ?>	
	</td>
	
</tr>	
<tr>

	<td>
		<?php //echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->hiddenField($model,'product_id'); ?>
		<?php //echo $form->error($model,'product_id'); ?>
		<?php echo $form->labelEx($model,'product_type'); ?>
		<?php //echo $form->textField($model,'product_type'); ?>
		<?php 
			 	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				    'model'=>$model,
				    'attribute'=>'product_type',
//				    'source'=>array('ac1', 'ac2', 'ac3', 'b1', 'ba', 'ba34', 'ba33'),
				    'source'=> Uplifts::model()->getProductTypesArray(),
				    // additional javascript options for the autocomplete plugin
				    'options' => array(
					    'showAnim' => 'fold',
					    //'select' => 'js:function(event, ui){ alert(ui.item.value) }',
					),
					'htmlOptions' => array(
						'style'=>'height:20px;',
					   // 'onClick' => 'document.getElementById("test1_id").value=""'
					),
				    'cssFile'=>false,
				));
				
			
			?>
			
			
		<?php echo $form->error($model,'product_type'); ?>
	</td>

		<td>
		<?php echo $form->labelEx($model,'model_number'); ?>
		<?php echo $form->textField($model,'model_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'model_number'); ?>
	</td>

	<td> 
		<?php echo $form->labelEx($model,'serial_number'); ?>
		<?php echo $form->textField($model,'serial_number',array('style' => 'text-transform: uppercase', )); ?>
		<?php echo $form->error($model,'serial_number'); ?>
	</td>

	<td>
		<?php echo $form->labelEx($model,'index_number'); ?>
		<?php echo $form->textField($model,'index_number',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'index_number'); ?>
	</td>
	
</tr>

<tr>
	<td>
		<?php echo $form->labelEx($model,'retailer'); ?>
		<?php echo $form->textField($model,'retailer',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'retailer'); ?>
	</td>
	<td>
	Retailer Phone
	<input type="text">
	</td>
	<td>
	Retailer Contact
	<input type="text">
	
	</td>
	
	
	
	
	<td>
		<?php echo $form->labelEx($model,'distributor'); ?>
		<?php echo $form->textField($model,'distributor',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'distributor'); ?>
	</td>
</tr>
</table>
	<td>
		<?php echo $form->labelEx($model,'date_of_purchase'); ?>
		<?php
			if (!empty($model->date_of_purchase))
			{
				$model->date_of_purchase=date('d-m-Y');
			}
 
			
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>CHtml::activeName($model, 'date_of_purchase'),
				'model'=>$model,
        		'value' => $model->attributes['date_of_purchase'],
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
		<?php echo $form->error($model,'date_of_purchase'); ?>
	</td>
	
	
	<td>
		Date of Exchange
		<?php
			if (!empty($model->date_of_purchase))
			{
				$model->date_of_purchase=date('d-m-Y');
			}
 
			
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>CHtml::activeName($model, 'date_of_purchase'),
				'model'=>$model,
        		'value' => $model->attributes['date_of_purchase'],
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
		<?php echo $form->error($model,'date_of_purchase'); ?>
	</td>
		<div class="row">
		<?php echo $form->labelEx($model,'request_type'); ?>
		<?php //echo $form->textField($model,'request_type',array('rows'=>6, 'cols'=>50)); 
		
		 	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				    'model'=>$model,
				    'attribute'=>'request_type',
//				    'source'=>array('ac1', 'ac2', 'ac3', 'b1', 'ba', 'ba34', 'ba33'),
				    'source'=> array('DOD', 'SERVICE', 'MARKETING', 'GOGW', 'SIMON FREEAR', 'SPARES ONLY', 'FAILED INSTALL', 'BER'),
				    // additional javascript options for the autocomplete plugin
				    'options' => array(
					    'showAnim' => 'fold',
					    //'select' => 'js:function(event, ui){ alert(ui.item.value) }',
					),
					'htmlOptions' => array(
						'style'=>'height:20px;',
					   // 'onClick' => 'document.getElementById("test1_id").value=""'
					),
				    'cssFile'=>false,
				));
		
		?>
		<?php echo $form->error($model,'request_type'); ?>
	</div>
	<div class="row">

		<div class="row">
		<?php echo $form->labelEx($model,'customer_claim_description'); ?>
		<?php echo $form->textArea($model,'customer_claim_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'customer_claim_description'); ?>
	</div>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason_for_uplift'); ?>
		<?php echo $form->textArea($model,'reason_for_uplift',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'reason_for_uplift'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>



	


	<div class="row">
		<?php echo $form->labelEx($model,'postcode'); ?>
		<?php echo $form->textField($model,'postcode',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'postcode'); ?>
	</div>




<!--	
	<div class="row">
		<?php echo $form->labelEx($model,'authorised_by'); ?>
		<?php echo $form->textField($model,'authorised_by'); ?>
		<?php echo $form->error($model,'authorised_by'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified'); ?>
		<?php echo $form->textField($model,'modified'); ?>
		<?php echo $form->error($model,'modified'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_by'); ?>
		<?php echo $form->textField($model,'created_by'); ?>
		<?php echo $form->error($model,'created_by'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified_by'); ?>
		<?php echo $form->textField($model,'modified_by'); ?>
		<?php echo $form->error($model,'modified_by'); ?>
	</div>
-->
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	
<?php $this->endWidget(); ?>


</table>
</div><!-- form -->

<script type="text/javascript" src="<?php echo Yii::app()->baseUrl.'/js/uplifts/uplifts.js'; ?>" > </script>
