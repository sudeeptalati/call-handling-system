<?php
$this->breadcrumbs=array(
	'Uplifts Configs',
);

$this->menu=array(
	array('label'=>'Create UpliftsConfig', 'url'=>array('create')),
	array('label'=>'Manage UpliftsConfig', 'url'=>array('admin')),
);
?>

<h1>Uplifts Configs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
