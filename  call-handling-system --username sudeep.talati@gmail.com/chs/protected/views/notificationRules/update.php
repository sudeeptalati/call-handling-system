

<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Manage Notification Rules',array('admin')); ?></td>
	<td> <?php echo CHtml::link('Create Notification Rules',array('create')); ?></td>
</tr></table>

<h1>Update NotificationRules <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'showDialogue'=>'0')); ?>