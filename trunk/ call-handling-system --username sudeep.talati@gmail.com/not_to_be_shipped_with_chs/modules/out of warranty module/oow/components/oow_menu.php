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
echo "<li>".CHtml::link("Add New Out of Warranty Product",array('/oow/search/create'))."</li>"; 
echo "<li>".CHtml::link("Manage",array('/oow/search/admin'))."</li>"; 
echo "<li>".CHtml::link("Config",array('/oow/default/config'))."</li>"; 

?>
</div>
 <br><br>
