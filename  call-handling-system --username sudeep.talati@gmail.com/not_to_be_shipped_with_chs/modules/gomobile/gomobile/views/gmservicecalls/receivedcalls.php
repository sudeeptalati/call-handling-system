<?php
/* @var $this GmServicecallsController */
/* @var $model GmServicecalls */

 include('gomobile_menu.php'); 

?>

<h1>Manage Received Servicecalls</h1>

 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gm-servicecalls-grid',
	'dataProvider'=>$model->search_receivedcall(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'servicecall_id',
		array(	'name'=>'service_reference_number',
				//'value'=>'$data->servicecall_id',
			    'value' => 'CHtml::link($data->service_reference_number, array("/gomobile/gmservicecalls/receivedcalldetails&id=".$data->id))',
		 		'type'=>'raw',
				'filter'=>false,
				'header' => 'Service Ref No#'
		),
		//'mobile_status',
		
		array('name'=>'server_status_id',
			'value'=>'$data->server_status->name',
			'filter'=>false),
			
		array(	'header' => 'Customer',
            	'name'=>'customer_name',
				'value'=>'$data->servicecall->customer->fullname',
				'filter'=>false
				),
		array(	'header' => 'Address',
            	'name'=>'customer_address',
				'value'=>'$data->servicecall->customer->postcode',
				'filter'=>false
				),
			
			
		
		
		array('name'=>'created', 'value'=>'$data->created==null ? "":date("d-M-Y",$data->created)', 'filter'=>false),
		array('name'=>'modified', 'value'=>'$data->modified==null ? "":date("d-M-Y",$data->modified)', 'filter'=>false),
		
		//'modified',
		//array(
			//'class'=>'CButtonColumn',
		//),
		array(	'header' => 'Comments',
            	'name'=>'comments',
				'value'=>'$data->comments',
				'filter'=>false
				),
		//'comments',
	),
)); ?>
