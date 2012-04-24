
<?php 
$displayResults=$results->getData();
?>

<table border="1"><tr>
<th>Customer Name</th>
<th>Town</th>
<th>Postcode</th>
<th>Product</th>
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
	<td><?php //echo CHtml::link($row->fullname, array('Servicecall/existingCustomer', 'customer_id'=>$row->id));?>
		<?php echo $row->fullname;?></td>
	<td><?php echo $row->town;?></td>
	<td><?php echo $row->postcode_s;?></td>
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
	
	<td>
		<?php //echo $row->product->brand->name;?>
		<?php //echo $row->product->productType->name;?>
		<?php //echo $data->productType->name;?>
		<?php echo CHtml::link($data->brand->name." ".$data->productType->name, array('Servicecall/existingCustomer', 'customer_id'=>$row->id, 'product_id'=>$data->id));?>	
		
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
	<td><?php //echo date('d-M-y', $row->product->purchase_date);?></td>
	<td><?php //echo date('d-M-y', $row->product->warranty_date);?></td>
	<td><?php //echo $row->product->warranty_for_months;?></td>
	
	<?php 
//	$warranty_date=$row->product->warranty_date;
//	$warranty_months=$row->product->warranty_for_months;
//	
//	$php_w_date=strtotime($warranty_date);
//	$warranty_until= strtotime(date("Y-M-d", $warranty_date) . " +".$warranty_months." month");
//	$res=date('d-M-Y', $warranty_until);
	?>
	</tr>
	<?php 
		$i++;
		}//end of inner foreach().
		
	}//end of outer forrach().
	
	?>
	
<?php 	
/*FOR $model
echo "<br>";
echo "Fault Description: ".$row['fault_description']."	   ";
echo "Customer Name : ".$row['customer_name']."			";
echo "Insurence Reference Number : ".$row['insurer_reference_number']."			";

*/
?>
</table>
