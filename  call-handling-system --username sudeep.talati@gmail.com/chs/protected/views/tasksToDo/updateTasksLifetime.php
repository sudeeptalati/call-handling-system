
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<h1>Tasks Lifetime value</h1>

<div id="submenu">   
<li><?php echo CHtml::link('Tasks admin',array('/tasksToDo/admin')); ?></li>
</div>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tasks-to-do-updateTasksLifetime-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	<?php
	
		$lifetime_val = '';
		$advancedModel = AdvanceSettings::model()->findAllByAttributes(array('parameter'=>'notification_lifetime'));
		foreach($advancedModel as $lifetime)
		{
			$lifetime_val = $lifetime->value;
			//echo "<br>Lifetime val = ".$lifetime_val;
		}//end of advanced foreach.
	
	?>

	<div class="row">
		<?php echo "Tasks Lifetime"; ?><br>
		<?php echo CHtml::textField('lifetime_update_value', $lifetime_val, array('id'=>'lifetime_update_value')); ?>
		<?php //echo CHtml::CheckBox('delivery_checkbox', $delivery_checkbox_status, array ('value'=>'', 'id'=>'delivery-checkbox-id')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::button('Submit', array('submit' => array('tasksToDo/tasksLifetime'))); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->