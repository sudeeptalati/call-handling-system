
<?php 
$displayResults=$results->getData();
$customerResults=$customer_results->getData();
/*
echo "<br>";
echo "Fault Description: ".$row['fault_description']."	   ";
echo "Customer Name : ".$row['customer_name']."			";
echo "Insurence Reference Number : ".$row['insurer_reference_number']."			";
*/
?>
<?php 

//$str = "	hello adsfdsaf	";
//$trim_str = trim($str); 
//echo "hi".$str."<hr>";
//echo "hi".$trim_str;


?>
<style type="text/css">
td,th{
vertical-align:top;
}
 

#remove_padding{
padding: 0px 0px 0px 0px;
vertical-align:top;
}			


</style>

<!-- ************ DISPLAYING DATA FROM SERVICECALL SEARCH RESULTS *********************** -->

<table style="border-radius:15px;">
	<tr style="background: #B7D6E7;">
		<th>Customer Name</th>
		<th style="width:7em;">Postcode</th>
		<th>Product</th>
		<th>Search Web</th>
		<th>Servicecalls</th>
	</tr>
	<?php 
	$count=0;
	
	$GLOBALS['my_gbp']='NAYA WALA';
	
	$GLOBALS['service_cust_id_list']=array();
	$list=array();
	
	
	foreach ($displayResults as $data)
	{
		/*Creating array List of coustomer ids sho that they are not displayed again*/
		array_push($GLOBALS['service_cust_id_list'], $data->customer->id );
		array_push($list, $data->customer->id );
		
		
		
		if ($count%2==0)
		$background='background: #EFFDFF;';
		else
		$background='background: #E5F1F4;';

	?>
	<tr style="<?php echo $background; ?>" >
		<td>
			<?php echo $data->customer->fullname;?>
			<br><small><?php echo CHtml::link('Edit Details', array('Customer/openDialog', 'customer_id'=>$data->customer->id,'product_id'=>$data->customer->product_id));?>
			</small>
		</td>
		
		<td>
			<form method="get" action="http://maps.google.com/maps/" target="_blank">
					<input type="hidden"   name="q" size="10"
				 	maxlength="255" value= "<?php echo $data->customer->postcode;?>" />
					<input type ="image" src="<?php echo Yii::app()->baseUrl.'/images/googlemaps.png';?>" title="See on Google Map" width='30' 'height'='30' />
					<span style="margin-left:-8px;">
					<?php echo $data->customer->postcode;?>
					</span>	
			</form>
		</td>
		
		<?php 
			$productModel = Product::model()->findAllByAttributes(array(
																	'customer_id'=>$data->customer->id,
																));
			$i=0;
			foreach ($productModel as $product)
			{
				if($i>0)
				{	
		?>
			<tr style="<?php echo $background; ?>" >
			<td><?php echo " ";?></td>
			<td><?php echo " ";?></td>
			<?php 
				}//end of if products grater than 1.
			?>
		
		<td><?php echo $product->brand->name;?>
			<?php echo $product->productType->name;?></td>
		
		<td>
		<form method="get" action="http://www.google.com/search" target="_blank">
			<input type="hidden"   name="q" size="10"
		 	maxlength="255" value= "<?php echo $product->brand->name." ".$product->productType->name." ".$product->model_number;?>" />
			<input type ="image" src="<?php echo Yii::app()->baseUrl.'/images/search.gif';?>" title="Search Web" width='25' 'height'='25' />
		</form>	
		</td>
		
		<?php 
			$serviceModel = Servicecall::model()->findAllByAttributes(
															array(
															'customer_id'=>$data->customer->id,
															'product_id' => $product->id
															),
															'job_status_id<:status',
															array(':status<5')
															);

			 
			$service_img_url = Yii::app()->request->baseUrl.'/images/service.gif';
			$service_img_html = CHtml::image($service_img_url,'Raise Service Call',array('width'=>25,'height'=>25, 'title'=>'Raise Service Call'));
																		
																		
			if(count($serviceModel)==0)
			{
				//echo "new";
			?>
			
			
			
			<td><?php echo CHtml::link($service_img_html, array('Servicecall/existingCustomer', 'customer_id'=>$data->customer->id, 'product_id'=>$product->id));?>
			<?php echo CHtml::link('New Call', array('Servicecall/existingCustomer', 'customer_id'=>$data->customer->id, 'product_id'=>$product->id))?></td>
			
			<?php 
			}//end of if no active servicecalls with this cust and prod. 
			else
			{
				foreach ($serviceModel as $service)
				{	
			?>
			
		<td><?php echo CHtml::link($service->service_reference_number, array('Servicecall/'.$service->id));?></td>
		<!--<td><?php //echo $service->jobStatus->name;?></td>-->

			<?php }//end of foreach of servicecall.?>
		<?php }//end of else of no active calls i.e, display call details.?>
		
	</tr>

	<?php $i++; }//end of product foreach.?>
	
	<tr style="<?php echo $background; ?>" >
	
	<tr style="<?php echo $background; ?>" >
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo CHtml::link($service_img_html, array('servicecall/addProduct','cust_id'=>$data->customer->id));?>
		<?php echo CHtml::link('Add Product & <br> Raise Servicecall', array('servicecall/addProduct','cust_id'=>$data->customer->id))?></td>
	</tr>
	<?php
		$count++;
	}//end of foreach.
	?>
	
	<!-- ************************ END OF SERVICECALL SEARCH RESULTS ******************** -->
	
