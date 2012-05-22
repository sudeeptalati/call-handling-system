<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Job Status</h1>
<?php echo CHtml::link('Change Dashboard Priority Order', array('JobStatus/admin'));?>
<br><br>
<?php echo CHtml::link('Manage JobStatus', array('JobStatus/admin'));?>
<br><br>
<?php echo CHtml::link('Change Drop Down View Order', array('JobStatus/dropdownorder'));?>
<br><hr>


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
    'orderUrl'=>array('orderdropdown'),
    'successOrderMessage'=>'Dropdown Order Set',
    'buttonLabel'=>'Re Order my DD',
    'template' => '{summary} {items} {order} {pager}',
    'options'=>array(
        'cursor' => 'crosshair',
    ),
    'columns'=>array(

    'id',
    'name',
	'information',
 'view_order',
   
	array(
      		'name'=>'published',
      		'value'=>'$data->published ? "Yes" : "No"',
    		'type'=>'text',
			'filter'=>array('1'=>'Yes','0'=>'No'),
	
    	),
 		  
    ),
));
?>