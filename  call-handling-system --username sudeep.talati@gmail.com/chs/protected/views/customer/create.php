<?php

$this->menu=array(
	array('label'=>'Manage Customer', 'url'=>array('admin')),
);
?>

<h1>Customer Registration</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>