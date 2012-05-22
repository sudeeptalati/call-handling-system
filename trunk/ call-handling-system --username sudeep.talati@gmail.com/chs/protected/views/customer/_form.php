<script type="text/javascript">
function PostcodeAnywhere_Interactive_RetrieveByPostcodeAndBuilding_v1_10Begin(Key, Postcode,  UserName)
   {
      var scriptTag = document.getElementById("PCA38d38252878f434581f85b249661cd94");
      var headTag = document.getElementsByTagName("head").item(0);
      var strUrl = "";

      //Build the url
      strUrl = "http://services.postcodeanywhere.co.uk/PostcodeAnywhere/Interactive/RetrieveByPostcodeAndBuilding/v1.10/json.ws?";
      strUrl += "&Key=" + escape(Key);
      strUrl += "&Postcode=" + escape(Postcode);
      //strUrl += "&Building=" + escape(Building);
      strUrl += "&UserName=" + escape(UserName);
      strUrl += "&CallbackFunction=PostcodeAnywhere_Interactive_RetrieveByPostcodeAndBuilding_v1_10End";

      //Make the request
      if (scriptTag) 
         {
            try
              {
                  headTag.removeChild(scriptTag);
              }
            catch (e)
              {
                  //Ignore
              }
         }
      scriptTag = document.createElement("script");
      scriptTag.src = strUrl
      scriptTag.type = "text/javascript";
      scriptTag.id = "PCA38d38252878f434581f85b249661cd94";
      headTag.appendChild(scriptTag);
   }

function PostcodeAnywhere_Interactive_RetrieveByPostcodeAndBuilding_v1_10End(response)
   {
      //Test for an error
      if (response.length==1 && typeof(response[0].Error) != 'undefined')
         {
            //Show the error message
            alert(response[0].Description);
         }
      else
         {
            //Check if there were any items found
            if (response.length==0)
               {
                  alert("Sorry, no matching items found");
               }
            else
               {
         
 		 
		 
               }
         }
   }///end of call function
   
   
   function PostcodeAnywhere_Interactive_RetrieveByPostcodeAndBuilding_v1_10End(response)
   {
      //Test for an error
      if (response.length==1 && typeof(response[0].Error) != 'undefined')
         {
            //Show the error message
            
			var msg='!  Please Set A valid Key from setup page';
			alert(response[0].Description+msg);
			
         }
      else
         {
            //Check if there were any items found
            if (response.length==0)
               {
                  alert("Sorry, no matching items found");
               }
            else
               {
	 
	document.getElementById("Customer_address_line_1").value= response[0].Line1;
	document.getElementById("Customer_address_line_2").value= response[0].Line2;
	document.getElementById("Customer_address_line_3").value= response[0].Line3;
	document.getElementById("Customer_town").value= response[0].PostTown;
	document.getElementById("Customer_country").value= response[0].CountryName;
	//document.getElementById("postcode").value= response[0].Postcode;

               }
         }
   }
   
   
   
   
   
</script>


<STYLE type="text/css">
select:focus,textarea:focus, input:focus { 

border: 1px solid #900; 
background-color: #FFFF9D; 
}


</STYLE>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'customer-form',
	'enableAjaxValidation'=>false,
)); ?>

	
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($model); ?>
	
	<?php 
		 
