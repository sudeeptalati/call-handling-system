<?php
$this->breadcrumbs=array(
	'Addons',
);

$this->menu=array(
	array('label'=>'Create Addons', 'url'=>array('create')),
	array('label'=>'Manage Addons', 'url'=>array('admin')),
);
?>

<h1>Addons</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
