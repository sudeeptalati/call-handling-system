<?php


$this->menu=array(
	//array('label'=>'List Servicecall', 'url'=>array('index')),
	array('label'=>'Create Service Call', 'url'=>array('servicecall/freeSearch')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('servicecall-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Servicecalls</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'servicecall-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'service_reference_number',
		array(	'name'=>'service_reference_number',
				'value' => 'CHtml::link($data->service_reference_number, array("Servicecall/".$data->id))',
		 		'type'=>'raw',
        ),
		
/*
		array('name'=>'job_status',
			  'value'=>'$data->jobStatus->name'
		),
*/
		//'customer_id',
		array('name'=>'customer_name','value'=>'$data->customer->fullname'),
		array('name'=>'customer_town','value'=>'$data->customer->town'),
		array('name'=>'customer_postcode','value'=>'$data->customer->postcode'),
		//'product_id',
		array('name'=>'product_name','value'=>'$data->product->productType->name'),
		
		//'job_status_id',
		
//		array('name'=>'job_status',
//			  'filter'=> CHtml::listData(JobStatus::model()->findAll(), 'id', 'name'),
//			  'value'=>'$data->jobStatus->name',
//			 ),
		//'contract_id',
	//	array('name'=>'contract_name','value'=>'$data->contract->name'),
//		'engineer_id',
		//array('name'=>'engineer_name','value'=>'$data->engineer->fullname'),
		array(
			'name'=>'engineer_id',
			'value'=>'Engineer::item("Engineer",$data->engineer_id)',
			'filter'=>Engineer::items('Engineer'),
		),
		'created_by_user_id',
		//array('name'=>'user_name','value'=>'$data->createdByUser->name'),
		
//		array(
//			'name'=>'created_by_user_id',
//			'value'=>'User::item("User",$data->created_by_user_id)',
//			'filter'=>User::items('User'),
//		),
//		
		
		
		array(
			'name'=>'job_status_id',
			'value'=>'JobStatus::item("JobStatus",$data->job_status_id)',
			'filter'=>JobStatus::items('JobStatus'),
		),
		
		
		
		/*
		'insurer_reference_number',
		'job_status_id',
		'fault_date',
		'fault_code',
		'fault_description',
		'engg_diary_id',
		'work_carried_out',
		'spares_used_status_id',
		'total_cost',
		'vat_on_total',
		'net_cost',
		'job_payment_date',
		'job_finished_date',
		'notes',
		'created',
		'modified',
		'cancelled',
		'closed',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
		),
	),
)); ?>
