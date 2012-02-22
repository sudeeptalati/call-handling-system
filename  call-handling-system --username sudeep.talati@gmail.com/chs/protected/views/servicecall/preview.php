<table style="width:100%; ">
	<tr>
		<td align="left">
			<h3>Service Call#</h3>
			<h2><?php echo $model->	service_reference_number; ?></h2>
		</td>
		<td align="right" style="font-size:10px;">
			<?php 
			$logo_url=Yii::app()->request->baseUrl.'/images/company_logo.png';
			echo CHtml::image($logo_url);
			?>
			<br>
			<?php 
			$company_name=Yii::app()->params['company_name'];
			$company_address=Yii::app()->params['company_address'];
			$company_contact_details=Yii::app()->params['company_contact_details'];
			$vat_percentage=Yii::app()->params['vat_in_percentage'];
			
			echo $company_name."<br>".$company_address;
			echo "<br> ".$company_contact_details;
			
			?>
		</td>
</tr>
<tr><td colspan="2"><hr></td></tr>
</table>

<!-- THIS TABLE HAVE 4 COLUMNS -->
<table style="width:100%; ">
<tr><td colspan="2"><b>Customer Details</b></td></tr>
<tr style="">
	<td style="width:70%; ">
		<table>
		<tr>
			<td><small><b>Postcode</b></small>
			<br>
			<?php echo $model->customer->postcode?>
			</td >
			<td><small><b>Name</b></small>
			<br>
			<?php echo $model->customer->fullname?>
			</td>
			<td></td>
		</tr>
		<tr>
			<td colspan="3"><small><b>Address</b></small>
			<br>
			<?php echo $model->customer->address_line_1." ".$model->customer->address_line_2." ".$model->customer->address_line_3.", ".$model->customer->town; ?>
			</td>
		</tr>
		<tr>
			<td><small><b>Telephone</b></small>
			<br>
			<?php echo $model->customer->telephone; ?>
			</td>			
			<td><small><b>Mobile</b></small>
			<br>
			<?php echo $model->customer->mobile; ?>
			</td>			
			<td><small><b>Alternate</b></small>
			<br>
			<?php echo $model->customer->fax; ?>
			</td>			
		</tr>
		<tr>
			<td colspan="3"><small><b>E-Mail</b></small>
			<br>
			<?php echo $model->customer->email; ?>
			</td>
		</tr>
		
		</table>
	</td>
	<td style="width:30%; vertical-align:top;"><small><b>Customer Notes</b></small>
	<br><?php echo $model->customer->notes?>
	</td>
</tr>

<tr><td colspan="2"><b>Product Details</b></td></tr>
<tr>
	<td style="width:70%; ">
			<table>
		<tr>
			<td colspan="2"><small><b>Product</b></small>
			<br>
			<?php echo $model->product->brand->name; ?>&nbsp;
			<?php echo $model->product->productType->name; ?>
			</td >
			<td><small><b>Model</b></small>
			<br>
			<?php echo $model->product->model_number; ?>
			</td>
		</tr>
		<tr>
			<td colspan="3"><small><b>Serial Number</b></small>
			<br>
			<?php echo $model->product->serial_number; ?>
			</td>
		</tr>
		<tr>
			<td><small><b>Retailer</b></small>
			<br>
			<?php echo $model->product->purchased_from; ?>
			</td>			
			<td colspan="2"><small><b>Date of Purchase</b></small>
			<br>
			<?php 
					if ($model->product->purchase_date!='')
				echo date ('d-M-Y',$model->product->purchase_date); ?>
			</td>			
		</tr>
		<tr>
			<td><small><b>Contract</b></small>
			<br>
			<?php echo $model->product->contract->name; ?>
			</td>			
			<td><small><b>Start</b></small>
			<br>
			<?php 	if ($model->product->warranty_date!='')
					echo date('d-M-Y',$model->product->warranty_date); ?>
			</td>			
			<td><small><b>End</b></small>
			<br>
			<?php 
			
					$php_warranty_date=$model->product->warranty_date;
					$warranty_months=$model->product->warranty_for_months;
					$end_date = strtotime(date("Y-m-d",$php_warranty_date) . " + ".$warranty_months." month");
 					echo date('d-M-Y',$end_date );
					
			?>
			</td>

		</tr>
		
		</table>
	</td>
	<td style="width:30%; vertical-align:top; ">
	<small><b>Product Notes</b></small>
	<br><?php echo $model->product->notes?>
	
	</td>
</tr>

<tr><td colspan="2"><h2>Call Details</h2></td></tr>
<tr>
	<td colspan="2">
		<table>
		<tr>
			<td ><small><b>Reported </b></small>
			<br>
			<?php echo date('d-M-Y',$model->fault_date); ?>
			</td >
			<td><small><b>Fault code</b></small>
			<br>
			<?php echo $model->fault_code; ?>
			</td>
			<td ><small><b>Refrence No#</b></small>
			<br>
			<?php echo $model->insurer_reference_number; ?>
			</td>
		</tr>
		<tr>
		<td colspan="3" style="width:30%; vertical-align:top;"><small><b>Issue Reported</b></small>
			<br><?php echo $model->fault_description?>
		</td></tr>
		</table>
	</td>
</tr>
<tr><td colspan="2"><h3>Technician Report</h3></td></tr>
<tr><td colspan="2">
		<table>
		<tr><td colspan="2"><small><b>Work Carried out or Inspection</b></small></td></tr>
		<tr><td colspan="2"><?php echo $model->work_carried_out; ?></td></tr>
		<tr><td colspan="2"><small><b>Spares Used</b></small></td></tr>
		<tr>
			<td>
			<table>
				<tr>
				<td style="border: 1px solid;"><b>Quantity</b></td>
				<td style="border: 1px solid;"><b>Part Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
				<td style="border: 1px solid;"><b>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
				<td style="border: 1px solid;"><b>Price&nbsp;&nbsp;&nbsp;</b></td>
				<td style="border: 1px solid;"><b>Total&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
				</tr>
				<?php for ($i=0;$i<=5;$i++) {?>				
					<tr>
					<td style="border: 1px solid;"><b>&nbsp;</b></td>
					<td style="border: 1px solid;"><b>&nbsp;</b></td>
					<td style="border: 1px solid;"><b>&nbsp;</b></td>
					<td style="border: 1px solid;"><b>&nbsp;</b></td>
					<td style="border: 1px solid;"><b>&nbsp;</b></td>
					</tr>				
				<?php }//end of for?>				
				</table>		
			</td>
			<td style="vertical-align:top;">
			<small><b>Sub-Total:</b></small>&nbsp;
			<?php echo $model->total_cost; ?>
			<br>
			<small><b>Vat:</b></small>&nbsp;
			<?php echo $model->vat_on_total; ?>
			<br>
			<small><b>Net Cost:</b></small>&nbsp;
			<?php echo $model->net_cost; ?>
			<br>
			<br>
			<small><b>Payment: </b></small>&nbsp;
			<?php 
					if ($model->job_payment_date!='')
					echo date('d-M-Y',$model->job_payment_date); 
				
				?>
			<br>
			<small><b>Completion:	</b></small>&nbsp;
			<?php 	if ($model->job_finished_date)
					echo date('d-M-Y',$model->job_finished_date); ?>
			<table style="border: 1px solid;"> 
				<tr><td>Customer Name &amp; Signature</td></tr>
				<tr><td>&nbsp;<br>&nbsp;<br></td></tr>
			</table>
			</td>
			</tr>
		</table>

</td></tr>


</table>
