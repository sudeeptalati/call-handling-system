<?php
 

$this->menu=array(
	array('label'=>'Change Logo', 'url'=>array('config/changeLogo')),
	array('label'=>'About & Help', 'url'=>array('config/about')),
	array('label'=>'Restore Database', 'url'=>array('config/restoreDatabase')),
	array('label'=>'Job Status', 'url'=>array('JobStatus/admin')),
	
);
?>

 
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
