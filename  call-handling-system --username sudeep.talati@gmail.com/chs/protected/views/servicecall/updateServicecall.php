	<div class="form">

	
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'servicecall-updateServicecall-form',
		'enableAjaxValidation'=>false,
	)); ?>
	
		<script type="text/javascript">
		function my_change(id)
		{
			if(id > 100)
			{
		        alert("You can not change this status again");
			}
		}
		</script>
		
	
		<p class="note">Fields with <span class="required">*</span> are required.</p>
	
		<?php echo $form->errorSummary($model); ?>
		
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
			$str3=$customerModel->postcode_s;
			$address=$str1." ".$str2." ".$str3;
			
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
			//echo $res;							
			
		?>
		
		<!-- ************ CUSTOMER DEATILS******** -->
		
		<div class="row">
		<table>
		<tr><td colspan='2' style="text-align:center"><h1>Service Call Details</h1></td>
		</tr>
		
		<tr>
			
				
			<td style="vertical-align:top;"><b>Job Status : </b>
			<span style="color:maroon"><?php echo $model->jobStatus->name;?></span>

			<br>
				
				
				<?php 
					if($model->job_status_id<100)
					{
						$result=$model->updateStatus();
						$list=CHtml::listData($result, 'id','name');
						echo $form->dropDownList($model, 'job_status_id', $list, array('onchange'=>'js:my_change(this.value)'));
						echo $form->error($model,'job_status_id'); 
					}//end of if().
					
				?>
			</td>
			
			<td><b>Service Ref. No.#</b><br><h2 style="color: green;"><?php echo $model->service_reference_number;?></h2></td>
			
			<td colspan="3" style="vertical-align:top;"><?php echo CHtml::submitButton('Modify'); ?></td>
		</tr>
		
		<tr><td colspan="2" style="text-align:center">
			 
			</td>
		</tr>
		
		<tr><td>
		<?php echo $form->labelEx($model,'fault_date');?>
		<?php 	
				//echo $model->fault_date;
				
 				if ($model->fault_date!=''){
	 				$fault_date=date('j-M-y',$model->fault_date);
					}	
					else 
						{
						$fault_date='';	
					}
				
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				    'name'=>CHtml::activeName($model, 'fault_date'),
					'model'=>$model,
	        		'value' => $fault_date,
 
				    'options'=>array(
				        'showAnim'=>'fold',
						'dateFormat' => 'd-M-y',
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

				<?php
				 	$viewVisitStartDate='';
				 	if(!empty($enggDiaryModel->visit_start_date))
					{
						//$enggDiaryModel->visit_start_date= date('d-M-y', $enggDiaryModel->visit_start_date);
						$viewVisitStartDate=date('d-M-Y', $enggDiaryModel->visit_start_date);
					}
				?>

			<?php echo "<b>Current Appointment</b><br>";?>
			<?php //echo $form->textField($enggDiaryModel,'visit_start_date', array('disabled'=>'disabled')); ?>
			<?php echo CHtml::textField('',$viewVisitStartDate,array('disabled'=>'disabled')); ?>
			<?php //echo $form->error($enggDiaryModel,'visit_start_date'); ?>
			
			<!-- code for image link to change appointment -->
			<?php 
				$imgurl = Yii::app()->request->baseUrl.'/images/engineer_diary.gif';
				$imghtml = CHtml::image($imgurl,'Engineer Appointment',array('width'=>25, 'height'=>25, 'title'=>'Engineer Appointment' )); 
				//echo CHtml::link($imghtml, array('Enggdiary/iCalLink','id'=>$model->id));
			?>
			<!-- end of code. -->
			
			<?php echo $form->labelEx($model,'engineer_id'); ?>
			<?php echo $form->textField($engineerModel, 'fullname', array('disabled'=>'disabled'));?>
			<?php echo $form->error($model,'engineer_id'); ?>
			<?php if(empty($model->engg_diary_id))
				  {
				  	echo CHtml::link($imghtml, array('enggdiary/create/', 'id'=>$model->id, 'engineer_id'=>$model->engineer_id));
					echo CHtml::link('Create Appointment', array('enggdiary/create/', 'id'=>$model->id, 'engineer_id'=>$model->engineer_id));
				  }
				  else 
				  {
				  	echo CHtml::link($imghtml, array('enggdiary/changeAppointment/', 'service_id'=>$model->id, 'engineer_id'=>$model->engineer_id, 'enggdiary_id'=>$model->engg_diary_id));
				  	echo CHtml::link('Change Engineer or Appointment', array('enggdiary/changeAppointment/', 'service_id'=>$model->id, 'engineer_id'=>$model->engineer_id, 'enggdiary_id'=>$model->engg_diary_id));				  	
				  }
			?>
				
			<?php //echo CHtml::link('Change the Engineer or Appointment', array('enggdiary/changeAppointment/', 'serviceId'=>$model->id, 'engineerId'=>$model->engineer_id, 'enggdiary_id'=>$model->engg_diary_id)); ?>
			
			<?php echo $form->labelEx($model,'insurer_reference_number'); ?>
			<?php echo $form->textField($model,'insurer_reference_number'); ?>
			<?php echo $form->error($model,'insurer_reference_number'); ?>
			
			<?php $model->contract_id=$productModel->contract->id; ?>
			<?php echo $form->labelEx($model,'contract_id'); ?>
			<?php echo CHtml::activeDropDownList($model,'contract_id', $model->getAllContract()); ?>
			<?php echo $form->error($model,'contract_id'); ?>
			
			
		</td>
		</tr>
	
		
		<tr><td colspan="2" style="text-align:center">
			<h2>Further Details</h2>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->labelEx($model,'spares_used_status_id'); ?>
				<?php //echo $form->textField($model,'spares_used_status_id'); ?>
				<?php //$model->spares_used_status_id='';?>
				<?php echo $form->dropDownList($model, 'spares_used_status_id', array(  '0'=>'No','1'=>'Yes'));?>
				<?php echo $form->error($model,'spares_used_status_id'); ?>
				
				<?php echo $form->labelEx($model,'work_carried_out'); ?>
				<?php echo $form->textArea($model,'work_carried_out', array('rows'=>4, 'cols'=>'30')); ?>
				<?php echo $form->error($model,'work_carried_out'); ?>
			
				<?php echo $form->labelEx($model,'job_payment_date'); ?>
				<?php 	
//					if (!empty($model->job_payment_date))
//					{
//						$model->job_payment_date=date('d-M-y', $model->job_payment_date);
//					}
					?>
				<?php 
					
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				    'name'=>CHtml::activeName($model, 'job_payment_date'),
					'model'=>$model,
	        		'value' => $model->attributes['job_payment_date'],
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
				<?php //echo $form->textField($model,'job_payment_date'); ?>
				<?php echo $form->error($model,'job_payment_date'); ?>
				
				
				
				
				<?php echo $form->labelEx($model,'job_finished_date'); ?>
				<?php 
					if (!empty($model->job_finished_date))
					{
						$model->job_finished_date=date('d-M-y', $model->job_finished_date);
					}
					?>
				
				<?php 
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				    'name'=>CHtml::activeName($model, 'job_finished_date'),
					'model'=>$model,
	        		'value' => $model->attributes['job_finished_date'],
				    // additional javascript options for the date picker plugin
				    'options'=>array(
				        'showAnim'=>'fold',
						'dateFormat' =>'dd-mm-yy' ,
				    ),
				    'htmlOptions'=>array(
				        'style'=>'height:20px;'
				    ),
				));
				?>
				<?php //echo $form->textField($model,'job_finished_date'); ?>
				<?php echo $form->error($model,'job_finished_date'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'total_cost'); ?>
				<?php echo $form->textField($model,'total_cost'); ?>
				<?php echo $form->error($model,'total_cost'); ?>
					
				<?php echo $form->labelEx($model,'vat_on_total'); ?>
				<?php echo $form->textField($model,'vat_on_total'); ?>
				<?php echo $form->error($model,'vat_on_total'); ?>
				
				<?php echo $form->labelEx($model,'net_cost'); ?>
				<?php echo $form->textField($model,'net_cost', array('disabled'=>'disabled')); ?>
				<?php echo $form->error($model,'net_cost'); ?>
				
				<?php echo $form->labelEx($model,'notes'); ?>
				<?php echo $form->textArea($model,'notes',array('rows'=>4, 'cols'=>30)); ?>
				<?php echo $form->error($model,'notes'); ?>
			</td>
			
		</tr>
			
		<tr>
			<td>
				<h2>Customer Details</h2>
			</td>
			<td>
				<h2>Product Details</h2>
			</td>
		</tr>
		
		<!-- *********** DISPLAYING CUSTOMER DETAILS ********* -->
		
		<tr>
			<td>
				<?php echo $form->labelEx($customerModel,'fullname'); ?>
				<?php echo $form->textField($customerModel,'fullname', array('disabled'=>'disabled')); ?>
				<?php echo $form->error($customerModel,'fullname'); ?>
				
				<?php echo "<br><b>Address</b><br>" ,
			  		 CHtml::textArea('Address', $address,  array('rows'=>4, 'cols'=>40,'disabled'=>'disabled')); ?>
			  	
			  	<?php echo $form->labelEx($customerModel,'telephone'); ?>
				<?php echo $form->textField($customerModel,'telephone',array('disabled'=>'disabled')),"<br>"; ?>
				<?php echo $form->textField($customerModel,'mobile',array('disabled'=>'disabled')); ?>
			
				<?php echo $form->labelEx($customerModel,'email'); ?>
				<?php echo $form->textField($customerModel,'email',array('disabled'=>'disabled')); ?>
				
				<?php echo $form->labelEx($customerModel,'notes'); ?>
				<?php echo $form->textArea($customerModel,'notes',array('disabled'=>'disabled', 'rows'=>4, 'cols'=>40)); ?>
			</td>
			
			<!-- *********** DISPLAYING PRODUCT DEATILS ********** -->
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
					
					<?php	$viewPurchaseDate='';
							if (!empty($productModel->purchase_date))
							{
							$viewPurchaseDate=date('d-M-y', $productModel->purchase_date);
							}
							?>
					<?php echo $form->labelEx($productModel,'purchase_date'); ?>
					<?php echo CHtml::textField('',$viewPurchaseDate,  array('disabled'=>'disabled')); ?>
					<?php //echo $form->textField($productModel,'purchase_date', array('disabled'=>'disabled')); ?>
					
					<?php	$viewWarrantyDate='';
						 	if (!empty($productModel->warranty_date))
							{
								$viewWarrantyDate=date('d-M-y', $productModel->warranty_date);
							}
							?>
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
		</table>
		</div>
		
		<div class="row buttons">
			<?php echo CHtml::submitButton('Modify'); ?>
		</div>
	
	<?php $this->endWidget(); ?>
	
	</div><!-- form -->