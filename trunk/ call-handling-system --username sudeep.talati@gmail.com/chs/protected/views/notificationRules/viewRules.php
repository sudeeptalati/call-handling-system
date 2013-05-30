<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<table><tr>
	<td> <?php echo CHtml::link('Create Notification Rules',array('/notificationRules/create')); ?></td>
	<td> <?php echo CHtml::link('Manage Notification Rules',array('/notificationRules/admin')); ?></td>
	<td> <?php echo CHtml::link('SMS Setup',array('/setup/smsSettingsForm')); ?></td>
	<td> <?php echo CHtml::link('Email Setup',array('/setup/mailServer')); ?></td>
</tr></table>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notification-rules-viewRules-form',
	'enableAjaxValidation'=>false,
)); ?>

	<h1>View Notification Rules :  <?php echo $model->jobStatus->name; ?></h1>

	<?php echo $form->errorSummary($model); ?>

	<table><tr>
		<td>
			<?php echo $form->labelEx($model,'job_status_id'); ?>
			<?php //echo $form->textField($model,'job_status_id'); ?>
			<?php echo CHtml::textField('', $model->jobStatus->name, array('disabled'=>'disabled'));?>
			<?php echo $form->error($model,'job_status_id'); ?>
		</td>
		
		<td>
			<?php echo $form->labelEx($model,'active'); ?>
			<?php //echo $form->textField($model,'active'); ?>
			<?php echo ($model->active == 0)?"No":"Yes";?>
			<?php echo $form->error($model,'active'); ?>
		</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->labelEx($model,'customer_notification_code'); ?>
				<?php 
					$customer_email_checked = NotificationRules::model()->getEmailCheckBoxStatus($model->customer_notification_code);
					$customer_sms_checked = NotificationRules::model()->getSMSCheckBoxStatus($model->customer_notification_code);
				?>
				
				<small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('customer_email_notification', $customer_email_checked, array('uncheckValue' => 0, 'disabled'=>'disabled'));?> 
				&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('customer_sms_notification', $customer_sms_checked, array('uncheckValue' => 0, 'disabled'=>'disabled'));?> 
				
				<?php echo $form->error($model,'customer_notification_code'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'engineer_notification_code'); ?>
				<?php 
					$engineer_email_checked = NotificationRules::model()->getEmailCheckBoxStatus($model->engineer_notification_code);
					$engineer_sms_checked = NotificationRules::model()->getSMSCheckBoxStatus($model->engineer_notification_code);
				?>
						
				<small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('engineer_email_notification', $engineer_email_checked, array('uncheckValue' => 0, 'disabled'=>'disabled'));?> 
				&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('engineer_email_notification', $engineer_sms_checked, array('uncheckValue' => 0, 'disabled'=>'disabled'));?> 
				
				<?php echo $form->error($model,'engineer_notification_code'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'warranty_provider_notification_code'); ?>
				
				<?php 
					$warranty_provider_email_checked = NotificationRules::model()->getEmailCheckBoxStatus($model->warranty_provider_notification_code);
					$warranty_provider_sms_checked = NotificationRules::model()->getSMSCheckBoxStatus($model->warranty_provider_notification_code);
				?>
								
				<small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('warranty_provider_email_notification', $warranty_provider_email_checked, array('uncheckValue' => 0, 'disabled'=>'disabled'));?> 
				&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('warranty_provider_email_notification', $warranty_provider_sms_checked, array('uncheckValue' => 0, 'disabled'=>'disabled'));?> 
						
				<?php echo $form->error($model,'warranty_provider_notification_code'); ?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<?php 
		
				$contactModel = NotificationContact::model()->findAllByAttributes(array(
						'notification_rule_id'=>$model->id
				));
				
				
				?>
				<?php echo $form->labelEx($model,'notify_others'); ?>
				
				<?php 
				if($model->notify_others == 0)
				{
					echo "NONE";
				}
				else 
				{
					//echo "NOTIFY";
					?>
					<table>
						<tr>
							<th style="color:maroon">Person Name</th>
							<th style="color:maroon">Person Info</th>
							<th style="color:maroon">Email</th>
							<th style="color:maroon">Mobile</th>
							<th style="color:maroon">Notify By</th>
						</tr>
						<?php 
						foreach ($contactModel as $data)
						{
							?>
								 	
							<tr>
								<td><?php echo $data->person_name;?></td>
								<td><?php echo $data->person_info;?></td>
								<td><?php echo $data->email;?></td>
								<td><?php echo $data->mobile;?></td>
								<td><?php 
									switch ($data->notification_code_id)
									{
										case 0:echo "None";
										break;

										case 1:echo "Email";
										break;
													
										case 2:echo "SMS";
										break;
													
										case 3:echo "Email and SMS";
										break;
									}//end of switch.
									?>
								</td>
							</tr>
							<?php }//end of foreach().?>
						</table>
						<?php 
				}//end of else.
				?>
				
				<?php echo $form->error($model,'notify_others'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->labelEx($model,'created'); ?>
				<?php echo CHtml::textField('', date('d-M-Y', $model->created), array('disabled'=>'disabled')); ?>
				<?php echo $form->error($model,'created'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'modified'); ?>
				<?php echo CHtml::textField('', date('d-M-Y', $model->modified), array('disabled'=>'disabled')); ?>
				<?php echo $form->error($model,'modified'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'delete'); ?>
				<?php
					if($model->delete != '')
					{
						$deleted_date = date('d-M-Y', $model->delete);
						echo CHtml::textField('', $deleted_date, array('disabled'=>'disabled'));
					} 
					else 
						echo CHtml::textField('', '', array('disabled'=>'disabled'));
				?>
				<?php echo $form->error($model,'delete'); ?>
			</td>
		</tr>
	</table>
	

<?php $this->endWidget(); ?>

</div><!-- form -->