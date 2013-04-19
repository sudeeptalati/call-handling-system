
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>


<table><tr>
	<td> <?php echo CHtml::link('View',array('/setup/postcodeAnywhereView')); ?></td>
	<td> <?php echo CHtml::link('Update',array('/setup/postcodeAnywhereSetup')); ?></td>
	<td> <?php echo CHtml::link('Manage',array('/setup/admin')); ?></td>
</tr></table>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setup-postcodeAnywhereView-form',
	'enableAjaxValidation'=>false,
)); ?>

	<h1>Postcode Anywhere Account</h1>

	<?php echo $form->errorSummary($model); ?>

	
	<div class="row">
		<?php echo $form->labelEx($model,'postcodeanywhere_account_code'); ?>
		<?php echo $form->textField($model,'postcodeanywhere_account_code', array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'postcodeanywhere_account_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'postcodeanywhere_license_key'); ?>
		<?php echo $form->textField($model,'postcodeanywhere_license_key', array('disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'postcodeanywhere_license_key'); ?>
	</div>

<!-- 	<div class="row buttons"> -->
		<?php //echo CHtml::submitButton('Submit'); ?>
<!-- 	</div> -->

<?php $this->endWidget(); ?>

</div><!-- form -->