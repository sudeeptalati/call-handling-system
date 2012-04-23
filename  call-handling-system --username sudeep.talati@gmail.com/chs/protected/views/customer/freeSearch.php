<body onload="document.search_form.query.focus()">

<?php 
$this->menu=array(
	//array('label'=>'List Servicecall', 'url'=>array('/servicecall/index')),
	array('label'=>'Recent Service Calls', 'url'=>array('/servicecall/admin')),
);	
?>
 <?php 
  /*To import the client script*/
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery.js');
  ?>
  
   <div class="admin">
 
  <script type="text/javascript">
 
 
$(document).ready(function() {
 
 
$("#faq_search_input").keyup(function()
{
	var faq_search_input = $(this).val();
	var dataString = 'keyword='+ faq_search_input;
	 
//	var ref_id = $('#ref_id').val(); 
//	var cust_id = $('#cust_id').val(); 
	var current_url = $('#current_url').val(); 

	/*This is the minimum size of search string. Search will be only done when at-least 3 characters are provided in input*/
	if(faq_search_input.length>3)
	{
		$.ajax({
		type: "GET",
		url: current_url+"/SearchEngine",
		data: dataString,
		/*Uncomment this if you want to send the additional data*/
		//data: dataString+"&refid="+ref_id+"&custid="+cust_id,
		beforeSend:  function() 
		{
 			$('input#faq_search_input').addClass('loading');
 		},
 		success: function(server_response)
 		{
 		 
 			$('#searchresultdata').html(server_response).show();
 			$('span#faq_category_title').html(faq_search_input);

 			if ($('input#faq_search_input').hasClass("loading")) 
 	 		{
 				 $("input#faq_search_input").removeClass("loading");
 			}

 		}//end of success
		});//end of $.ajax
	}//end of if.
	return false;
});//end of keyup function.
});//end of ready function.
</script>

<?php
 
/*You need to change the URL as per your requirements, else this will show error page*/
$model_name=Yii::app()->controller->id;
$current_url=$baseUrl."/".$model_name;

/*To Send the additional data if needed*/
//$reference_id = 88;
//$customer_id = 77;
//echo "Search   :".$current_url."<br>";
?>

<h2>Create New Service Call</h2>
<input type="hidden" id="current_url" value="<?php echo $current_url;?>"/> 
        <!-- if YOU WANT TO SEND ADDITIONAL HIDDEN VARIABLES-->
<!--        <input type="hidden" id="ref_id" value="<?php //echo $reference_id ;?>"/> -->
<!--        <input type="hidden" id="cust_id" value="<?php //echo $customer_id ;?>"/>  -->
        
              Search by Customer Name or Postcode or Town or Phone 	number<br><br>
                <!-- The Searchbox Starts Here  -->
                <form  name="search_form">
                 <input  name="query" type="text" id="faq_search_input" style="background-color: #FFFFFF" />
                </form>
                <!-- The Searchbox Ends  Here  -->
        <div id="searchresultdata" class="faq-articles"> </div>
        <br/>
        
       <?php echo CHtml::link('New Customer', array('servicecall/create')); ?>
        
     </div>
     
      
     
     
     
     
     
     
     
     
     
     
     
     
