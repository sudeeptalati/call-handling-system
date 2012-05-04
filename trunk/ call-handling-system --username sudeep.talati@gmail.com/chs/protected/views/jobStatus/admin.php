<?php  
$this->menu=array(
	array('label'=>'Change Logo', 'url'=>array('config/changeLogo')),
	array('label'=>'About & Help', 'url'=>array('config/about')),
	array('label'=>'Restore Database', 'url'=>array('config/restoreDatabase')),
	array('label'=>'Job Status', 'url'=>array('JobStatus/admin')),
	
);
 
?>



<?php 

$dataProvider=new CActiveDataProvider('JobStatus', array(
    'criteria'=>array(
        'condition'=>'published=1',
        'order'=>'view_order ASC',
       
    ),
    'pagination'=>array(
        'pageSize'=>50,
    ),
));


	$this->widget('ext.yii-RGridView.RGridViewWidget', array(
    'dataProvider'=>$dataProvider,
    'rowCssId'=>'$data->id',
    'orderUrl'=>array('order'),
    'successOrderMessage'=>'New Order Set, Please Refresh Page',
    'buttonLabel'=>'Save',
    'template' => '{summary} {items} {order} {pager}',
    'options'=>array(
        'cursor' => 'crosshair',
    ),
    'columns'=>array(
      		
    'view_order',
    'name',
			'information',

	array(
      		'name'=>'published',
      		'value'=>'$data->published ? "Yes" : "No"',
    		'type'=>'text',
			'filter'=>array('1'=>'Yes','0'=>'No'),
	
    	),
 		  
    ),
));

?>



<h4>Manage Job Status</h4>




<div align="right"><small>See Next Page for custom status</small></div>
<?php 


$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'job-status-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		'name',
		'information',

	array(
      		'name'=>'published',
      		'value'=>'$data->published ? "Yes" : "No"',
    		'type'=>'text',
			'filter'=>array('1'=>'Yes','0'=>'No'),
	
    	),
 		'view_order',
    	
    	array(
      		'name'=>'dashboard_display',
      		'value'=>'$data->dashboard_display ? "Yes" : "No"',
    		'type'=>'text',
			'filter'=>array('1'=>'Yes','0'=>'No'),
	
    	),
    	
    	
    	
    
		/*
		
		'updated_by_user_id',
		'updated',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}	{update}',
		),
	),
)); ?>




			