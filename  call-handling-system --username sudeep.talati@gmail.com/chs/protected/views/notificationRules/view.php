<table><tr>
	<td> <?php echo CHtml::link('Create Notification Rules',array('/notificationRules/create')); ?></td>
	<td> <?php echo CHtml::link('Manage Notification Rules',array('/notificationRules/admin')); ?></td>
	<td> <?php echo CHtml::link('SMS Setup',array('/setup/smsSettingsForm')); ?></td>
	<td> <?php echo CHtml::link('Email Setup',array('/setup/mailServer')); ?></td>
</tr></table>
<h1>View Notification Rules :  <?php echo $model->jobStatus->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'job_status_id',
		array('name'=>'status_changed','value'=>$model->jobStatus->name),
		//'active',
		array('label'=>'active', 'value'=>$model->active ? "Yes" : "No"),
		//'customer_notification_code',
		array('name'=>'customer_notification','value'=>$model->customerNotificationCode->notify_by),
		//'engineer_notification_code',
		array('name'=>'engineer_notification','value'=>$model->engineerNotificationCode->notify_by),
		//'warranty_provider_notification_code',
		array('name'=>'warranty_provider_notification','value'=>$model->warrantyProviderNotificationCode->notify_by),
		//'notify_others',
		array('label'=>'notify_others', 'value'=>$model->notify_others ? "Yes" : "No"),
		//'created',
		array('name'=>'created', 'value'=>date('d-M-y',$model->created)),
		//'modified',
		//array('name'=>'Modified', 'value'=>date('d-M-y',$model->modified)),
		//'delete',
	),
)); ?>

