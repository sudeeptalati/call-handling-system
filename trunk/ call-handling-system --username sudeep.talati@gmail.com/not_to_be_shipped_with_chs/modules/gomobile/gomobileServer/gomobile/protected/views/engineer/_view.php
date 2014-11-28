<?php
/* @var $this EngineerController */
/* @var $data Engineer */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('engineer_email')); ?>:</b>
	<?php echo CHtml::encode($data->engineer_email); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('pwd')); ?>:</b>
	<?php echo CHtml::encode($data->pwd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exp_date')); ?>:</b>
	<?php echo CHtml::encode($data->exp_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode(date("d-M-Y",$data->created)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_modified')); ?>:</b>
	<?php echo CHtml::encode($data->last_modified); ?>
	<br />


</div>