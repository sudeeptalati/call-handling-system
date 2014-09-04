<h1>Merge Customers</h1>


<?php 
	$selectedcustomer = Customer::model()->findByPk($primary_id);
	echo "<h2> Selected Customer :".$selectedcustomer->fullname." </h2>";
	
	echo 'prid id'.$primary_id;
	
	$pri_cust_id  = $primary_id;
	
	
	$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	//'dataProvider'=>$model->search(),
	'dataProvider'=> $model->testsearch($primary_id),
	'filter'=> $model, 
	'columns'=>array(
		/*
		array(	'name'=>'fullname',
				'value' => 'CHtml::link($data->fullname, array("Servicecall/view&id=".$data->id))',
		 		'type'=>'raw',
        ),
		*/
		'fullname',
		'town',
		'postcode',
		array('name'=>'product_brand','value'=>'$data->product->brand->name'),
		array('name'=>'product_type','value'=>'$data->product->productType->name'),
		array('name'=>'model_number','value'=>'$data->product->model_number'),
		array('name'=>'serial_number','value'=>'$data->product->serial_number'),
		array('name'=>'created', 'value'=>'date("d-M-Y",$data->created)', 'filter'=>false),
		array(
			//'name'=>'',
			'type' => 'raw',
			'value' => 'CHtml::link("Select to merge",array("default/mergeCustomer", "secondary_id"=>$data->id, "primary_id"=>'.$primary_id.') )',
					   
		),
	),
)); 
?>
