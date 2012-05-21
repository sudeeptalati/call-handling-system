
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Manage Engineers',array('admin')); ?></td>
	<td> <?php echo CHtml::link('Add New Engineer',array('create')); ?></td>
</tr></table>

<h1>Add New Engineer</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>