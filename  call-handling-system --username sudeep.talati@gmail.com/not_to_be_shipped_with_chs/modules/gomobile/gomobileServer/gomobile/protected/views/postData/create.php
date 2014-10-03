<?php
/* @var $this PostDataController */
/* @var $model PostData */

$this->breadcrumbs=array(
	'Post Datas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PostData', 'url'=>array('index')),
	array('label'=>'Manage PostData', 'url'=>array('admin')),
);
?>

<h1>Create PostData</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>