<!--	<tr style="background: #B7D6E7;" >-->
<!--		<th>Customer Name</th>-->
<!--		<th>Postcode</th>-->
<!--	</tr>-->

<!-- ******************* DISPLAYING DETAILS OF CUSTOMER IN POSTCODE BUT DONT HVAVE SERVICECALL ********************* -->
	<?php 
		$count=0;
		foreach($customerResults as $custData)
		{
			if ( ! in_array($custData->id, $list)) 
			{
				if ($count%2==0)
				$background='background: #EFFDFF;';
				else
				$background='background: #E5F1F4;';
	?>
	
	<tr style="<?php echo $background; ?>" >
		
		<td><?php echo $custData->fullname;?></td>
		
		<td>
			<form method="get" action="http://maps.google.com/maps/" target="_blank">
					<input type="hidden"   name="q" size="10"
				 	maxlength="255" value= "<?php echo $custData->postcode;?>" />
					<input type ="image" src="<?php echo Yii::app()->baseUrl.'/images/googlemaps.png';?>" title="See on Google Map" width='30' 'height'='30' />
					<span style="margin-left:-8px;">
					<?php echo $custData->postcode;?>
					</span>	
			</form>
		</td>
		
		<?php 
			$cust_product = Product::model()->findAllByAttributes(array(
																	'customer_id'=>$custData->id,
															));
			$x=0;															
			foreach ($cust_product as $row)
			{	
				if($x>0)
				{															
		?>
			
		<tr style="<?php echo $background; ?>" >
			<td><?php echo " ";?></td>
			<td><?php echo " ";?></td>
			
		
		<?php $x++; }//end of if of $cust_product products more than 1.?>
		
		<td>
			<?php echo $row->brand->name;?>
			<?php echo $row->productType->name;?>
		</td>
		
		<td>
		<form method="get" action="http://www.google.com/search" target="_blank">
			<input type="hidden"   name="q" size="10"
		 	maxlength="255" value= "<?php echo $row->brand->name." ".$row->productType->name." ".$row->model_number;?>" />
			<input type ="image" src="<?php echo Yii::app()->baseUrl.'/images/search.gif';?>" title="Search Web" width='25' 'height'='25' />
		</form>	
		</td>
		
		<?php 
		$service_img_url = Yii::app()->request->baseUrl.'/images/service.gif';
		$service_img_html = CHtml::image($service_img_url,'Raise Service Call',array('width'=>30,'height'=>30, 'title'=>'Raise Service Call'));
		?>
		
		<td><?php echo CHtml::link($service_img_html, array('Servicecall/existingCustomer', 'customer_id'=>$custData->id, 'product_id'=>$row->id));?>
		<?php echo CHtml::link('Raise Servicecall', array('Servicecall/existingCustomer', 'customer_id'=>$custData->id, 'product_id'=>$row->id))?></td>
		
		</tr>
		
		<?php $x++; }//end of foreach of $cust_product to display product details. ?>
	
	</tr>
	
	<tr style="<?php echo $background; ?>" ></tr>
	
	<tr style="<?php echo $background; ?>" >
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td><?php echo CHtml::link($service_img_html, array('servicecall/addProduct','cust_id'=>$custData->id));?>
		<?php echo CHtml::link('Add Product & <br> Raise Servicecall', array('servicecall/addProduct','cust_id'=>$custData->id))?></td>

	
	<?php
		$count++;

			}//end of if of customer list	
		}//end of foreach of displaying customer search data.
	?>
	
	
</table>