//		$result= Product::model()->findAllByAttributes(array('customer_id'=>$model->id));
//		if(count($result)>1)
//		{
//			echo "<h3>Select product for customer ".$model->fullname." to update details</h3>";
//	    	foreach ($result as $data)
//	    	{
////	    		$baseUrl=Yii::app()->baseUrl;
////	    		$url=$baseUrl.'/customer/updateCustomer/?customer_id='.$.'&start_date='.$week_start_date.'&end_date='.$week_end_date;
////	    		$url= Y
//	    		echo CHtml::link($data->productType->name, array('customer/updateCustomer/?customer_id='.$model->id.'&product_id='.$data->id))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
//	    	}
//		}//end of if.
//		
//		else 
//		{
//		
//	
//	
//	?>
	
	<?php 
		if(!empty($model->product->id))
		{
			$productModel=Product::model()->findByPk($model->product_id);
		}
		else 
		{
			$productModel=Product::model();
		}
		
	?>
	
	<!-- ******* DISPLAYING CUSTOMER  ********* -->
	
	<table>
	<tr>
		<td>
			<h2>Customer Details</h2>
		</td>
		<td>
			<h2>Product Details</h2>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:top;">
			<?php echo $form->labelEx($model,'title'); ?>
			<?php echo $form->dropDownList($model,'title',array('Mr'=>'Mr', 'Miss'=>'Miss', 'Mrs'=>'Mrs','Mrs'=>'Mrs', 'Dr'=>'Dr',)); ?>
			<?php echo $form->error($model,'title'); ?>
			
			<?php echo $form->labelEx($model,'first_name'); ?>
			<?php echo $form->textField($model,'first_name',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'first_name'); ?>
			
			<?php echo $form->labelEx($model,'last_name'); ?>
			<?php echo $form->textField($model,'last_name',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'last_name'); ?>
			
			
				<?php echo $form->labelEx($model,'postcode_s'); ?>
			<?php echo $form->textField($model,'postcode_s',array('size'=>6,'maxlength'=>4 )); ?>
			<?php echo $form->textField($model,'postcode_e',array('size'=>6,'maxlength'=>4)); ?>
			<?php echo $form->error($model,'postcode_s'); ?>
			<?php echo $form->error($model,'postcode_e'); ?>
			
			<?php
					$config=Config::model()->findByPk(1);
				 	$postcodeanwhere_account_code=$config->postcodeanywhere_account_code;
					$postcodeanwhere_license_key=$config->postcodeanywhere_license_key;
			?>
								 <input type=button value="Find" 
   onclick="Javascript: PostcodeAnywhere_Interactive_RetrieveByPostcodeAndBuilding_v1_10Begin
      ('<?php echo $postcodeanwhere_license_key; ?>',
       (document.getElementById('Customer_postcode_s').value + document.getElementById('Customer_postcode_e').value),
       ''
      )"> 
	  
	  

			<?php echo $form->labelEx($model,'address_line_1'); ?>
			<?php echo $form->textField($model,'address_line_1',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'address_line_1'); ?>
			
			<?php echo $form->labelEx($model,'address_line_2'); ?>
			<?php echo $form->textField($model,'address_line_2',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'address_line_2'); ?>
			
			<?php echo $form->labelEx($model,'address_line_3'); ?>
			<?php echo $form->textField($model,'address_line_3',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'address_line_3'); ?>
			
			<?php echo $form->labelEx($model,'town'); ?>
			<?php echo $form->textField($model,'town',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'town'); ?>
			
		
			<?php echo $form->labelEx($model,'country'); ?>
			<?php echo $form->textField($model,'country',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'country'); ?>
	
			<?php echo $form->labelEx($model,'telephone'); ?>
			<?php echo $form->textField($model,'telephone',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'telephone'); ?>
			
			<?php echo $form->labelEx($model,'mobile'); ?>
			<?php echo $form->textField($model,'mobile',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'mobile'); ?>
			
			<?php echo $form->labelEx($model,'fax'); ?>
			<?php echo $form->textField($model,'fax',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'fax'); ?>
			
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'email'); ?>
			<small style="color:maroon"><br>User will be notified via email.</small>
			
			
			<?php echo $form->labelEx($model,'notes'); ?>
			<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>30)); ?>
			<?php echo $form->error($model,'notes'); ?>
		</td>
	
		<!-- ************ DISPLAYING PRODUCT DETAILS *********** -->
		<td>
		<div class="row">
		<table>
		<tr>
			<td>
			<?php echo $form->labelEx($productModel,'contract_id'); ?>
			<?php //echo $form->textField($model,'contract_id'); ?>
			<?php echo CHtml::activeDropDownList($productModel, 'contract_id', $productModel->getAllContract());?>
			<?php echo $form->error($productModel,'contract_id'); ?>
			
			<?php echo $form->labelEx($productModel,'brand_id'); ?>
			<?php //echo $form->textField($model,'brand_id'); ?>
			<?php echo CHtml::activeDropDownList($productModel, 'brand_id', $productModel->getAllBrands());?>
			<?php echo $form->error($productModel,'brand_id'); ?>
			
			<?php echo $form->labelEx($productModel,'purchased_from'); ?>
			<?php echo $form->textField($productModel,'purchased_from',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($productModel,'purchased_from'); ?>
			
			<?php //echo $form->labelEx($productModel,'customer_id'); ?>
			<?php //CUSTOMER ID SET TO ZERO TO CHECK WHETHER NEW CUSTOMER.?>
			<?php echo $form->hiddenField($productModel,'customer_id',array('value'=>0)); ?>
			<?php echo $form->error($productModel,'customer_id'); ?>
			
			<?php //echo $form->labelEx($productModel,'purchase_date'); ?>
			<?php //echo $form->textField($productModel,'purchase_date'); ?>
			<?php //echo $form->error($productModel,'purchase_date'); ?>

				
	<?php echo $form->labelEx($productModel,'purchase_date'); ?>
		<?php 
			if(!empty($productModel->purchase_date))
			{
				$productModel->purchase_date = date('d-m-Y', $productModel->purchase_date);
			}
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>CHtml::activeName($productModel, 'purchase_date'),
				'model'=>$productModel,
        		'value' => $productModel->attributes['purchase_date'],
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
		<?php //echo $form->textField($model,'fault_date'); ?>
		<?php echo $form->error($productModel,'warranty_date'); ?>
		
		<?php echo $form->labelEx($productModel,'warranty_date'); ?>
		<?php 
			
			if(!empty($productModel->warranty_date))
			{
				$productModel->warranty_date = date('d-m-Y', $productModel->warranty_date);
			}
			
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    'name'=>CHtml::activeName($productModel, 'warranty_date'),
				'model'=>$productModel,
        		'value' => $productModel->attributes['warranty_date'],
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
		<?php //echo $form->textField($model,'fault_date'); ?>
		<?php echo $form->error($productModel,'warranty_date'); ?>
		
			
			
			
	
			<?php echo $form->labelEx($productModel,'model_number'); ?>
			<?php echo $form->textField($productModel,'model_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($productModel,'model_number'); ?>
			
			<?php echo $form->labelEx($productModel,'serial_number'); ?>
			<?php echo $form->textField($productModel,'serial_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($productModel,'serial_number'); ?>
			
			<?php echo $form->labelEx($productModel,'production_code'); ?>
			<?php echo $form->textField($productModel,'production_code',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($productModel,'production_code'); ?>
			
			<?php echo $form->labelEx($productModel,'enr_number'); ?>
			<?php echo $form->textField($productModel,'enr_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($productModel,'enr_number'); ?>
			
			<?php echo $form->labelEx($productModel,'fnr_number'); ?>
			<?php echo $form->textField($productModel,'fnr_number',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($productModel,'fnr_number'); ?>
			
			<?php echo $form->labelEx($productModel,'discontinued'); ?>
			<?php echo $form->textField($productModel,'discontinued'); ?>
			<?php echo $form->error($productModel,'discontinued'); ?>
			
			<?php echo $form->labelEx($productModel,'warranty_for_months'); ?>
			<?php echo $form->textField($productModel,'warranty_for_months'); ?>
			<?php echo $form->error($productModel,'warranty_for_months'); ?>
			
			<?php echo $form->labelEx($productModel,'purchase_price'); ?>
			<?php echo $form->textField($productModel,'purchase_price'); ?>
			<?php echo $form->error($productModel,'purchase_price'); ?>
			
			<?php echo $form->labelEx($productModel,'notes'); ?>
			<?php echo $form->textArea($productModel,'notes',array('rows'=>6, 'cols'=>30)); ?>
			<?php echo $form->error($productModel,'notes'); ?>
			</td>
			<td colspan="2" style="vertical-align:top;">
				<?php echo $form->labelEx($productModel,'engineer_id'); ?>
				<?php //echo $form->textField($model,'engineer_id'); ?>
				<?php echo CHtml::activeDropDownList($productModel, 'engineer_id', $productModel->getAllEngineers());?>
				<?php echo $form->error($productModel,'engineer_id'); ?>
				
				<?php echo $form->labelEx($productModel,'product_type_id'); ?>
				<?php //echo $form->textField($model,'product_type_id'); ?>
				<?php echo CHtml::activeDropDownList($productModel, 'product_type_id', $productModel->getProductTypes());?>
				<?php echo $form->error($productModel,'product_type_id'); ?>
			
			</td>
			</tr>
		</table>
		</div>
	</td>
	</tr>
	</table>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Register' : 'Modify'); ?>
	</div>
	
	<?php // }//end of else of count($result).?>
<?php $this->endWidget(); ?>

</div><!-- form -->