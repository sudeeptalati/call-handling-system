<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->country_id), array('view', 'id'=>$data->country_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iso2')); ?>:</b>
	<?php echo CHtml::encode($data->iso2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('short_name')); ?>:</b>
	<?php echo CHtml::encode($data->short_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('long_name')); ?>:</b>
	<?php echo CHtml::encode($data->long_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('iso3')); ?>:</b>
	<?php echo CHtml::encode($data->iso3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numcode')); ?>:</b>
	<?php echo CHtml::encode($data->numcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('un_member')); ?>:</b>
	<?php echo CHtml::encode($data->un_member); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('calling_code')); ?>:</b>
	<?php echo CHtml::encode($data->calling_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cctld')); ?>:</b>
	<?php echo CHtml::encode($data->cctld); ?>
	<br />

	*/ ?>

</div>