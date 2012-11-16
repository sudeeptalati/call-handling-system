<?php


$this->menu=array(
	//array('label'=>'List Servicecall', 'url'=>array('index')),
	array('label'=>'Create Service Call', 'url'=>array('servicecall/freeSearch')),
);

?>


<?php 


$model = new Servicecall('search');


//$engg_id = '90000005';
//$status_id = '3';

//$data = Servicecall::model()->enggJobReport($engg_id, $status_id);
//
//$serviceData = $enggjobdata->getData();
//
//foreach($serviceData as $test)
//{
//	echo "<br>Service call id = ".$test->id;
//	echo "<br>Reference id = ".$test->service_reference_number."<hr>";
//	
//}


?>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'servicecall-grid',
	//'dataProvider'=>$model->search(),
	//'dataProvider'=>Servicecall::model()->enggJobReport($engg_id, $status_id),
	'dataProvider'=>$enggjobdata,
	//'filter'=>$model,
	'columns'=>array(
		array(	'name'=>'service_reference_number',
				'value' => 'CHtml::link($data->service_reference_number, array("Servicecall/".$data->id))',
		 		'type'=>'raw',
        ),
		
		array('header' => 'Customer',
            	'name'=>'customer_name','value'=>'$data->customer->fullname'),
		array('name'=>'customer_town','value'=>'$data->customer->town'),
		array('name'=>'customer_postcode','value'=>'$data->customer->postcode'),
		//'product_id',
		array(	'header' => 'Product',
            	'name'=>'product_name',
				'value'=>'$data->product->brand->name." ".$data->product->productType->name',
				'filter'=>false),
		
		
		array(
			'name'=>'engineer_id',
			'value'=>'Engineer::item("Engineer",$data->engineer_id)',
			'filter'=>Engineer::items('Engineer'),
		),
		//'created_by_user_id',
		array('header' => 'RaisedBy',
            	'name'=>'user_name','value'=>'$data->createdByUser->name','filter'=>false),
		
		
		array(
			'name'=>'job_status_id',
			'value'=>'JobStatus::item("JobStatus",$data->job_status_id)',
			'filter'=>JobStatus::items('JobStatus'),
		),
		array(
			'name'=>'fault_date', 'value'=>'date("d-M-Y",$data->fault_date)'
		),
		
//		array(
//			'class'=>'CButtonColumn',
//			'template'=>'{view}',
//		),
	),
)); ?>



<?php 
//	if($startDate == '')
//	{
//		echo "Start Date is empty";
//		$startDate = "";
//	}
//	if($endDate == '')
//	{
//		echo "end Date is empty";
//		$endDate = "";
//	}
	$url=Yii::app()->request->getBaseUrl().'/servicecall/enggJobReport/?engg_id='.$engg_id.'&status_id='.$status_id.'&startDate='.$startDate.'&endDate='.$endDate;
	echo CHtml::link('Export to excel',$url);
?>

