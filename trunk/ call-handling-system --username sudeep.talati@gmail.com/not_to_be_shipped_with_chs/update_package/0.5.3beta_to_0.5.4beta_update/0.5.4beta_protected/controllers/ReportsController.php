<?php 
class ReportsController extends Controller
{
	public function actionEnggProductReport()
	{
		//echo "In engg prod report action";
		//echo "<br>engg id from url = ".$_GET['enggprodlist'];
		$engg_id = $_GET['enggprodlist'];
		
		//Product::model()->enggProductReport($engg_id);
		$model = new Product('search');
		$model->unsetAttributes(); 
		
		$this->render('/product/enggProdReport', array('model'=>$model, 'engg_id'=>$engg_id));
		
	}//end of EnggProductReport.
	
	public function actionEnggProdExport($engg_id)
	{
		//echo "<hr>engg id in export contr = ".$engg_id;
		header("Cache-Control: public");
  		header("Content-Description: File Transfer");
    	header("Content-Transfer-Encoding: binary");
    	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past	
		header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
		header( "Content-Disposition: inline; filename=\"Engineer Report  ".date("F j, Y").".xls\"" );
		
		
        $dataProvider = Product::model()->enggProductReport($engg_id);
        $dataProvider->pagination = False;
        
        ?>
        <table border="1"> 
        <tr>
        	<th>Contract</th>
			<th>Brand</th>
			<th>Product </th>
			<th>Customer </th>
			<th>Town </th>
			<th>Postcode </th>
			<th>Engineer </th>
			
		</tr>
		<?php 
		foreach( $dataProvider->data as $data )
		{
		?>
			<tr> 
				<td><?php echo $data->contract->name;?></td>
				<td><?php echo $data->brand->name;?></td>
				<td><?php echo $data->productType->name;?></td>
				<td><?php echo $data->customer->fullname;?></td>
				<td><?php echo $data->customer->town;?></td>
				<td><?php echo $data->customer->postcode;?></td>
				<td><?php echo $data->engineer->fullname;?></td>
				
			</tr>
        
        <?php }//end of foreach($dataProvider); ?> 
		
		</table>
		
        <?php 
		
	}//end of enggProdExport().
	
}//end of class.


?>