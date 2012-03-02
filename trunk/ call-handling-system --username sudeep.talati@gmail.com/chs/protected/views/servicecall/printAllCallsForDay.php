<?php
$this->layout=false;
?>
<?php 
for ($x=1;$x<21;$x++)
{
?>
	
<style type="text/css">

hr {color:sienna;}
p {margin-left:20px;}
body {
 
background-color: transparent;
font-family:"Helvetica";
}
table { 
/*
border: 8px outset green; 
*/
}

td { 	vertical-align:top;
		font-size:10px;
 		
 		/*
 		border: 3px dotted green; 
 		*/
 		}




</style>

<table style="width:100%;    ">
	<tr>
		<td align="left">
			<h3>Service Call ID</h3>
			<h2><?php echo $model->	service_reference_number; ?></h2>
			<br><b><small>Attending Engineer:</small></b><br>
			<?php echo $model->engineer->fullname;?>
			<br>
			<?php //echo $model->engineer->contactDetails->town;?>&nbsp;
			<?php //echo $model->engineer->contactDetails->postcode;?>
			<br>
			<?php //echo $model->engineer->contactDetails->email;?>
			
		</td>
		<td align="right" style="font-size:8px;">
			<?php 
			$logo_url=Yii::app()->request->baseUrl.'/images/company_logo.png';
			echo CHtml::image($logo_url);
			?>
			<br>
			<?php 

			$company_name=$config->company;
			$company_address=$config->address;
			$company_town=$config->town;
			$company_postcode_s=$config->postcode_s;
			$company_postcode_e=$config->postcode_e;
			
			$company_email=$config->email;
			$company_telephone=$config->telephone;
			$company_mobile=$config->mobile;
			$company_alternate=$config->alternate;
			$company_fax=$config->fax;
			$company_website=$config->website;
			$company_vat_no=$config->vat_reg_no;
			$company_reg_no=$config->company_number;
 
			echo $company_name."<br>".$company_address." ,".$company_town."&nbsp;".$company_postcode_s."&nbsp;".$company_postcode_e;
			echo "<br> Phone:".$company_telephone."&nbsp;&nbsp;&nbsp;&nbsp; Fax:".$company_fax."&nbsp;&nbsp;&nbsp;&nbsp;Email:".$company_email;
			echo "<br>";
			if (!empty($company_vat_no))
			echo "VAT No:".$company_vat_no;
			if (!empty($company_reg_no))
			echo  " &nbsp;&nbsp;&nbsp;&nbsp; Company No.:".$company_reg_no;
			
			?>
		</td>
</tr>
<tr><td colspan="2"><hr></td></tr>
</table>

<!-- THIS TABLE HAVE 4 COLUMNS -->
<table style="width:100%; ">
<tr><td colspan="2"><h3><i>Customer Details</i></h3></td></tr>
<tr >
	<td style="width:70%; ">
		<table style="width:450px;">
		<tr>
					<td><small><b>Name</b></small>
			<br>
			<?php echo $model->customer->title?>&nbsp;
			<?php echo $model->customer->fullname?>
			</td>
			<td>
			
			</td >

			<td></td>
		</tr>
		<tr>
			<td colspan="3"><small><b>Address</b></small>
			<br>
			<?php echo $model->customer->address_line_1." ".$model->customer->address_line_2." ".$model->customer->address_line_3.", ".$model->customer->town; ?>
			</td>
		</tr>
		<tr>
<td><small><b>Postcode</b></small>
			<br>
			<?php echo $model->customer->postcode?>
		</td>		
		

		<td><!-- 
			<small><b>County (District)</b></small>
			<br>
			<?php //echo $model->customer->postcode?>
			 -->
		</td>
		 
		<td>
		<!--
		<small><b>Country</b></small>
			<br>
			<?php echo $model->customer->country?>
		 -->
		
		</td>
		
		
		</tr>
		
		</table>
	</td>
	<td style="width:30%; vertical-align:top;">
			<small><b>Telephone</b></small>
			<br>
			<?php echo $model->customer->telephone; ?>
			<br><br>			
			<small><b>Mobile</b></small>
			<br>
			<?php echo $model->customer->mobile; ?>
			<br><br>
			<small><b>Alternate</b></small>
			<br>
			<?php echo $model->customer->fax; ?>
			<br><br>
			<!--
			<small><b>E-Mail</b></small>
			<br>
			<?php echo $model->customer->email; ?>
			 -->
	</td>
</tr>
<tr><td colspan="2">

<!-- THESE ARE  NOTES FROM THE SERVICE CALL TABLE  -->

<b><small>Call Requirement / Instruction Notes</small></b>
<br><i><?php echo $model->notes?></i>
</td></tr>
<tr><td colspan="2"><hr></td></tr>
</table>

<table style="width:100%">
<tr><td colspan="4"><h3><i>Product Details</i></h3></td></tr>
<tr>

			<td width=25%><small><b>Product</b></small>
			<br>
			<?php echo $model->product->brand->name; ?>&nbsp;
			<?php echo $model->product->productType->name; ?>
			</td >
			<td width=25%><small><b>Model</b></small>
			<br>
			<?php echo $model->product->model_number; ?>
			</td>
			<td width=25%><small><b>Serial Number</b></small>
				<br>
				<?php echo $model->product->serial_number; ?>
			</td>
			<td width=25%><small><b>Product Code</b></small>
				<br>
				<?php echo $model->product->production_code; ?>
			</td>
		</tr>

		<tr>
			<td><small><b>Retailer</b></small>
			<br>
			<?php echo $model->product->purchased_from; ?>
			</td>			
			<td ><small><b>Date of Purchase</b></small>
			<br>
			<?php 
					if ($model->product->purchase_date!='')
				echo date ('d-M-Y',$model->product->purchase_date); ?>
			</td>			
			<td></td>
			<td></td>
		</tr>
		
		<tr><td colspan="4"><hr></td></tr>
</table>		
		
	 	
	<!-- 
		<td style="width:30%; vertical-align:top; ">
		<small><b>Product Notes</b></small>
		<br><?php echo $model->product->notes?>
		</td>
	 -->
	
<table style="width:100%">
<tr><td colspan="4"><h3><i>Fault Reported Detail</h3></i></td></tr>
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
			<td></td>
			</tr>
			
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
			<td></td>
		</tr>
		
		<tr>
		<td colspan="4" style="width:30%; vertical-align:top;"><small><b>Issue Reported</b></small>
			<br><?php echo $model->fault_description?><br><br><br>
		</td>
		</tr>
		
		<tr><td colspan="4"><hr></td></tr>
		</table>

	
<table style="width:100%">
<tr><td colspan="4"><h3><i>Technician Report</i></h3></td></tr>
		<tr><td colspan="4">
			<small><b>Work Carried out or Inspection</b></small>
			<br><?php echo $model->work_carried_out; ?>
			<br><br><br><br><br>
			
			<b><small>Please detail any test or results carried out</small></b>
			<br><br>
			<br><br>
			</td>
		 	</tr>
<tr><td colspan="4"><small><b>Spares</b></small>
<table style="width:650px;border-collapse:collapse;">
<tr>
	<td width=10% style="border:1px solid black;">Qty.</td>
	<td width=20% style="border:1px solid black;">Part Number</td>
	<td width=30% style="border:1px solid black;">Description</td>
	<td width=5% style="border:1px solid black;">Used</td>
	<td width=5% style="border:1px solid black;">Req.</td>
	<td width=15% style="border:1px solid black;">Price</td>
	<td width=15% style="border:1px solid black;">Total</td>
</tr>

<?php for ($i=1;$i<=7;$i++){?>
<tr>
	<td style="border-right:1px solid black; border-left:1px solid black;"><br></td>
	<td style="border-right:1px solid black;"><br></td>
	<td style="border-right:1px solid black;"><br></td>
	<td style="border-right:1px solid black;"><br></td>
	<td style="border-right:1px solid black;"><br></td>
	<td style="border-right:1px solid black;"><br></td>
	<td style="border-right:1px solid black;"><br></td>
</tr>
<?php }?>
<tr> 
	<td colspan="6" style="border-left:1px solid black;border-right:1px solid black;border-top:1px solid black; text-align:right;">Labour</td>
	<td style="border:1px solid black;"><br></td>
</tr>
<tr>
	<td colspan="6" style="border-left:1px solid black;border-right:1px solid black;  text-align:right;">Subtotal</td>
	<td style="border:1px solid black;"><br></td>
</tr>
<tr>
	<td colspan="6" style="border-left:1px solid black;border-right:1px solid black;  text-align:right;">VAT</td>
	<td style="border:1px solid black;"><br></td>
</tr>
<tr>
	<td colspan="6" style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;  text-align:right;">Total</td>
	<td style="border:1px solid black;"><br></td>
</tr>

</table><!-- end of Spares Table -->






</td></tr><!-- END OF SPARES TD -->

		
</table>
<br><br><br>


		
<table style="width:100%">
	<tr>
		<td>Call Completed</td>
		<td></td>
		<td>Customer Signature</td>
		<td></td>
	</tr>
	<tr>
		<td><?php echo date('d-M-Y',$model->job_finished_date); ?><hr></td>
		<td></td>
		<td><br><hr></td>
		<td></td>
	</tr>
</table>
			
			
			
			
					
		 <!-- 
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
			
			 -->
			 
			 <?php }?>
	