<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>



<h1>View AdvanceSettings :<?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'parameter',
		'name',
		'value',
	),
)); ?>
