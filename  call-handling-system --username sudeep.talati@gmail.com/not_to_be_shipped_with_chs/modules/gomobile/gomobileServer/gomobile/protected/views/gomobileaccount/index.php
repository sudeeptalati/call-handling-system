<?php
/* @var $this GomobileaccountController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gomobile Accounts',
);

$this->menu=array(
	array('label'=>'Create GomobileAccount', 'url'=>array('create')),
	array('label'=>'Manage GomobileAccount', 'url'=>array('admin')),
);
?>

<h1>Gomobile Accounts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
