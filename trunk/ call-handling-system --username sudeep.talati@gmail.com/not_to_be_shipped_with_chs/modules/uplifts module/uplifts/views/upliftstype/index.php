<?php
$this->breadcrumbs=array(
	'Uplifts Types',
);

$this->menu=array(
	array('label'=>'Create UpliftsType', 'url'=>array('create')),
	array('label'=>'Manage UpliftsType', 'url'=>array('admin')),
);
?>

<h1>Uplifts Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
