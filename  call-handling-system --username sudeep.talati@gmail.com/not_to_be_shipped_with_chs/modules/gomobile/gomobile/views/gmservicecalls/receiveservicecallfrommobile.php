<?php include('gomobile_menu.php'); ?>  

<h2>Get Data</h2>



<button onclick="receive_data();">Get Data</button>

<script>
function receive_data() 
{
$.ajax({
	///url:'http://127.0.0.1/purva/call_handling/not_to_be_shipped_with_chs/modules/gomobile/gomobileServer/gomobile/index.php?r=server/getdatafordesktop',
  url:'http://www.rapportsoftware.co.uk/gomobileserver/gomobile/index.php?r=server/getdatafordesktop', 
	type: 'get',	
	data: {'engineer_email':'sweetpullo@gmail.com'}, 
	success: function(data, status) {   
				alert("Following data has been received from Mobile:"+data);
				console.log(data);
				setServicecallsStatus(data);
				
				
      },
      error: function(xhr, desc, err) {
      console.log(xhr);
	  alert("Details: " + desc + "\nError:" + err);
      }
	  
	})
}///end of function

function setServicecallsStatus(data)
{



$.ajax({
      url: 'index.php?r=gomobile/gmservicecalls/servicecallreceivedfromgomobileserver',
      type: 'post',
	  data: {'data':data},
	  success: function(data, status) {   
				alert("Success"+data);
				window.location='<?php echo Yii::app()->request->baseUrl."/index.php?r=gomobile/gmservicecalls/receivedcalls" ?>';
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
		alert("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call



}

</script>