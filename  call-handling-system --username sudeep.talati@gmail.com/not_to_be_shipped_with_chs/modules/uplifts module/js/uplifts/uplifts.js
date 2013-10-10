  window.onload =changeAttribute();
  
  function changeAttribute()
  {
   	console.log("Change Attribute called");
	
	
	
	if (document.getElementById("Uplifts_servicecall_id"))
	{
		var servicecall_attribute= document.getElementById("Uplifts_servicecall_id");   	
		console.log("Uplifts_servicecall_id ini is "+servicecall_attribute.value);
		servicecall_attribute.setAttribute("onkeyup","checkIfServicecallPresent();"); 	  
	}
	
  
  }
  
  
  
  
  function checkIfServicecallPresent()
  {
	var servicecall_id= document.getElementById("Uplifts_servicecall_id").value;   	
	
	////Removing all spaces
	servicecall_id = servicecall_id.replace(/\s/g,'');
	servicecall_id =servicecall_id.toUpperCase()
	console.log("checkIfSerialNumberOow Serial ini is "+servicecall_id);
	
	////Call the Ajax to Check for this serial numbber.
 
	 
$.ajax({
type: "GET",
url: "index.php?r=uplifts/default/searchservicecall",
data: "servicecall_id="+servicecall_id,
async:false,
success: function(server_response)
{
	//console.log(server_response);
	//alert(server_response);
	
	var jsonObj = jQuery.parseJSON( server_response );
	//console.log("******"+ jsonObj.searchstatus);
	if (jsonObj.searchstatus=='1')
	{
		//alert (jsonObj.response);
		console.log(jsonObj.searchstatustext);
		
		//document.getElementById("Uplifts_servicecall_id").value=jsonObj.searchstatustext;
		document.getElementById("Uplifts_customer_id").value=jsonObj.customer_id;
		document.getElementById("Uplifts_product_id").value=jsonObj.product_id;
		document.getElementById("Uplifts_product_type").value=jsonObj.productType_name;
		document.getElementById("Uplifts_retailer").value=jsonObj.product_retailer;
		document.getElementById("Uplifts_distributor").value=jsonObj.product_distributor;
		document.getElementById("Uplifts_visited_engineer_name").value=jsonObj.visited_engineer_name;
		document.getElementById("Uplifts_visited_engineer_id").value=jsonObj.visited_engineer_id;
		document.getElementById("Uplifts_model_number").value=jsonObj.product_model_number;
		document.getElementById("Uplifts_serial_number").value=jsonObj.product_serial_number;
		document.getElementById("Uplifts_index_number").value=jsonObj.product_index_number;
		document.getElementById("Uplifts_date_of_purchase").value=jsonObj.product_date_of_purchase;

		$("#Uplifts_customer_name").text(jsonObj.customer_name);
		$("#Uplifts_customer_town_postcode").text(jsonObj.customer_town_postcode);
		

	}
	
	
}//end of success
 

});//end of $.ajax

 

 	
	
  }
  
  
  