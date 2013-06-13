<?php


$this->menu=array(
	//array('label'=>'List Servicecall', 'url'=>array('index')),
	//array('label'=>'Create Service Call', 'url'=>array('servicecall/freeSearch')),
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
		array(
				'name'=>'job_status_id',
				'value'=>'JobStatus::item("JobStatus",$data->job_status_id)',
				'filter'=>JobStatus::items('JobStatus'),
		),
		array(
				'name'=>'fault_date', 'value'=>'date("d-M-Y",$data->fault_date)'
		),
		'net_cost',
		
		array('header' => 'Customer', 'value'=>'$data->customer->fullname'),
		array('header' => 'Address', 'value'=>'$data->customer->postcode'),
		array('header' => 'Brand', 'value'=>'$data->product->brand->name'),
		array('header' => 'Product Type', 'value'=>'$data->product->productType->name'),
		array('header' => 'Model Number', 'value'=>'$data->product->model_number'),
		array('header' => 'Serial Number', 'value'=>'$data->product->serial_number'),
		array('header' => 'Contract Type', 'value'=>'$data->contract->contractType->name'),
		'insurer_reference_number',
		'fault_description',
		'work_carried_out',
		array(
			'name'=>'engineer_id',
			'value'=>'Engineer::item("Engineer",$data->engineer_id)',
			'filter'=>Engineer::items('Engineer'),
		),
	),
)); ?>



<?php 

	$url=Yii::app()->request->getBaseUrl().'/servicecall/enggJobReport/?engg_id='.$engg_id.'&status_id='.$status_id.'&startDate='.$startDate.'&endDate='.$endDate;
	echo CHtml::link('Export to excel',$url);
?>

