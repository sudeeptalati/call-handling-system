<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Create Notification Rules',array('/notificationRules/create')); ?></td>
	<td> <?php echo CHtml::link('Manage Notification Rules',array('/notificationRules/admin')); ?></td>
	<td> <?php echo CHtml::link('SMS Setup',array('/setup/smsSettingsForm')); ?></td>
	<td> <?php echo CHtml::link('Email Setup',array('/setup/mailServer')); ?></td>
</tr></table>

<h1>Manage Notification Rules</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'notification-rules-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
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
		array(            
            //'name'=>'custom_column',
            //call the method 'gridDataColumn' from the controller
            'value'=>array($model,'displayMessageInGrid'), 
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
