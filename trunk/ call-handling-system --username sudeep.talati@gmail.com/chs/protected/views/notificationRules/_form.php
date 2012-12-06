<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notification-rules-form',
	'enableAjaxValidation'=>false,
)); ?>

<script type="text/javascript">

/**** CODE TO DISPLAY EMAIL AND SMS ON CHECK OF CHECKBOX, FOR ALL CHECKBOXES ******/

$(function() {//code inside this function will run when the document is ready
    if($('#customer-checkbox-id').is(':checked'))
    {
        $('.customer-form').show();
    }
    if($('#engineer-checkbox-id').is(':checked'))
    {
        $('.engineer-form').show();
    }
    if($('#warranty-provider-checkbox-id').is(':checked'))
    {
        $('.warranty-provider-form').show();
    }

});

/**** CODE TO DISPLAY EMAIL AND SMS ON CHECK OF CHECKBOX, FOR ALL CHECKBOXES ******/


/**** CODE TO DISPLAY DIALOGUE BOX WITH CREATE FORM OF CONTACT DETAILS ********/

function addContact()
{
	//alert('IN ADD CONTACT FUNC');
	
	<?php 
	echo CHtml::ajax(array(
    'url'=>array('notificationContact/create', 'id'=>$model->id),
    'data'=> "js:$(this).serialize()",
    'type'=>'post',
    'dataType'=>'json',
    'success'=>"function(data)
    {
    	if (data.status == 'failure')
        {
        	$('#formdialog div.divForForm').html(data.div);
            // Here is the trick: on submit-> once again this function!
            $('#dialogClassroom div.divForForm form').submit(addContact);
        }
        else
        {
        	$('#formdialog div.divForForm').html(data.div);
            setTimeout(\"$('#formdialog').dialog('close') \",3000);
        }

    } ",
    ))
    ?>;
    //return false;
}//end of function addContact().



</script>

<?php 
if($model->notify_others == 1)
{
?>


<?php 
			
	/***** CODE TO GET DIALOGUE BOX OF FORM TO ENTER PERSON DETAILS ****/
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    	'id'=>'formdialog',
    	// additional javascript options for the dialog plugin
    	'options'=>array(
        'title'=>'Person Details',
		//'title'=>Yii::t('notificationContact','Create Job'),
        'autoOpen'=>false,
		'modal'=>'true',
		'show' => 'blind',
	    'hide' => 'explode',
	),
	));
?>
			
<div class="divForForm"></div>
			
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>


<!-- ****** END OF CODE TO DISPLAY DIALOGUE BOX WITH CREATE FORM OF CONTACT DETAILS ***** -->



<script type="text/javascript">
$(function()
{//code inside this function will run when the document is ready
   $('.others-form').show();

   function addContact()
   {
   	//alert('IN ADD CONTACT FUNC');
   	
   	<?php 
   	echo CHtml::ajax(array(
       'url'=>array('notificationContact/create', 'id'=>$model->id),
       'data'=> "js:$(this).serialize()",
       'type'=>'post',
       'dataType'=>'json',
       'success'=>"function(data)
       {
       	if (data.status == 'failure')
           {
           	$('#formdialog div.divForForm').html(data.div);
               // Here is the trick: on submit-> once again this function!
               $('#dialogClassroom div.divForForm form').submit(addContact);
           }
           else
           {
           	$('#formdialog div.divForForm').html(data.div);
               setTimeout(\"$('#formdialog').dialog('close') \",3000);
           }

       } ",
       ))
       ?>;
       //return false;
   }//end of function addContact().


});
</script>
<?php }//end of of($model->notify_others == 1).?>


<?php 
$jobstatuslist = JobStatus::model()->getAllStatuses();//listdata for dropdown
?>


<table style="width:75%;">
<tr>
	<td colspan='4'>
		When job status is changed to <?php echo $form->dropDownList($model, 'job_status_id', $jobstatuslist ,
													 array('empty'=>'Please Select job status (required)'));?>

		<br><big><b>Notify</b></big>
	</td>
	
</tr>

