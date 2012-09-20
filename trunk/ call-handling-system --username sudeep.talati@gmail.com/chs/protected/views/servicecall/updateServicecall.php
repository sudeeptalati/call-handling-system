<?php 
   $mtime = microtime(); 
   $mtime = explode(" ",$mtime); 
   $mtime = $mtime[1] + $mtime[0]; 
   $starttime = $mtime; 
;?> 

<style type="text/css">
td
{

vertical-align:top;
}
</style>

	<div class="form">

	
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'servicecall-updateServicecall-form',
		'enableAjaxValidation'=>false,
		//'focus'=>array($model,'spares_used_status_id'),
	)); ?>
	
	    <script>
	    	$(document).ready(function(){
	    		  var droplist = $('#spares-dropdown-id');
	    		  if(droplist.val()== '1')
	    			  $('#freesearch-Form').show();
	    		  
	    		  droplist.change(function(e){
	    		    if (droplist.val() == '1') {
	    		      $('#freesearch-Form').show();
	    		    }
	    		    else {
	    		      $('#freesearch-Form').hide();
	    		    }
	    		  })
	    		});
	    </script>
	
		<script type="text/javascript">
		function my_change(id)
		{
			if(id > 100)
			{
		        alert("This status will close the call and it won't be editable afterwards.");
			}
		}

		</script>
		
	
		<p class="note">Fields with <span class="required">*</span> are required.</p>
	
		<?php echo $form->errorSummary($model); ?>
		
		<?php 
			$service_id=$_GET['id'];
			//echo "STR TO TIME :".strtotime($model->job_payment_date)."<br>";
			//echo "CONVERTED DATE FROM STR TO TIME :".date('d-M-y', strtotime($model->job_payment_date));
			//echo "SERVICE ID FROM URL :".$service_id;
			//echo "ID FROM MODEL :".$model->id;
			$customerModel=Customer::model()->findByPk($model->customer_id);
			$productModel=Product::model()->findByPk($model->product_id);
			$brandModel=Brand::model()->findByPk($productModel->brand_id);
			$productTypeModel=ProductType::model()->findByPk($productModel->product_type_id);
			$contractModel=Contract::model()->findByPk($model->contract_id);
			$contractName=$contractModel->name;
			$contractTypeModel=ContractType::model()->findByPk($contractModel->contract_type_id);
			$engineerModel=Engineer::model()->findByPk($model->engineer_id);
			$engineerName=$engineerModel->fullname;
			$enggDiaryModel=Enggdiary::model()->findByPk($model->engg_diary_id);
			
			//address of customer.
			$str1=$customerModel->address_line_1." ".$customerModel->address_line_2." ".$customerModel->address_line_3."\n";
			$str2=$customerModel->town."\n";
			$str3=$customerModel->postcode_s;
			$address=$str1." ".$str2." ".$str3;
			
			//CALCULATING VALID UNTILL.
		
			$php_warranty_date=$productModel->warranty_date;
			$php_waranty_months=$productModel->warranty_for_months;
			
			$res='';
			if (!empty($php_warranty_date))
			{
			$warranty_until= strtotime(date("Y-M-d", $php_warranty_date) . " +".$php_waranty_months." month");
			$res=date('d-M-Y', $warranty_until);
			//echo $res;							
			}							
			//echo $res;							
			
		?>
		
		<!-- ************ CUSTOMER DEATILS******** -->
		
		<div class="row">
		<table>
		<tr><td colspan='2' style="text-align:center"><h1>Service Call Details</h1></td>
		</tr>
		
		<tr>
			
				
			<td style="vertical-align:top;"><b>Job Status : </b>
			<span style="color:maroon"><?php echo $model->jobStatus->name;?></span>

			<br>
				
				
				<?php 
					if($model->job_status_id<100)
					{
						$result=$model->updateStatus();
						$list=CHtml::listData($result, 'id','name');
						echo $form->dropDownList($model, 'job_status_id', $list, array('onchange'=>'js:my_change(this.value)')
//												array(
//													'ajax' => array(
//													'type'=>'POST', //request type
//													'url'=>CController::createUrl('setup/testConnection'), //url to call.
//												))
						
						);
						echo $form->error($model,'job_status_id'); 
					}//end of if().
					
				?>
			</td>
			<td>
			
			<b>Service Ref. No.#</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo CHtml::submitButton('Modify'); ?>
			<h2 style="color:green;"><?php echo $model->service_reference_number;?></h2>
			
			</td>
			
			
			
		</tr>
		
		<tr><td colspan="2" style="text-align:center">
			 
			</td>
		</tr>
		
		<tr><td>
		<?php echo $form->labelEx($model,'fault_date');?>
		<?php 	
				//echo $model->fault_date;
				
 				if ($model->fault_date!='')
 				{
	 				$fault_date=date('d-M-Y',$model->fault_date);
	 				//$fault_date = $model->fault_date;
				}	
				else 
				{
					$fault_date='';	
				}
				
				
				$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				    'name'=>CHtml::activeName($model, 'fault_date'),
					'model'=>$model,
	        		'value' => $fault_date,
 
				    'options'=>array(
				        'showAnim'=>'fold',
						'dateFormat' => 'd-M-y',
				    ),
				    'htmlOptions'=>array(
				        'style'=>'height:20px;'
				    ),
				));
				
				
					
			?>
			<?php //echo $form->textField($model,'fault_date'); ?>
			<?php echo $form->error($model,'fault_date'); ?>
			
			<?php echo $form->labelEx($model,'fault_code'); ?>
			<?php echo $form->textField($model,'fault_code'); ?>
			<?php echo $form->error($model,'fault_code'); ?>
			
			<?php echo $form->labelEx($model,'fault_description'); ?>
			<?php echo $form->textArea($model,'fault_description',array('rows'=>4, 'cols'=>40)); ?>
			<?php echo $form->error($model,'fault_description'); ?>
		</td>
		<td>

				<?php
				 	$viewVisitStartDate='';
				 	if(!empty($enggDiaryModel->visit_start_date))
					{
						//$enggDiaryModel->visit_start_date= date('d-M-y', $enggDiaryModel->visit_start_date);
						$viewVisitStartDate=date('d-M-Y', $enggDiaryModel->visit_start_date);
					}
				?>

			<?php echo "<b>Current Appointment</b><br>";?>
			<?php //echo $form->textField($enggDiaryModel,'visit_start_date', array('disabled'=>'disabled')); ?>
			<?php echo CHtml::textField('',$viewVisitStartDate,array('disabled'=>'disabled')); ?>
			<?php //echo $form->error($enggDiaryModel,'visit_start_date'); ?>
			
			<!-- ******* code for image link to change appointment ******* -->
			<?php 
				$imgurl = Yii::app()->request->baseUrl.'/images/engineer_diary.gif';
				$imghtml = CHtml::image($imgurl,'Engineer Appointment',array('width'=>25, 'height'=>25, 'title'=>'Engineer Appointment' )); 
				//echo CHtml::link($imghtml, array('Enggdiary/iCalLink','id'=>$model->id));
			?>
			<!-- ****************** end of code. ******************** -->
			
			<?php echo $form->labelEx($model,'engineer_id'); ?>
			<?php echo $form->textField($engineerModel, 'fullname', array('disabled'=>'disabled'));?>
			<?php echo $form->error($model,'engineer_id'); ?>
			<?php if(empty($model->engg_diary_id))
				  {
				  	echo CHtml::link($imghtml, array('enggdiary/create/', 'id'=>$model->id, 'engineer_id'=>$model->engineer_id));
					echo CHtml::link('Create Appointment', array('enggdiary/bookingAppointment/', 'id'=>$model->id, 'engineer_id'=>$model->engineer_id));
					
				  }
				  else 
				  {
				  	echo CHtml::link($imghtml, array('enggdiary/changeAppointment/', 'service_id'=>$model->id, 'engineer_id'=>$model->engineer_id, 'enggdiary_id'=>$model->engg_diary_id));
				  	//echo CHtml::link('Change Engineer or Appointment', array('enggdiary/changeAppointment/', 'serviceId'=>$model->id, 'engineerId'=>$model->engineer_id, 'enggdiary_id'=>$model->engg_diary_id));				  	
				  	echo CHtml::link('Change Appointment', array('enggdiary/viewFullDiary/', 'engg_id'=>$model->engineer_id));
				  	//echo CHtml::link('Change Appointment', array('enggdiary/bookingAppointment/', 'id'=>$model->id, 'engineer_id'=>$model->engineer_id));
				  	echo "<br>";
					echo CHtml::link('Book Appointment for another visit', array('enggdiary/bookingAppointment/', 'id'=>$model->id, 'engineer_id'=>$model->engineer_id));
					echo "<br>";
					echo CHtml::link('Change Engineer', array('servicecall/changeEngineerOnly/', 'service_id'=>$model->id));
					
				  }
			?>
			
				
			<?php //echo CHtml::link('Change the Engineer or Appointment', array('enggdiary/changeAppointment/', 'serviceId'=>$model->id, 'engineerId'=>$model->engineer_id, 'enggdiary_id'=>$model->engg_diary_id)); ?>
			
			<?php echo $form->labelEx($model,'insurer_reference_number'); ?>
			<?php echo $form->textField($model,'insurer_reference_number'); ?>
			<?php echo $form->error($model,'insurer_reference_number'); ?>
			
			<?php $model->contract_id=$productModel->contract->id; ?>
			<?php echo $form->labelEx($model,'contract_id'); ?>
			<?php echo CHtml::activeDropDownList($model,'contract_id', $model->getAllContract()); ?>
			<?php echo $form->error($model,'contract_id'); ?>
			
			
		</td>
		</tr>
	
		
		<tr><td colspan="2" style="text-align:center">
			<h2>Further Details</h2>
			</td>
		</tr>
		<tr>
		
			<td>
			
			
			
				<?php echo $form->labelEx($model,'spares_used_status_id'); ?>
				<?php //$model->spares_used_status_id='';?>
				<?php 
					echo $form->dropDownList($model, 'spares_used_status_id', array('0'=>'No','1'=>'Yes'), 
																		array('id'=> 'spares-dropdown-id')																			
				);
				?>
				<?php echo $form->error($model,'spares_used_status_id'); ?><br>
				
				<!-- ****** CODE TO DISPLAY SPARES ALREADY USED *********** -->
				<?php 
					if($model->spares_used_status_id == 1)
					{
						echo "Spares used :<br>";
						$sparesModel = SparesUsed::model()->findAllByAttributes(array('servicecall_id'=> $model->id));
						?>
						<table>
						<tr>
						<th style="color:maroon">Part Number</th>
						<th style="color:maroon">Item Name</th>
						<th style="color:maroon">Qty</th>
						</tr>
						<?php 
						foreach ($sparesModel as $data)
						{
							?>
							<tr>
							<td width="35%"><?php echo $data->part_number;?></td>
							<td width="35%"><?php echo $data->item_name;?></td>
							<td><?php echo $data->quantity."<br>";?></td>
							</tr>
							<?php 
						}//end of foreach.
						?>
						</table>
						<?php 
					}//end of if spares_used_status_id == 1.
					
				?>
				
				<!-- ****** END OF CODE TO DISPLAY SPARES ALREADY USED ******* -->
				
				
				<!-- ***** CODE TO GET THE FREES SEARCH OF MASTER DATABASE **** -->
			
				<?php //echo  CHtml::link('Select Item', array('sparesUsed/masterFreeSearch/?service_id='.$model->id));?>
				
				
				<br><div id="freesearch-Form" style="display:none"><!-- ITEM SEARCH DIV -->
				<?php 
				  $service_id = $model->id;  
				 
				  $baseUrl = Yii::app()->baseUrl; 
				  $cs = Yii::app()->getClientScript();
				  $cs->registerScriptFile($baseUrl.'/js/jquery.js');
				  //include ('jquery.js'); 
			    ?>
				
				  <div class="admin">
				  
				  <script type="text/javascript">
				 
				 
				$(document).ready(function() {

				$("#faq_search_input").keyup(function()

				{
				var faq_search_input = $(this).val();
				var dataString = 'keyword='+ faq_search_input;

				//var ref_id = $('#ref_id').val();
				//var cust_id = $('#cust_id').val(); 
				//var search_url = $('#search_url').val();
				var service_id = $('#service_id').val();
				var local_db_url = $('#local_db_url').val();
				//var current_url = $('#current_url').val();
				 
				if(faq_search_input.length>3)
				{
				$.ajax({
				type: "GET",
				//url: current_url+"/MasterSearchData/?service_id="+service_id,
				//url: current_url+"/getItems",
				//url: search_url,
				url: local_db_url,
				
				//data: dataString,
				data: dataString+"&service_id="+service_id,
				//data: dataString+"&refid="+ref_id+"&custid="+cust_id,
				//data: dataString,
				beforeSend:  function() {
				
				$('input#faq_search_input').addClass('loading');
				
				},
				success: function(server_response)
				{
				$('#searchresultdata').html(server_response).show();
				$('span#faq_category_title').html(faq_search_input);
				
				if ($('input#faq_search_input').hasClass("loading")) {
				 $("input#faq_search_input").removeClass("loading");
				        } 
				
				}
				});
				}return false;
				});
				});
					  
				</script>

				<?php
				
				$baseUrl = Yii::app()->baseUrl; 
				$model_name=Yii::app()->controller->id;
				$current_url=$baseUrl."/".$model_name;
				//$current_url=$baseUrl."/Servicecall";
				 
				$search_url=$current_url."/MasterSearchData?service_id=".$service_id."&";
				//echo "base url = ".$baseUrl."<br>";
				$checkUrl = '../'.$baseUrl;
				$fileUrl = '../../fitlist';
				//$temp_url = "/KRUTHIKA/fitlist/spares_diary/masterItems/SearchEngine?service_id=".$service_id."&";
				//$temp_url = 'http://192.168.1.200/itemsfreesearch/searchapi.php?';
				//$temp_url='../../../master_database/api/searchData.php?';
				$local_db_url='../../../local_items_database/api/searchData.php?';
				
				//$temp_url='http://spares.rapportsoftware.co.uk/itemsfreesearch/searchapi.php?';
				
				
				?>
				

					<input type="hidden" id="service_id" value="<?php echo $service_id;?>"/>
					<input type="hidden" id="local_db_url" value="<?php echo $local_db_url;?>"/>
					<!--<input type="hidden" id="search_url" value="<?php //echo $search_url;?>"/> -->
					<!--<input type="hidden" id="current_url" value="<?php //echo $current_url;?>"/>-->
					<!-- <input type="hidden" id="ref_id" value="<?php //echo $reference_id ;?>"/> --> 
					<!-- <input type="hidden" id="cust_id" value="<?php //echo $customer_id ;?>"/> -->  
					
							  Enter Item Name, Part Number or barcode<br>
				            <!-- The Searchbox Starts Here  -->
				              <form  name="search_form">
				              <input  name="query" type="text" id="faq_search_input" style="background-color: #F8D0C1" size='40' />
				              </form>
				            <!-- The Searchbox Ends  Here  -->
				       <div id="searchresultdata" class="faq-articles"> </div>
				     </div>
				
				
				</div><!-- END OF ITEM SEARCH DIV -->
				
