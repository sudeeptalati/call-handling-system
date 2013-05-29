<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>
 



<h1>Job Status</h1>
<div id="submenu">   
<li><?php echo CHtml::link('Change Dashboard Priority Order', array('JobStatus/admin'));?></li>
<li><?php echo CHtml::link('Manage JobStatus', array('JobStatus/admin'));?></li>
<li><?php echo CHtml::link('Change Drop Down View Order', array('JobStatus/dropdownorder'));?></li>
</div><!-- END OF DIV SUBMENU -->


<br>


 <b>Job Status Drop Down Order: </b>
			<?php
			
						$jobStatusModel=Servicecall::model()->updateStatus();
 
						$list=CHtml::listData($jobStatusModel, 'id','name');
				 
						echo CHtml::dropDownList('', 'id',$list);
				  
			?>
	<br>
	<br><b><i><u>How To Use</u></i></b>	
	<br> <b>Step 1: </b>Click on any status 
  	<br> <b>Step 2: </b>Drag or Move Staus to desired order
	<br> <b>Step 3: </b>Click on Re-Order Drop Down Button at bottom
	<br> <b>Step 4: </b>Success will be refected by alert box</b>
			
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
    'buttonLabel'=>'Re Order Drop Down ',
    'template' => '{summary} {items} {order} {pager}',
    'options'=>array(
        'cursor' => 'crosshair',
    ),
    'columns'=>array(

    //'id',
    'name',
	'information',
 //'view_order',
   
	array(
      		'name'=>'published',
      		'value'=>'$data->published ? "Yes" : "No"',
    		'type'=>'text',
			'filter'=>array('1'=>'Yes','0'=>'No'),
	
    	),
 		  
    ),
));
?>