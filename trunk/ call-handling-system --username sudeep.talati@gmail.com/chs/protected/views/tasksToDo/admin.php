<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>


<h1>Tasks To Dos</h1>

<div id="submenu">   
<li><?php echo CHtml::link('Tasks Lifetime',array('/tasksToDo/tasksLifetime')); ?></li>
<li><?php echo CHtml::link('Perform Tasks',array('/tasksToDo/completeTasks')); ?></li>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tasks-to-do-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'task',
		'status',
		'msgbody',
		'subject',
		'send_to',
		array( 'name'=>'created', 'value'=>'$data->created==null ? "":date("d-M-Y",$data->created)'),
		/*
		'created',
		'scheduled',
		'executed',
		'finished',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