<!-- ********* CODE TO DISPLAY SEARCH RESULTS FROM SERVER MASTER ITEMS ********** -->				
<?php 
//echo $master_id."<br>";
if (!empty($_GET['cloud_id']) || !empty($_GET['master_id']))
{
	echo "<hr>";
$master_id = $_GET['master_id'];
//echo "master id = ".$master_id;
$cloud_id = $_GET['cloud_id'];
//echo "cloud id = ".$cloud_id;



		if($cloud_id != 0)
		{
			$itemDetails="localhost/KRUTHIKA/fitlist/spares_diary/masterItems/SendJsonData?id=".$cloud_id;
			$server_msg = Servicecall::model()->curl_file_get_contents($itemDetails, true);
			//$array= explode("\n", $server_msg);
			//echo "Total No. of lines are ".count($array);
			//echo $server_msg."<hr>";
			$decodedata = json_decode($server_msg, true);
			//echo $decodedata['master_id']."<br>";
			//echo $decodedata['part_num']."<br>";
			$part_number = $decodedata['part_num'];
			//echo $decodedata['opn']."<br>";
			$opn = $decodedata['opn'];
			//echo $decodedata['part_name']."<br>";
			$name = $decodedata['part_name'];
			//echo "item name = ".$name."<br>";
		
		}// end of if getting cloud server data.
		else
		{
			echo "no data";
			$db = new PDO('sqlite:../local_items_database/api/master_database.db');
			
			$result = $db->query("SELECT * FROM master_items WHERE id = '$master_id'");
			$rows = $result->fetchAll(); // assuming $result == true
			$n = count($rows);
			//echo "no of rows = ".$n."<br>";
				
			foreach($rows as $d)
			{
				//echo $d['id']."<br>";
				//echo $d['name']."<br>";
				$name = $d['name'];
				//echo $d['part_number']."<br>";
				$part_number = $d['part_number'];
				$var = preg_replace("/[^A-Za-z0-9]/", "", $part_number);
				$trimmed = trim($var);
				$opn = strtoupper($trimmed);
			
			}
				
		}//end of if part_number empty.
		
?>


	<form action="<?php echo Yii::app()->createUrl("SparesUsed/saveData");?>" method="POST">
	<input type="hidden" name="master_id" value=<?php echo $master_id;?>>
	<input type="hidden" name="service_id" value=<?php echo $model->id;?>>
	<input type="hidden" value=<?php echo $opn;?>>
	<input type="hidden" name="part_number" value=<?php echo $part_number;?>>
	<input type="hidden" name="name" value="<?php echo $name;?>" >
	<b>Part Name</b> &nbsp;&nbsp;&nbsp; <?php echo $name;?> <br> <b>Part number</b> &nbsp;&nbsp;&nbsp; <?php echo $part_number;?> <br><br>
	Quantity <input type="text" name="quantity" size="3"> &nbsp;&nbsp;&nbsp;
	Price <input type="text" name="unit_price" size="3"><br>
	<input type="submit" style="width:100px">
	</form>

	<hr>
	
<?php }//end of items form?>
	
