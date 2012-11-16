
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>
 

<?php echo CHtml::link('Manage Jobstatus',array('admin')); ?>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'name',
		'information',
	 
 		array(
      		'label'=>'Published',
      		'value'=>$model->published ? "Yes" : "No",
    	),	
		'view_order',
		
		//'updatedByUser.name',
    	
		 array(  'name'=>'Last Updated By',
				 'value'=>$model->updatedByUser->name,
			),
    	
    	
    	array(  'name'=>'updated',
					'value'=>(date('d-M-Y H:i',$model->updated)),
			),
	),
)); ?>
