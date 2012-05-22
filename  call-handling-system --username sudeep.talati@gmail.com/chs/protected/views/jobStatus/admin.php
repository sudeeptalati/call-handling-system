<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<?php 
Yii::app()->clientScript->registerScript('view-order-listener', "
$('.sort-view-order-link').click(function(){
	$('.sort_view_order').toggle();
	return false;
});
");



 Yii::app()->clientScript->registerScript('admin-table-listener', "
$('.admin-table-link').click(function(){
	$('.admin-table').toggle();
	return false;
});
");
 
?>


<h1>Job Status</h1>

<!-- ************* CODE FOR SORTING VIEW ORDER ****************** -->
<?php 
$dataProvider=new CActiveDataProvider('JobStatus', array(
    'criteria'=>array(
        'condition'=>'dashboard_display=1',
        'order'=>'dashboard_prority_order ASC',
       
    ),
    'pagination'=>array(
        'pageSize'=>50,
    ),
));

?>

<?php echo CHtml::link('Change Dashboard View Order','#', array('class'=>'sort-view-order-link'));?>
<br><br>
<div class="sort_view_order" style="display:none">

<b>Drag and Move Staus to desired order. Success will be refected by alert box</b>



<?php 
	$this->widget('ext.yii-RGridView.RGridViewWidget', array(
    'dataProvider'=>$dataProvider,
    'rowCssId'=>'$data->id',
    'orderUrl'=>array('order'),
    'successOrderMessage'=>'New Order Set',
    'buttonLabel'=>'Re-Order',
    'template' => '{summary} {items} {order} {pager}',
    'options'=>array(
        'cursor' => 'crosshair',
    ),
    'columns'=>array(
      		
    // 'dashboard_prority_order',
    'name',
	'information',

	array(
      		'name'=>'dashboard_display',
      		'value'=>'$data->dashboard_display ? "Yes" : "No"',
    		'type'=>'text',
			'filter'=>array('1'=>'Yes','0'=>'No'),
	
    	),
 		  
    ),
));

?>
</div>

<!-- **************** END OF CODE OF SORTING OF VIEW ORDER ***************** -->



<!--<div align="right"><small>See Next Page for custom status</small></div>-->
<?php echo CHtml::link('Manage JobStaus','#', array('class'=>'admin-table-link'));?>
<br><br>
<div class="admin-table" style="display:none">



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
 		//'view_order',
    	
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
</div>
 
<?php echo CHtml::link('Change Drop Down View Order', array('JobStatus/dropdownorder'));?>
<br><br>





