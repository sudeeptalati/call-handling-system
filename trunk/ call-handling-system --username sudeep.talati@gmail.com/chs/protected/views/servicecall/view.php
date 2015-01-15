
<?php 
$baseUrl = Yii::app()->baseUrl; 
 
?>
 

<link type="text/css" href="<?php echo $baseUrl;?>/css/dialoguebox/smoothness/jquery-ui-1.8.23.custom.css" rel="Stylesheet" />	
<script type="text/javascript" src="<?php echo $baseUrl;?>/js/dialoguebox/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo $baseUrl;?>/js/dialoguebox/jquery-ui-1.8.23.custom.min.js"></script>
	

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
		//$productTypeModel=ProductType::model()->findByPk($productModel->product_type_id);
		$productType = $productModel->productType->name;
		$productTypeModel = ProductType::model()->findByPk($productModel->product_type_id);
		
		$contractModel=Contract::model()->findByPk($model->contract_id);
		$contractName=$contractModel->name;
		$contractTypeModel=ContractType::model()->findByPk($contractModel->contract_type_id);
		$engineerModel=Engineer::model()->findByPk($model->engineer_id);
		$engineerName=$engineerModel->fullname;
		$enggDiaryModel=Enggdiary::model()->findByPk($model->engg_diary_id);
		
		//address of customer.
		$str1=$customerModel->address_line_1." ".$customerModel->address_line_2." ".$customerModel->address_line_3."\n";
		$str2=$customerModel->town."\n";
		$str3=$customerModel->postcode_s." ".$customerModel->postcode_e;
		$address=$str1." ".$str2." ".$str3;
		
		
		//CALCULATING VALID UNTILL.
	
		$php_warranty_date=$productModel->warranty_date;
		$php_waranty_months=$productModel->warranty_for_months;
		$res='';
		if (!empty ($php_warranty_date))
		{
		$warranty_until= strtotime(date("Y-M-d", $php_warranty_date) . " +".$php_waranty_months." month");
		$res=date('d-M-Y', $warranty_until);
		//echo $res;							
		}
	?>
	

<table>
	
	<tr>
		<td><b><a href="javascript: history.go(-1)">Back</a></b></td>
		<td style="text-align:right"><b>
				<?php
				if($model->job_status_id > 100)
				{
					echo CHtml::link('Edit',array('update','id'=>$model->id), array('onclick'=>'return false;','style'=>'color:gray;'))."&nbsp;&nbsp;	<small>(Call is Closed)</small>";
					//echo "<br>here";
				} 	
				else
					echo CHtml::link('Edit',array('update','id'=>$model->id)); 
				
				?>
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php 
					$previewImgUrl = Yii::app()->request->baseUrl.'/images/pdf.gif';
					$previewImg = CHtml::image($previewImgUrl, 'Preview', array('width'=>35, 'height'=>35, 'title'=>'Preview in Pdf'));
				?>
				<?php 	
// 						echo CHtml::link('Preview',array('Preview',
// 											'id'=>$model->id), array('target'=>'_blank')
// 										);
						echo CHtml::link($previewImg, array('Preview','id'=>$model->id), array('target'=>'_blank'));
										
				?>
				
			</b>
		 <b>
			<?php 
					$htmlImgUrl = Yii::app()->request->baseUrl.'/images/html_file.png';
					$htmlImg = CHtml::image($htmlImgUrl, 'htmlPreview', array('width'=>35, 'height'=>35, 'title'=>'Preview in HTML'));
			?>
			<?php 
