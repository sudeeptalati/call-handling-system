


<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>



<h1>Install Addon</h1>

 <script type="text/javascript">
function Checkfiles(f){
 f = f.elements;
 if(/.*\.(zip)$/.test(f['addon_zip'].value.toLowerCase()))
  return true;
 alert('Please Upload Zip Package only.');
 f['addon_zip'].focus();
 return false;
};
</script>

<form   action="index.php?r=addons/install" onsubmit="return Checkfiles(this);" enctype="multipart/form-data" method="post">		

		
		 Please Upload the Add On Zip file<br>
		<input type="file" name='addon_zip' class='required'>
		<br> <br> 
		Or input the URL key<br>
		<input type="text" name='addon_url' class='required' style="width:500px;">
		<br><br>
		
		<input type="submit" name="finish"   value="Install" >
 <br>
 
 </form>
 
 
 
 
 
 