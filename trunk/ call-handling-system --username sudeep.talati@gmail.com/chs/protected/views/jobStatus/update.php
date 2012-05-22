
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<?php echo CHtml::link('Manage Jobstatus',array('admin')); ?>
<h1>Update Job Status </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>