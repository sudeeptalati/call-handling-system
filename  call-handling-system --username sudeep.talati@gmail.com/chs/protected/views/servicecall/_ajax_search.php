
<?php 

$displayResults=$results->getData();

foreach ($displayResults as $row)
{
echo "Fault Description : ".$row->fault_description."	";
echo "Customer Name : ".$row->customer->fullname."	";
echo "Insurence Reference Number : ".$row->insurer_reference_number."	"."<br>";
	
/*
echo "<br>";
echo "Fault Description: ".$row['fault_description']."	   ";
echo "Customer Name : ".$row['customer_name']."			";
echo "Insurence Reference Number : ".$row['insurer_reference_number']."			";

*/
}
?>