<!-- ********* END OF CODE TO DISPLAY SEARCH RESULTS FROM SERVER MASTER ITEMS ********** -->
				
				<BR><BR><BR>	
				

			
				<!-- ***** END OF CODE TO GET THE FREES SEARCH OF MASTER DATABASE ENDS **** -->
				
				<?php echo $form->labelEx($model,'work_carried_out'); ?>
				<?php echo $form->textArea($model,'work_carried_out', array('rows'=>4, 'cols'=>'30')); ?>
				<?php echo $form->error($model,'work_carried_out'); ?>
			
				<?php echo $form->labelEx($model,'job_payment_date'); ?>

				<?php 
				
				
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				    'name'=>CHtml::activeName($model, 'job_payment_date'),
					'model'=>$model,
	        		'value' => $model->attributes['job_payment_date'],
				    // additional javascript options for the date picker plugin
				    'options'=>array(
				        'showAnim'=>'fold',
						'dateFormat' => 'dd-mm-yy',
				    ),
				    'htmlOptions'=>array(
				        'style'=>'height:20px;'
				    ),
				));
				
				
				?>
				<?php //echo $form->textField($model,'job_payment_date'); ?>
				<?php echo $form->error($model,'job_payment_date'); ?>
				
				
				
				
				<?php echo $form->labelEx($model,'job_finished_date'); ?>
				<?php 
					if (!empty($model->job_finished_date))
					{
						$model->job_finished_date=date('j-M-y', $model->job_finished_date);
					}
					?>
				
				<?php 
					$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				    'name'=>CHtml::activeName($model, 'job_finished_date'),
					'model'=>$model,
	        		'value' => $model->attributes['job_finished_date'],
				    // additional javascript options for the date picker plugin
				    'options'=>array(
				        'showAnim'=>'fold',
						'dateFormat' =>'d-M-y' ,
				    ),
				    'htmlOptions'=>array(
				        'style'=>'height:20px;'
				    ),
				));
				?>
				<?php //echo $form->textField($model,'job_finished_date'); ?>
				<?php echo $form->error($model,'job_finished_date'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'total_cost'); ?>
				<?php echo $form->textField($model,'total_cost'); ?>
				<?php echo $form->error($model,'total_cost'); ?>
					
				<?php echo $form->labelEx($model,'vat_on_total'); ?>
				<?php echo $form->textField($model,'vat_on_total'); ?>
				<?php echo $form->error($model,'vat_on_total'); ?>
				
				<?php echo $form->labelEx($model,'net_cost'); ?>
				<?php echo $form->textField($model,'net_cost', array('disabled'=>'disabled')); ?>
				<?php echo $form->error($model,'net_cost'); ?>
				
				<?php echo $form->labelEx($model,'notes'); ?>
				<?php echo $form->textArea($model,'notes',array('rows'=>4, 'cols'=>30)); ?>
				<?php echo $form->error($model,'notes'); ?>
			</td>
			
		</tr>
			
		<tr>
			<td>
				<h2>Customer Details</h2>
			</td>
			<td>
				<h2>Product Details</h2>
			</td>
		</tr>
		
		<!-- *********** DISPLAYING CUSTOMER DETAILS ********* -->
		
		<tr>
			<td>
				<?php echo $form->labelEx($customerModel,'fullname'); ?>
				<?php echo $form->textField($customerModel,'fullname', array('disabled'=>'disabled')); ?>
				<?php echo $form->error($customerModel,'fullname'); ?>
				
				<?php echo "<br><b>Address</b><br>" ,
			  		 CHtml::textArea('Address', $address,  array('rows'=>4, 'cols'=>40,'disabled'=>'disabled')); ?>
			  	
			  	<?php echo $form->labelEx($customerModel,'telephone'); ?>
				<?php echo $form->textField($customerModel,'telephone',array('disabled'=>'disabled')),"<br>"; ?>
				<?php echo $form->textField($customerModel,'mobile',array('disabled'=>'disabled')); ?>
			
				<?php echo $form->labelEx($customerModel,'email'); ?>
				<?php echo $form->textField($customerModel,'email',array('disabled'=>'disabled')); ?>
				
				<?php echo $form->labelEx($customerModel,'notes'); ?>
				<?php echo $form->textArea($customerModel,'notes',array('disabled'=>'disabled', 'rows'=>4, 'cols'=>40)); ?>
			</td>
			
			<!-- *********** DISPLAYING PRODUCT DEATILS ********** -->
			<td>
			<table>
			<tr>
				<td>
					<?php echo $form->labelEx($brandModel,'name'); ?>
					<?php echo $form->textField($brandModel,'name', array('disabled'=>'disabled')); ?>
					
					<?php echo $form->labelEx($productTypeModel,'name'); ?>
					<?php echo $form->textField($productTypeModel,'name', array('disabled'=>'disabled')); ?>
					
					<?php echo $form->labelEx($productModel,'model_number'); ?>
					<?php echo $form->textField($productModel,'model_number',array('disabled'=>'disabled')); ?>
				
					<?php echo $form->labelEx($productModel,'serial_number'); ?>
					<?php echo $form->textField($productModel,'serial_number',array('disabled'=>'disabled')); ?>
					
					<?php echo $form->labelEx($productModel,'enr_number'); ?>
					<?php echo $form->textField($productModel,'enr_number',array('disabled'=>'disabled')); ?>
					
				</td>
				<td>
					
					<?php echo $form->labelEx($productModel,'purchased_from'); ?>
					<?php echo $form->textField($productModel,'purchased_from', array('disabled'=>'disabled')); ?>
					
					<?php	$viewPurchaseDate='';
							if (!empty($productModel->purchase_date))
							{
							$viewPurchaseDate=date('d-M-y', $productModel->purchase_date);
							}
							?>
					<?php echo $form->labelEx($productModel,'purchase_date'); ?>
					<?php echo CHtml::textField('',$viewPurchaseDate,  array('disabled'=>'disabled')); ?>
					<?php //echo $form->textField($productModel,'purchase_date', array('disabled'=>'disabled')); ?>
					
					<?php	$viewWarrantyDate='';
						 	if (!empty($productModel->warranty_date))
							{
								$viewWarrantyDate=date('d-M-y', $productModel->warranty_date);
							}
							?>
					<?php echo $form->labelEx($productModel,'warranty_date'); ?>
					<?php echo CHtml::textField('',$viewWarrantyDate,  array('disabled'=>'disabled')); ?>
					<?php //echo $form->textField($productModel,'warranty_date',array('disabled'=>'disabled')); ?>
				
					<?php echo $form->labelEx($productModel,'warranty_until'); ?>
					<?php 
						echo CHtml::textField('Warranty Date',$res,  array('disabled'=>'disabled'));
					?>
					
					<?php echo $form->labelEx($productModel,'fnr_number'); ?>
					<?php echo $form->textField($productModel,'fnr_number',array('disabled'=>'disabled')); ?>
					
				</td>
				</tr>
				<tr>
					<td colspan="2">
						<?php echo $form->labelEx($productModel,'notes'); ?>
						<?php echo $form->textArea($productModel,'notes',array('disabled'=>'disabled', 'rows'=>4, 'cols'=>40)); ?>
					</td>
				</tr>
				</table><!-- end of product table -->
			</td>
			</tr>
		</table>
		</div>
		
		<div class="row buttons">
			<?php echo CHtml::submitButton('Modify'); ?>
		</div>
		
		<?php 
		$testUrl=Yii::app()->request->baseUrl.'/setup/testConnection/';
		?>
		<a href="<?php echo $testUrl;?>" onclick = "return confirm('Are you sure you wanna send email?')">
		<?php echo CHtml::button('Test Connection');?>
		</a>
	
	<?php $this->endWidget(); ?>
	
	</div><!-- form -->
	
<?php  
   $mtime = microtime(); 
   $mtime = explode(" ",$mtime); 
   $mtime = $mtime[1] + $mtime[0]; 
   $endtime = $mtime; 
   $totaltime = ($endtime - $starttime); 
   //echo "This page was created in ".$totaltime." seconds"; 
;?>
