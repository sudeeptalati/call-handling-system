<?php include('graph_menu.php'); ?>   
 
 
<?php
$this->menu=array(
	//array('label'=>'List GraphReportfields', 'url'=>array('index')),
	array('label'=>'Create GraphReportfields', 'url'=>array('create')),
);
?>

<h1>Manage Graph Report Fields</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'graph-reportfields-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'report_type',
		'field_name',
		'field_type',
		'field_relation',
		'field_label',
		/*
		'sort_order',
		'active',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
