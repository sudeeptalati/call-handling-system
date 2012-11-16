
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Manage Contracts',array('admin')); ?></td>
	<td> <?php echo CHtml::link('Create Contracts',array('create')); ?></td>
</tr></table>

<h1>Update Contract <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>