<tr>
	<td>
	
		<?php 
			//EVENT LISTENER FOR CUSTOMER FIELD.
			Yii::app()->clientScript->registerScript('my-customer-listener',"
			$('#customer-checkbox-id').click(function() {
			    $('.customer-form')[this.checked ? 'show' : 'hide']();
			});
			");
			
		?>
		
		Customer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php 
				$customer_checked;
				
				$customer_email_checked=NotificationRules::model()->getEmailCheckBoxStatus($model->customer_notification_code);
				$customer_sms_checked=NotificationRules::model()->getSMSCheckBoxStatus($model->customer_notification_code);
				
				if ($customer_email_checked || $customer_sms_checked)
					$customer_checked=true;
				else 
					$customer_checked=false;
			?>
		
		<?php echo $form->checkbox($model, 'customer_notification_code', array('checked'=>$customer_checked,'id'=>'customer-checkbox-id')); ?>		
		
		<div class="customer-form" style="display:none">
		<small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('customer_email_notification', $customer_email_checked, array('uncheckValue' => 0)); ?>
		&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('customer_sms_notification', $customer_sms_checked, array('uncheckValue' => 0)); ?>
		</div>
	 
	</td>
	<td>
		<?php 
			//EVENT LISTENER FOR ENGINEER FIELD.
			Yii::app()->clientScript->registerScript('my-engineer-listener',"
			$('#engineer-checkbox-id').click(function() {
			    $('.engineer-form')[this.checked ? 'show' : 'hide']();
			});
			");
		?>
		
		Engineer&nbsp;&nbsp;
		<?php 
			$engineer_checked;
				
			$engineer_email_checked=NotificationRules::model()->getEmailCheckBoxStatus($model->engineer_notification_code);
			$engineer_sms_checked=NotificationRules::model()->getSMSCheckBoxStatus($model->engineer_notification_code);
				
			if ($engineer_email_checked || $engineer_sms_checked)
				$engineer_checked=true;
			else 
				$engineer_checked=false;
		?>
		<?php echo $form->checkbox($model, 'engineer_notification_code', array('checked'=>$engineer_checked,'id'=>'engineer-checkbox-id')); ?>
		
		<div class="engineer-form" style="display:none">
		<small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('engineer_email_notification', $engineer_email_checked, array('uncheckValue' => 0)); ?>
		&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('engineer_sms_notification', $engineer_sms_checked, array('uncheckValue' => 0)); ?>
		</div>
	
	
	
	</td>
	<td>
		
		<?php 
			//EVENT LISTENER FOR WARRANTY PROVIDER FIELD.
			Yii::app()->clientScript->registerScript('my-warranty-provider-listener',"
			$('#warranty-provider-checkbox-id').click(function() {
			    $('.warranty-provider-form')[this.checked ? 'show' : 'hide']();
			});
			");
		?>
		
		Warranty Provider&nbsp;&nbsp;
		<?php 
			$warranty_provider_checked;
				
			$warranty_provider_email_checked=NotificationRules::model()->getEmailCheckBoxStatus($model->warranty_provider_notification_code);
			$warranty_provider_sms_checked=NotificationRules::model()->getSMSCheckBoxStatus($model->warranty_provider_notification_code);
				
			if ($warranty_provider_email_checked || $warranty_provider_sms_checked)
				$warranty_provider_checked=true;
			else 
				$warranty_provider_checked=false;
		?>
		<?php echo $form->checkbox($model, 'warranty_provider_notification_code', array('checked'=>$warranty_provider_checked,'id'=>'warranty-provider-checkbox-id')); ?>
		<div class="warranty-provider-form" style="display:none">
		<small><b>Email</b></small>&nbsp;<?php echo CHtml::checkBox('warranty_provider_email_notification', $warranty_provider_email_checked, array('uncheckValue' => 0)); ?>
		&nbsp;&nbsp;<small><b>SMS</b></small>&nbsp;<?php echo CHtml::checkBox('warranty_provider_sms_notification', $warranty_provider_sms_checked, array('uncheckValue' => 0)); ?>
		</div>
	
	</td>
</tr>
<tr>
	<td colspan="3">
	
		<big><b>Also Notify</b></big>&nbsp;&nbsp;
		<?php
			if($model->notify_others == 0)
			{
				echo CHtml::submitButton ('Give Details', array('name'=>'others_person_details'));
				
				//echo CHtml::submitButton ('Give Details', array('onclick'=>"{addContact(); $('#formdialog').dialog('open');}"));
				
//				echo CHtml::link('Add', "",
//	    		array(
//	        		'style'=>'cursor: pointer; text-decoration: underline;',
//	        		'onclick'=>"{addContact(); $('#formdialog').dialog('open');}"
//	    		));
			}
			
			
			
			
		 ?>
        
        
		<div class="others-form" style="display:none">
		
		<!-- *** FORM OF OTHERS CHECKBOX, TO DISPLAY FORM AND DIALOGUE BOX TO ENTER DETAILS *** -->
		
		<?php 
			
			$baseUrl=Yii::app()->request->baseUrl;
			//$changeEnggUrl=$baseUrl.'/enggdiary/changeEngineerOnly/';
			$othersDetailsUrl=$baseUrl.'/notificationContact/addNotificationContact/';		
			$othersPersonDetailsForm=$this->beginWidget('CActiveForm', array(
			'id'=>'others-contactDetails-form',
			'enableAjaxValidation'=>false,
			'action'=>$othersDetailsUrl,
			'method'=>'post'
			
		)); ?>
		
		<?php 
		$contactModel = NotificationContact::model()->findAllByAttributes(array(
														'notification_rule_id'=>$model->id
													));
													
		//echo "<hr>count of result = ".count($contactModel)."<hr>";
		/*********** CODE TO DISPLAY FORM TO ENTER OTHER PERSONS DETAILS **********/
		if(count($contactModel) == '0')
		{
//			$notificationContactModel = NotificationContact::model();
//			$notificationContactModel->notification_rule_id = $model->id;
//			
//			echo $form->labelEx($notificationContactModel,'person_name'); 
//			echo $form->textField($notificationContactModel,'person_name',array('size'=>30));
//			echo $form->labelEx($notificationContactModel,'person_info'); 
//			echo $form->textField($notificationContactModel,'person_info',array('size'=>30));
//			echo $form->labelEx($notificationContactModel,'email'); 
//			echo $form->textField($notificationContactModel,'email',array('size'=>30));
//			echo $form->labelEx($notificationContactModel,'mobile'); 
//			echo $form->textField($notificationContactModel,'mobile',array('size'=>30));
//			//echo CHtml::activeTextField($notificationContactModel,'mobile');
//			echo $form->hiddenField($notificationContactModel,'notification_rule_id');
//			echo "<br>Email&nbsp;&nbsp;";
//			echo CHtml::checkBox('others_email_notification', false, array('uncheckValue' => 0));
//			echo "&nbsp;&nbsp;&nbsp;SMS&nbsp;&nbsp;"; 
//			echo CHtml::checkBox('others_sms_notification', false, array('uncheckValue' => 0));
//			echo "<br>";
//			echo CHtml::button('Save Details', array('submit' => array('notificationContact/addNotificationContact')));

			
			//the link for open the dialog
			echo CHtml::link('Give Details', "",
    		array(
        		'style'=>'cursor: pointer; text-decoration: underline;',
        		'onclick'=>"{addContact(); $('#formdialog').dialog('open');}"
    		));
    		
			
		}//end of if(data not present).
		/*********** END OF CODE TO DISPLAY FORM TO ENTER OTHER PERSONS DETAILS **********/
		
		/********* CODE TO DISPLAY PERSON DETAILS FROM DATABASE *************/
		else
		{
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
				<!-- START OF SECOND COLUMN -->
				<td>
				<?php echo CHtml::link('Delete', array('/notificationContact/delete','id'=>$data->id));?>
				</td>
				<!-- END OF SECOND COLUMN -->
				</tr>
				
				
				<?php 
			}//end of foreach().
			?>
			</table>
			<hr>
			
			

			<?php
			//the link for open the dialog
			echo CHtml::link('Add More', "",
    		array(
        		'style'=>'cursor: pointer; text-decoration: underline;',
        		'onclick'=>"{addContact(); $('#formdialog').dialog('open');}"
    		));
    		?>
			
    					
			<?php

			/***** END OF CODE TO GET DIALOGUE BOX OF FORM TO ENTER PERSON DETAILS ****/
	
		}//end of else(Printing data from db).
		
		/********* END OF CODE TO DISPLAY PERSON DETAILS FROM DATABASE *************/
		
		?>
		<?php $this->endWidget(); ?>
		
		<!-- *** END OF FORM OF OTHERS CHECKBOX, TO DISPLAY FORM AND DIALOGUE BOX TO ENTER DETAILS *** -->
		
		</div>
		
	</td>
</tr>
 
</table>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Set up new rule' : 'Save'); ?>
	</div>
	

<?php $this->endWidget(); ?>

</div><!-- form -->