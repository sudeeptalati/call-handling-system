<?php
/* @var $this PostDataController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Post Datas',
);

$this->menu=array(
	array('label'=>'Create PostData', 'url'=>array('create')),
	array('label'=>'Manage PostData', 'url'=>array('admin')),
);
?>

<h1>Post Datas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
