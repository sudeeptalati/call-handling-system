
<?php 
$displayResults=$results->getData();
?>

<table border="1"><tr>
<th>Customer Name</th>
<th>Town</th>
<th>Postcode</th>
<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Product</th>
<th>Model Number</th>
<th>Serial Number</th>
<th></th>

<!--<th>Model Number</th>-->
<!--<th>Serial Number</th>-->
<!-- 
<th>Date of Purchase</th>
<th>Warranty Date</th>

<th>Warranty For Months</th>
<th>Warranty untill</th>
 -->
</tr>


<?php

foreach ($displayResults as $row)
{
//	$result=Product::model()->findAllByAttributes(array('customer_id'=>$row->id));
//	foreach($result as $data)
//	{
	
?>	
	<tr>
	<td>
		<?php echo $row->fullname;?>
		<br><small><?php echo CHtml::link('Edit Details', array('Customer/openDialog', 'customer_id'=>$row->id,'product_id'=>$row->product_id));?>
		</small>
		
		</td>
	<td><?php echo $row->town;?></td>
	<td><?php echo $row->postcode;?></td>
	<?php 
		
		$result=Product::model()->findAllByAttributes(array('customer_id'=>$row->id));
		$i=0;
		foreach($result as $data)
		{
			//echo $i;
			if($i>0)
			{
			
	?>
		<td><?php echo " ";?></td>
		<td><?php echo " ";?></td>
		<td><?php echo " ";?></td>
	<?php }//end of if(i>0).?>
	
	
	
	<?php 
			$service_img_url = Yii::app()->request->baseUrl.'/images/service.gif';
			$service_img_html = CHtml::image($service_img_url,'Raise Service Call',array('width'=>20,'height'=>20)); 
			?>	
			
<style type="text/css">

#my{
padding: 0px 0px 0px 0px;
}			


</style>
	<td>
		<table>
			<tr>
				<td id="my"><?php echo CHtml::link($service_img_html, array('Servicecall/existingCustomer', 'customer_id'=>$row->id, 'product_id'=>$data->id));?></td>
				<td id="my"><?php echo $data->brand->name;?>
				<?php echo $data->productType->name;?>
		
					<br>
					<small><b>
				<?php echo CHtml::link('Raise Service Call', array('Servicecall/existingCustomer', 'customer_id'=>$row->id, 'product_id'=>$data->id));?>	
				</b></small>
				</td>
			<tr>
		</table>
	
	</td>
	<td><?php echo $data->model_number;?></td>
	<td><?php echo $data->serial_number;?></td>
	<td>
		<form method="get" action="http://www.google.com/search" target="_blank">
			<input type="hidden"   name="q" size="10"
		 	maxlength="255" value= "<?php echo $data->brand->name." ".$data->productType->name." ".$data->model_number;?>" />
			<input type ="image" src="<?php echo Yii::app()->baseUrl.'/images/google.jpg';?>" height="30" width="50" alt="submit form" />
		</form>	
	</td>
	
	<!--<td><?php //echo date('d-M-y', $row->product->purchase_date);?></td>
	<td><?php //echo date('d-M-y', $row->product->warranty_date);?></td>
	<td><?php //echo $row->product->warranty_for_months;?></td>-->
	
	</tr>
	<?php 
		$i++;
		}//end of inner foreach().
		
	}//end of outer foreach().
	
	?>
	

</table>
 <p align="right"><?php echo CHtml::link('Add Product and create Servicecall', array('servicecall/addProduct','cust_id'=>$row->id))?></p>
			