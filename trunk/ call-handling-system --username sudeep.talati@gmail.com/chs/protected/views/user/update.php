
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Manage Users',array('admin')); ?></td>
	<td> <?php echo CHtml::link('Create New User',array('create')); ?></td>
</tr></table>

<h1>Update User <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>