// 				echo CHtml::link('HTML',array('htmlPreview',
// 						'id'=>$model->id), array('target'=>'_blank')
// 				);
				echo CHtml::link($htmlImg, array('htmlPreview','id'=>$model->id), array('target'=>'_blank'));
				
			?>
			 
			</b>
			
			<b>
			<?php 
					$mobileImgUrl = Yii::app()->request->baseUrl.'/images/mobile.png';
					$mobileImg = CHtml::image($mobileImgUrl, 'sendToMobile', array('width'=>35, 'height'=>35, 'title'=>'Send to Mobile'));
  
 
					echo CHtml::link($mobileImg,  array('/gomobile/default/sendsingleservicecalltoserver','id'=>$model->id) , array('target'=>'_blank'));
				
			?>
			 
			</b>
			
		</td>
	</tr>
	
	<!-- NOTIFICATION DIV COMMENTED FOR TESTING 
	<tr>
	<td  colspan="2">
	<div class=notification><?php //echo $notification_message; ?></div>
	</td>
	</tr>  
	-->
	

	<tr><td colspan="2" style="text-align:center">
		<h2>Service Call Details</h2>
		</td>
	</tr>
		<tr>
		<th><b>Job Status : </b> 
		<h6 style="color:maroon"><?php echo $model->jobStatus->name; ?></h6></th>
		<th >Service Ref. No.# <h1 style="color:green"><?php echo $model->service_reference_number;?></h1></th>
		
	</tr>
	<tr>
		<td>
		<?php
				$viewFaultDate='';
				if (!empty($model->fault_date))
				{
					
				
				$viewFaultDate=date('d-M-Y', $model->fault_date);?>
		<?php echo $form->labelEx($model,'fault_date'); ?>
		<br>
		<?php echo CHtml::textField('',$viewFaultDate,array('disabled'=>'disabled'));
				}//end of if empty
		?>
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
		Engineer Visit Date	<br>
			<b><i><?php 	echo $model->engineer->company;?></i></b>
		<?php 	 
				//echo $form->labelEx($enggDiaryModel,'visit_start_date').'<br>';	
				$viewVisitStartDate='';
				if (!empty($enggDiaryModel->visit_start_date)){
				$viewVisitStartDate= date('d-M-y', $enggDiaryModel->visit_start_date);
 				}
				echo CHtml::textField('',$viewVisitStartDate,  array('disabled'=>'disabled'));
		?>
		<?php 
//			if(!empty($enggDiaryModel->visit_start_date))
//			{
//				$enggDiaryModel->visit_start_date=date('d-M-y', $enggDiaryModel->visit_start_date);
//			}
		?>
		 
		<?php //echo $form->textField($enggDiaryModel,'visit_start_date', array('disabled'=>'disabled')); ?>
		
				
				
		</td><td>
		
		<?php //echo $form->DropDownList($model, 'engineer_id', $productModel->getAllCompanyNames	(), array('disabled'=>'disabled')); ?>
		
	<?php
			$imgurl = Yii::app()->request->baseUrl.'/images/calendar.gif';
			$imghtml = CHtml::image($imgurl,'Add to Calendar',array('width'=>25, 'height'=>25, 'title'=>'Add to Outlook or iCal' )); 
			echo CHtml::link($imghtml, array('Enggdiary/appointIcalender','service_id'=>$model->id));
		?></td>
		</tr>
		<tr><td>
		<?php echo $form->labelEx($model,'insurer_reference_number'); ?>
