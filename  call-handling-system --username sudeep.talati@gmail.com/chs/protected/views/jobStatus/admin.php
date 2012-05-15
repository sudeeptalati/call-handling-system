<?php  
$this->menu=array(
	array('label'=>'Change Logo', 'url'=>array('config/changeLogo')),
	array('label'=>'About & Help', 'url'=>array('config/about')),
	array('label'=>'Restore Database', 'url'=>array('config/restoreDatabase')),
	array('label'=>'Job Status', 'url'=>array('JobStatus/admin')),
	
);
 
?>

<?php 
Yii::app()->clientScript->registerScript('view-order-listener', "
$('.sort-view-order-link').click(function(){
	$('.sort_view_order').toggle();
	return false;
});
");
//
//Yii::app()->clientScript->registerScript('dashboard-order-listener', "
//$('.sort-dashboard-order-link').click(function(){
//	$('.sort_dashpriority_order').toggle();
//	return false;
//});
//");
?>


<h4>Manage Job Status</h4>

<!--<div align="right"><small>See Next Page for custom status</small></div>-->
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
)); 

?>


<!-- ************* CODE FOR SORTING VIEW ORDER ****************** -->
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

?>

<h4><?php echo CHtml::link('Change View Order','#', array('class'=>'sort-view-order-link'));?></h4>

<div class="sort_view_order" style="display:none">
<?php 
	$this->widget('ext.yii-RGridView.RGridViewWidget', array(
    'dataProvider'=>$dataProvider,
    'rowCssId'=>'$data->id',
    'orderUrl'=>array('order'),
    'successOrderMessage'=>'New Order Set',
    'buttonLabel'=>'Save',
    'template' => '{summary} {items} {order} {pager}',
    'options'=>array(
        'cursor' => 'crosshair',
    ),
    'columns'=>array(
      		
    //'view_order',
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
</div>

<!-- **************** END OF CODE OF SORTING OF VIEW ORDER ***************** -->



