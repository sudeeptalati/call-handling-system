<?php
header("Cache-Control: public");
header("Content-Description: File Transfer");
//header("Content-Disposition: attachment; filename=$file");
header("Content-Transfer-Encoding: binary");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
header( "Content-Disposition: inline; filename=\"Engineer Report  ".date("F j, Y").".xls\"" );


$dataProvider = $criteriaData;
$dataProvider->pagination = false;

?>
        <table border="1"> 
        <tr>
			<th>Service reff no</th>
			<th>Job Status </th>
			<th>Reported Date</th>
			<th>Net Cost</th>
			<th>Customer </th>
			<th>Address </th>
			<th>Brand </th>
			<th>Product Type </th>
			<th>Model Number </th>
			<th>Serial Number </th>
			<th>Contract Type </th>
			<th>Contract Ref. No </th>
			<th>Issue </th>
			<th>Work carried out </th>
			<th>Engineer </th>
			
			
		</tr>
		<?php 
		foreach( $dataProvider->data as $data )
		{
		?>
			<tr> 
				<td><?php echo $data->service_reference_number;?></td>
				<td><?php echo $data->jobStatus->name;?></td>
				<td><?php echo date('d-M-Y',$data->fault_date);?></td>
				<td><?php echo $data->net_cost;?></td>
				<td><?php echo $data->customer->fullname;?></td>
				<td><?php echo $data->customer->postcode;?></td>
				<td><?php echo $data->product->brand->name;?></td>
				<td><?php echo $data->product->productType->name;?></td>
				<td><?php echo $data->product->model_number;?></td>
				<td><?php echo $data->product->serial_number;?></td>
				<td><?php echo $data->contract->contractType->name;?></td>
				<td><?php echo $data->insurer_reference_number;?></td>
				<td><?php echo $data->fault_description;?></td>
				<td><?php echo $data->work_carried_out;?></td>
				<td><?php echo $data->engineer->fullname;?></td>
				
			</tr>
        
        <?php }//end of foreach($dataProvider); ?> 
		
		</table>