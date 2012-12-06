<?php
$this->breadcrumbs=array(
	'Notification Rules'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List NotificationRules', 'url'=>array('index')),
	array('label'=>'Create NotificationRules', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('notification-rules-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Notification Rules</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'notification-rules-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'job_status_id',
		array('name'=>'status_changed','value'=>'$data->jobStatus->name'),
		//'active',
		array(
			'name'=>'active',
			'value'=>'($data->active == 0) ? "No" : "Yes"'
		),
		//'customer_notification_code',
		array('name'=>'customer_notification','value'=>'$data->customerNotificationCode->notify_by'),
		//'engineer_notification_code',
		array('name'=>'engineer_notification','value'=>'$data->engineerNotificationCode->notify_by'),
		//'warranty_provider_notification_code',
		array('name'=>'warranty_provider_notification','value'=>'$data->warrantyProviderNotificationCode->notify_by'),
		//'notify_others',
		array(
			'name'=>'notify_others',
			'value'=>'($data->notify_others == 0) ? "No" : "Yes"'
		),
		/*
		'created',
		'modified',
		'delete',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
