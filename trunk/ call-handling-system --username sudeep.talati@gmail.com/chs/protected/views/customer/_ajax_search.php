
<?php 
$displayResults=$results->getData();

?>

<table border="1"><tr>
<th>Customer Name</th>
<th>Town</th>
<th>Postcode</th>
<th>Model Number</th>
<th>Serial Number</th>
<th>Date of Purchase</th>
<th>Warranty Date</th>
<th>Warranty For Months</th>
<th>Warranty untill</th>
</tr>


<?php 
foreach ($displayResults as $row)
{
?>	
	<tr>
	<td><?php echo CHtml::link($row->fullname, array('Servicecall/existingCustomer', 'customer_id'=>$row->id));?></td>
	<td><?php echo $row->town;?></td>
	<td><?php echo $row->postcode;?></td>
	<td><?php echo $row->product->model_number;?></td>
	<td><?php echo $row->product->serial_number;?></td>
	<td><?php echo $row->product->purchase_date;?></td>
	<td><?php echo $row->product->warranty_date;?></td>
	<td><?php echo $row->product->warranty_for_months;?></td>
	<?php 
	$warranty_date=$row->product->warranty_date;
	$warranty_months=$row->product->warranty_for_months;
	
	$php_w_date=strtotime($warranty_date);
	$warranty_until= strtotime(date("Y-M-d", strtotime($warranty_date)) . " +".$warranty_months." month");
	$res=date('d-M-Y', $warranty_until);
	?>
	<td><?php echo $res;?></td>
	</tr>
	
<?php 	
/*FOR $model
echo "<br>";
echo "Fault Description: ".$row['fault_description']."	   ";
echo "Customer Name : ".$row['customer_name']."			";
echo "Insurence Reference Number : ".$row['insurer_reference_number']."			";

*/
}
?>
</table>
