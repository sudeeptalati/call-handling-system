<?php 

//echo "<br>engg id from contr = ".$engg_id;



?>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->enggProductReport($engg_id),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		//'contract_id',
		array( 'name'=>'contracter_name', 'value'=>'$data->contract->name' ),
		//'brand_id',
		array( 'name'=>'brand_name', 'value'=>'$data->brand->name' ),
		//'product_type_id',
		array( 'name'=>'product_name', 'value'=>'$data->productType->name' ),
		//'customer_id',
		array('name'=>'customer_name', 'value'=>'$data->customer->fullname'),
		//'engineer_id',
		array( 'name'=>'engineer_name', 'value'=>'$data->engineer->fullname' ),
		//'created_by_user',
		//array( 'name'=>'created_by_user', 'value'=>'$data->createdByUser->username' ),
	),
));

$url=Yii::app()->request->getBaseUrl().'/Reports/enggProdExport/?engg_id='.$engg_id;
echo CHtml::link('Export to excel',$url);

?>
