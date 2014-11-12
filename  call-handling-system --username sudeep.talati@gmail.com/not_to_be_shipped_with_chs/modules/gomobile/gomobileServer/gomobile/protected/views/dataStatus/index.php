<?php
/* @var $this DataStatusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Data Statuses',
);

$this->menu=array(
	array('label'=>'Create DataStatus', 'url'=>array('create')),
	array('label'=>'Manage DataStatus', 'url'=>array('admin')),
);
?>

<h1>Data Statuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
