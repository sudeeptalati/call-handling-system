<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'job-status-form',
	'enableAjaxValidation'=>false,
)); ?>

	<script type="text/javascript">
	function color_change()
	{
		color_name=document.getElementById('color_chooser').value;
		console.log('Color name selected = '+color_name);
		document.getElementById('current_layout').style.background ="#"+color_name;
		document.getElementById('JobStatus_html_name').value='#'+color_name;
	}
	</script>
	
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php
			 	if  ($model->id>50 && $model->id<100 )///id greater than 100 are custom statuses
			 	{
			 		echo $form->textField($model,'name',array('size'=>50));
			 	}
				else
				{
					echo $form->textField($model,'name',array('size'=>50, 'disabled'=>'disabled' ));
					echo "<br><small>This is  system set status, therefore above name cannot be edited</small><br><br>";	
				}
					
				?>
				
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'information'); ?>
		<?php echo $form->textArea($model,'information',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'information'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'published'); ?>
		<?php echo $form->dropDownList($model,'published',array('1'=>'Yes', '0'=>'No',));?>
		<?php echo $form->error($model,'published'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'dashboard_display'); ?>
		<?php echo $form->dropDownList($model,'dashboard_display',array('1'=>'Yes', '0'=>'No',));?>
		<?php echo $form->error($model,'dashboard_display'); ?>
	</div>

	
	<div class="row" >
		<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jscolor/jscolor.js', CClientScript::POS_HEAD); ?>
 
		<?php echo $form->labelEx($model,'html_name'); ?>
		<?php //echo $form->textField($model,'html_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->hiddenField($model,'html_name',array('rows'=>6, 'cols'=>50)); ?>
		
		
		<input rows="6" cols="50" name="color_chooser" id="color_chooser" type="text"  class="color {onImmediateChange:'color_change(this);', pickerPosition:'left'}" onChange="js:color_change()" value="<?php echo $model->html_name; ?>">
		
		 
		
		<?php //echo CHtml::textField($model,'html_name');?>
		<?php 
//		echo CHtml::activeTextField($model,'html_name',array('ajax' =>
//															array('background-color':'#ffccff')
//															));?>
		<?php echo $form->error($model,'html_name'); ?>
		 
		<br>
		
		<br>
		
		 
		
		<table style="width:50%">
			<tr>
				<td >
				
				<div id="current_layout" class="color" style="border-radius:15px;  padding:10px; background-color:<?php echo $model->html_name;?>">
				Current Layout<br>
				&nbsp;	&nbsp;	&nbsp;	&nbsp;<b><?php echo $model->name ;?></b>
				</div>
				</td>
			</tr>
		</table>


	</div>
 		
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
 

	
</div><!-- form -->


  