
<?php include('gomobile_menu.php');  
/* @var $this GmJsonFieldsController */
/* @var $model GmJsonFields */

 
$this->menu=array(
	array('label'=>'Manage GmJsonFields', 'url'=>array('admin')),
);
?>

<h1>Create GmJsonFields</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>