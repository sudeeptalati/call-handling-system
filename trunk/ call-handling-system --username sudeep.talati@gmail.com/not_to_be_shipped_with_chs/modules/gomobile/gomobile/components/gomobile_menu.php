<style>

#uplifts_menu {
padding-top: 5px;
padding-left: 25px;
padding-right: 1px;
padding-bottom: 5px;
background: #C7FAFF;
margin-top: -5px;
margin-bottom: 0px;
list-style: inline;
border-radius: 15px;	
}

#uplifts_menu li {
 display: inline;   
  

}
#uplifts_menu li + li {
  border-left: 1px solid;
  margin-left:2em;
  padding-left:2em;

}	

</style>

<div id='uplifts_menu'><?php

//echo "<li>".CHtml::link("Go Mobile",array('/gomobile'))."</li>"; 
echo "<li>".CHtml::link("Setup",array('/gomobile/gmjsonfields/admin'))."</li>";  
echo "<li>".CHtml::link("Send Servicecalls by Appointment Date",array('/gomobile/default/databyappointmentdate'))."</li>";  
echo "<li>".CHtml::link("Received Servicecalls",array('/gomobile/gmservicecalls/receivedcalls'))."</li>";  echo "<li>".CHtml::link("Sent Servicecalls",array('/gomobile/gmservicecalls/admin'))."</li>";  
echo "<li>".CHtml::link("Receive Call from Mobile",array('/gomobile/gmservicecalls/receiveservicecallfrommobile'))."</li>"; 
//echo "<li>".CHtml::link("Post Data to Server",array('/gomobile/default/PostDatatoServer'))."</li>"; 
?>
</div>
 <br><br>
