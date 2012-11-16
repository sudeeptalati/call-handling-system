<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Manage Brands',array('admin')); ?></td>
	<td> <?php echo CHtml::link('Add New Brand',array('create')); ?></td>
</tr></table>

<h1>Create Brand</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>