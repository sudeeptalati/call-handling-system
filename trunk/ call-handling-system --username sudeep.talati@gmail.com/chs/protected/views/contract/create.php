
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Manage Contracts',array('admin')); ?></td>
	<td> <?php echo CHtml::link('Create Contracts',array('create')); ?></td>
</tr></table>


<h1>Create Contract</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
<?php //echo $this->renderPartial('_form', array('contract'=>$contractModel, 'contactDetails'=>$contactDetailsModel)); ?>