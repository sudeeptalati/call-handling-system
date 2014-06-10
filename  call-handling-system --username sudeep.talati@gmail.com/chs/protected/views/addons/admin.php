 


<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Addons</h1>


<div id="submenu">   
<li><?php echo CHtml::link('Manage',array('admin')); ?></li>
<li><?php echo CHtml::link('Install',array('index')); ?></li>

</div>
 



 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'addons-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	
	/*
	'selectableRows'=>1,
	'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('update').'/id/"+$.fn.yiiGridView.getSelection(id);}',
	*/
	
	'columns'=>array(
		//'id',
		'type',
		'addon_label',
		//'information',
		//'active',
 		
		
	
		
		array(  'name'=>'active',
				'header'=>'Active',
				'value'=>'($data->active == 0)?"Disabled":"Enabled"',
				'filter'=>array('1'=>'Enabled', '0'=>'Disabled'),
		),	
		
		
		array(	'name'=>'active',
				'header'=>'Actions',
				'value' => 'CHtml::link(($data->active == 0)?"Enable":"Disable", array("addons/update&id=".$data->id))',
		 		'type'=>'raw',
				'filter'=>false,
        ),
		
		
		array( 'name'=>'created_on', 'value'=>'$data->created_on==null ? "":date("d-M-Y",$data->created_on)', 'filter'=>false),
		
		
		'link'=>array(
                        'header'=>'Actions',
                        'type'=>'raw',
                        'value'=> 'CHtml::button("Uninstall",array("onclick"=>"document.location.href=\'".Yii::app()->controller->createUrl("addons/uninstall",array("id"=>$data->id))."\'"))',
        ),     
		
		
		/*
		'created_by',
		'inactivated_on',
		'inactivated_by',
		*/
		
		/*
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}',
		),
		*/
		
		
	),
)); ?>