<!--		<br>-->
		<?php echo $form->textField($model,'insurer_reference_number', array('disabled'=>'disabled')); ?>
		
		</td><td>
		<?php $model->contract_id=$productModel->contract->id; ?>
		<?php echo $form->labelEx($model,'contract_id'); ?>
		<br> 
		<?php echo CHtml::activeDropDownList($model,'contract_id', $model->getAllContract(),array('disabled'=>'disabled')); ?>
		</td></tr></table>
	</td>
	</tr>
		
		<tr><td colspan="2" style="text-align:center"><h2>Technician Report</h2></td></tr>
	<tr>
		<td>
			<?php echo $form->labelEx($model,'work_carried_out'); ?>
			<?php echo $form->textArea($model,'work_carried_out', array('rows'=>4, 'cols'=>'30',  'disabled'=>'disabled')); ?>
			</td>
			<td>
			<?php echo $form->labelEx($model,'notes'); ?><br>
			<?php echo $form->textArea($model,'notes',array('rows'=>4, 'cols'=>33, 'disabled'=>'disabled')); ?>	
				</td>
			</tr>
			<tr>
			<td>
			
			
			<?php echo $form->labelEx($model,'spares_used_status_id'); ?>
			<?php echo $form->dropDownList($model, 'spares_used_status_id', array('0'=>'No', '1'=>'Yes'),array('disabled'=>'disabled')); ?><br>
			<?php 
				if($model->spares_used_status_id == 1)
				{
					//echo "Spares used";
					$sparesModel = SparesUsed::model()->findAllByAttributes(array('servicecall_id'=> $model->id));
					?>
					<table style="width:75%;">
						<tr><th>Item</th>
							<th>Quantity</th>
							<th>Price</th>
						</tr>
					<?php 					
					foreach ($sparesModel as $data)
					{
						?>
						<tr>
						<td><?php echo $data->item_name; ?></td>
						<td><?php echo $data->quantity; ?></td>
						<td><?php echo $data->total_price; ?></td>
						</tr>
						<?php 
						
					
					}//end of foreach of spares().
				
					?> </table><?php 
				
				}//end of if($spares_used == 1).	
			
			?>
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
				<tr>
					<td>
					<?php echo $form->labelEx($model,'net_cost'); ?>
					</td>
					<td>
					<?php echo $form->textField($model,'net_cost', array('disabled'=>'disabled')); ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php
						if(!empty($model->job_finished_date))
						{
							$model->job_finished_date=date('d-M-y',$model->job_finished_date);
						}
					?>
					<?php echo $form->labelEx($model,'job_finished_date'); ?>
					</td>
					<td>
					<?php echo $form->textField($model,'job_finished_date', array('disabled'=>'disabled')); ?>
					</td>
				</tr>
				<tr>
					<td>
					<?php
						if(!empty($model->job_payment_date))
						{
							$model->job_payment_date=date('d-M-y',$model->job_payment_date);
						}
					?>
					<?php echo $form->labelEx($model,'job_payment_date'); ?>
					</td>
					<td>
					<?php echo $form->textField($model,'job_payment_date', array('disabled'=>'disabled'));?>
					</td>
				</tr>
			</table>
			
 		</td>
		<td style="vertical-align: top;">
			<br>
			
			
			<?php echo $form->labelEx($model,'comments'); ?><small>&nbsp;&nbsp;&nbsp;(not visible on call sheet)</small><br>
			<?php echo $form->textArea($model,'comments',array('rows'=>4, 'cols'=>33, 'disabled'=>'disabled')); ?>	
			<br>
			
			<?php echo $form->labelEx($model,'work_summary'); ?>
			<?php echo $form->textArea($model,'work_summary',array('rows'=>3, 'cols'=>33, 'disabled'=>'disabled')); ?>	
			
			
		</td>
		
	</tr>

	<tr><td colspan="2" style="text-align:center">
	<h3>Previous Service Calls </h3>
	</td></tr>
	<tr><td colspan="2" style="text-align:center">
	<table><tr>
    	<th>Service Ref#</th>
		<th>Product</th>
    	<th>Reported Date</th>
    	<th>Fault Description</th>
    	<th>Engineer Visited</th>
    	<th>Visit Date</th>
    	<th>Job Status</th>
    	</tr>
    	<?php $previousCall = $model->previousCall($model->customer_id);
    	foreach ($previousCall as $data)
    	{
			if ($data->service_reference_number!=$model->service_reference_number)//////since we want to skip the current service call
			{
    		$enggdiaryModel=Enggdiary::model()->findByPk($data->engg_diary_id);
		?>
		<tr>
    		<td><?php echo CHtml::link($data->service_reference_number, array('view', 'id'=>$data->id));?></td>
    		<td><?php echo "<b>".$data->product->productType->name."<b>";?></td>
    		<td><?php
    				if(!empty($data->fault_date)) 
    					echo date('d-M-Y', $data->fault_date);
    			?>
    		</td>
    		<td><?php echo $data->fault_description;?></td>
    		<td><?php echo $data->engineer->company.', '.$data->engineer->fullname;?></td>
    		<td><?php
    				if(!empty($enggdiaryModel->visit_start_date)) 
    					echo date('d-M-Y',$enggdiaryModel->visit_start_date);?>
    		</td>
    		<td style="color:maroon"><?php echo $data->jobStatus->name;?></td>
    		</tr>
		<?php
			}///end of if

		}//end of foreach().?>
    	</table>
		</td>
	</tr>
	<tr>
		<td>
			<h4>Customer Details</h4>
			<small><?php echo CHtml::link('Edit Details',array('Customer/openDialog','customer_id'=>$customerModel->id, 'product_id'=>$productModel->id));?></small>
		</td>
		<td>
			<h4>Product Details</h4>
			<small><?php echo CHtml::link('Edit Details',array('Product/updateProduct','id'=>$productModel->id));?></small>
		</td>
	</tr>
	
	<tr>
		<td>
			<?php echo $form->labelEx($customerModel,'fullname'); ?>
			<br>
			<?php echo $form->textField($customerModel,'fullname', array('disabled'=>'disabled')); ?>
			<?php echo $form->error($customerModel,'fullname'); ?>
			
			<?php echo "<br>Address";?>
			<span id="opener"><img src="<?php echo $baseUrl;?>/images/maps.png" width="30px" height="30px"/></span><br> 
			<?php echo CHtml::textArea('Address', $address,  array('rows'=>4, 'cols'=>30,'disabled'=>'disabled')); ?>
			 
			<!-- *********** GOOGLE MAP DISPLAY ***************** -->
			<br>
			
			<div id="dialog" title="Google Map">
			  <div id='map_div'></div>
			</div>
	
	  	 	<script>

				$.fx.speeds._default = 500;
				$(function() {
					$( "#dialog" ).dialog({
						autoOpen: false,
						show: "blind",
						hide: "explode",
						width: 470,
						
					});
			
					$( "#opener" ).click(function() 
					{
						$( "#dialog" ).dialog( "open" );
						drawmap();
						$("#map_div").load('DisplayMap', {'postcode':'<?php echo $customerModel->postcode; ?>'});
						return false;
					});
				});
				function drawmap()
				{
					console.info('I AM CALLED');
				}

				
			</script>
			
			<!-- *********** END OF GOOGLE MAP DISPLAY ***************** -->

		  	<br>
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
			<br>
			<?php echo $form->textArea($customerModel,'notes',array('disabled'=>'disabled', 'rows'=>4, 'cols'=>40)); ?>
		</td>
		<td style="vertical-align:top;">
			<table>
			<tr>
				<td style="vertical-align:top;">
					<?php echo $form->labelEx($brandModel,'name'); ?><br>
					<?php echo $form->textField($brandModel,'name', array('disabled'=>'disabled')); ?>
					
					<?php echo $form->labelEx($productTypeModel ,'name'); ?><br>
					<?php echo $form->textField($productTypeModel,'name', array('disabled'=>'disabled')); ?>
					
					<?php //echo CHtml::textField('',$productType, array('disabled'=>'disabled')); ?>
					
					<br>
					<?php echo $form->labelEx($productModel,'model_number'); ?><br>
					<?php echo $form->textField($productModel,'model_number',array('disabled'=>'disabled')); ?>
					<br>
					<?php echo $form->labelEx($productModel,'serial_number'); ?><br>
					<?php echo $form->textField($productModel,'serial_number',array('disabled'=>'disabled')); ?>
					<br>
					<?php echo $form->labelEx($productModel,'enr_number'); ?><br>
					<?php echo $form->textField($productModel,'enr_number',array('disabled'=>'disabled')); ?>
				</td>
				<td style="vertical-align:top;">
					<?php echo $form->labelEx($productModel,'purchased_from'); ?><br>
					<?php echo $form->textField($productModel,'purchased_from', array('disabled'=>'disabled')); ?>
					<br>
					<?php $viewPurchaseDate='';
							if(!empty($productModel->purchase_date)){
								$viewPurchaseDate=date('d-M-y', $productModel->purchase_date);
							}
						?>
					<?php echo $form->labelEx($productModel,'purchase_date'); ?><br>
					<?php echo CHtml::textField('',$viewPurchaseDate,  array('disabled'=>'disabled')); ?>
					<br>
					<?php 	//$viewWarrantyDate='';
							if (!empty($productModel->warranty_date))
							{
							$productModel->warranty_date=date('d-M-y', $productModel->warranty_date);
							}
							?>
					<?php echo $form->labelEx($productModel,'warranty_date'); ?><br>
					<?php //echo CHtml::textField('',$viewWarrantyDate,  array('disabled'=>'disabled')); ?>
					<?php echo $form->textField($productModel, 'warranty_date', array('disabled'=>'disabled'));?>
					
					<?php echo $form->labelEx($productModel,'warranty_until'); ?><br>
					<?php 
						echo CHtml::textField('Warranty Date',$res,  array('disabled'=>'disabled'));
					?>
					<br>
					<?php echo $form->labelEx($productModel,'fnr_number'); ?><br>
					<?php echo $form->textField($productModel,'fnr_number',array('disabled'=>'disabled')); ?>
					
				</td>
				</tr>
				<tr>
					<td>
						<?php 
							if($productModel->discontinued == 0)
								$discontinued_value = 'No';
							else 
								$discontinued_value = 'Yes';
						?>
						<?php echo $form->labelEx($productModel,'discontinued'); ?><br>
						<?php //echo $form->textField($productModel,'discontinued',array('disabled'=>'disabled')); ?>
						<?php echo CHtml::textField('', $discontinued_value, array('disabled'=>'disabled'));?>
					</td>
					<td colspan="2">
						<?php echo $form->labelEx($productModel,'notes'); ?><br>
						<?php echo $form->textArea($productModel,'notes',array('disabled'=>'disabled', 'rows'=>4, 'cols'=>20)); ?>
					</td>
				</tr>
				</table><!-- end of product table -->
			</td>
		</tr>

		
		
	
	
	
</table>
<?php $this->endWidget(); ?>
