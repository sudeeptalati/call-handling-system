<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'job-status-dashboardOrder-form',
	'enableAjaxValidation'=>false,
)); ?>

	
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

<?php 
	$this->widget('ext.yii-RGridView.RGridViewWidget', array(
    'dataProvider'=>$dataProvider,
    'rowCssId'=>'$data->id',
    'orderUrl'=>array('dashboardOrder'),
    'successOrderMessage'=>'New dashbord Set',
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
      		'name'=>'dashboard_display',
      		'value'=>'$data->dashboard_display ? "Yes" : "No"',
    		'type'=>'text',
			'filter'=>array('1'=>'Yes','0'=>'No'),
	
    	),
 		  
    ),
));

?>

	
<?php $this->endWidget(); ?>

</div><!-- form -->