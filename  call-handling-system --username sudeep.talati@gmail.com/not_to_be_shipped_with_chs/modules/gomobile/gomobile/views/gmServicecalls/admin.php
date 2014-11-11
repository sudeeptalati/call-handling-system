<?php
/* @var $this GmServicecallsController */
/* @var $model GmServicecalls */

 include('gomobile_menu.php'); 

 
 
?>

<h1>Manage Gm Servicecalls</h1>

 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gm-servicecalls-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'servicecall_id',
		array(	'name'=>'service_reference_number',
				//'value'=>'$data->servicecall_id',
			    'value' => 'CHtml::link($data->service_reference_number, array("/Servicecall/view&id=".$data->servicecall_id))',
		 		'type'=>'raw',
				//'header' => 'Ref No#'
		),
		//'mobile_status',
		
		array('name'=>'mobile_status_id',
			'value'=>'$data->mobile_status->name',),
		
		
		array('name'=>'created', 'value'=>'$data->created==null ? "":date("d-M-Y",$data->created)', 'filter'=>false),
		array('name'=>'modified', 'value'=>'$data->modified==null ? "":date("d-M-Y",$data->modified)', 'filter'=>false),
		
		//'modified',
		//array(
			//'class'=>'CButtonColumn',
		//),
	),
)); ?>