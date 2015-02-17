<?php
/* @var $this GomobileaccountController */
/* @var $data GomobileAccount */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gomobile_account_name')); ?>:</b>
	<?php echo CHtml::encode($data->gomobile_account_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_name')); ?>:</b>
	<?php echo CHtml::encode($data->company_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact_email')); ?>:</b>
	<?php echo CHtml::encode($data->contact_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_of_rapport_users')); ?>:</b>
	<?php echo CHtml::encode($data->no_of_rapport_users); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('no_of_engineers')); ?>:</b>
	<?php echo CHtml::encode($data->no_of_engineers); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_on')); ?>:</b>
	<?php echo CHtml::encode($data->created_on); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('last_modified_on')); ?>:</b>
	<?php echo CHtml::encode($data->last_modified_on); ?>
	<br />

	*/ ?>

</div>