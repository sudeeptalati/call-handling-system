 <div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>



<h1>View Brand #<?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'id',
		'name',
		'information',
		//'active',
		array(  'name'=>'active',
				'header'=>'Active',
				'value'=>$model->active == 0?"No":"Yes",
		),
		//'created_by_user_id',
		'createdByUser.username',
		//'created',
		array( 'name'=>'created', 'value'=>$model->created==null ? "":date("d-M-Y",$model->created)),
		//'modified',
		array( 'name'=>'modified', 'value'=>$model->modified==null ? "":date("d-M-Y",$model->modified)),
		//'inactivated'
		array( 'name'=>'inactivated', 'value'=>$model->inactivated==null ? "":date("d-M-Y",$model->inactivated)),
	),
)); 

?>
