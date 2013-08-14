<?php 
include 'setup_sidemenu.php';
?>
 <h2>Mail Settings</h2>
 
 
  
<div id="submenu">   
	<li> <?php echo CHtml::link('Manage Notification Rules',array('/notificationRules/admin')); ?></li>
	<li> <?php echo CHtml::link('Create Notification Rules',array('/notificationRules/create')); ?></li>
	<li> <?php echo CHtml::link('SMS Settings',array('/setup/smsSettingsView')); ?></li>
	<li> <?php echo CHtml::link('Email Settings',array('/setup/mailSettings')); ?></li>
</div>

<br>
<?php 
	
	$smtp_host = '';
	$smtp_username = '';
	$smtp_password = '';
	$smtp_encryption = '';
	$smtp_port = '';
	$smtp_auth = '';
	
	$root = dirname(dirname(dirname(__FILE__)));
	//echo $root."<br>";
	
	$filename = $root.'/config/mail_server.json';

	if(file_exists($filename))
	{
		//echo "File is present<br>";
		$data = file_get_contents($filename);
		$decodedata = json_decode($data, true);
		//echo "host = ".$decodedata['smtp_host']."<br>";
		
		$smtp_host = $decodedata['smtp_host'];
		//echo "<br>host value = ".$smtp_host;
		$smtp_username = $decodedata['smtp_username'];
		//echo "<br>user name = ".$smtp_username;
		$smtp_password = $decodedata['smtp_password'];
		//echo "<br>passowrd = ".$smtp_password;
		$smtp_encryption = $decodedata['smtp_encryption'];
		//echo "<br>encryption = ".$smtp_encryption;
		$smtp_port = $decodedata['smtp_port'];
		//echo "<br>post = ".$smtp_port;
		$smtp_auth = $decodedata['smtp_auth'];
		//echo "<br>SMTP authentication = ".$smtp_auth;
	}//end of if file exists.
	else 
	{
		echo "File not found";
	}
?>


<script type="text/javascript">  
function getSelectedValue() 
{  
    var index = document.getElementById('server_encryption').selectedIndex;
    //alert("value="+document.getElementById('server_encryption').value); 
    document.getElementById('encryption');
    encryption.value = document.getElementById('server_encryption').value;
}  

function getAuthenticateValue()
{
	var auth_index = document.getElementById('smtp_authentication').selectedIndex;
    //alert("value="+document.getElementById('smtp_authentication').value); 
	//alert("auth_value = "+auth_index);
    auth.value = document.getElementById('smtp_authentication').value;
}


</script>  



<form action="<?php echo Yii::app()->createUrl('setup/mailSettings')?>" method="post">
	
	<b>Host</b><br><input type="text" name="smtp_host" value=<?php echo $smtp_host;?>><br><br>
	
	<b>User Name</b><br><input type="text" name="username" required="required" value=<?php echo $smtp_username;?>><br><br>
	
	<b>Password</b><br><input type="password" name="password" value=<?php echo $smtp_password;?>><br><br>
	
	<b>Encryption Type</b><br>
	<select name="server_encryption" id="server_encryption" onchange="getSelectedValue();">
		<option value="none" selected>none</option>
<!--		<OPTION value="smtp">smtp</option>-->
		<option value="ssl">ssl</option>
		<option value="tls">tls</option>
	</select>
	<input type="hidden" name="encryption" id="encryption"><br><br>
	
	<b>Port</b><br><input type="text" name="port" value=<?php echo $smtp_port;?>><br><br>
	
	<b>SMTP Authentication</b><br>
	<select name="smtp_authentication" id="smtp_authentication" onchange="getAuthenticateValue();">
		<option value="none" selected>none</option>
		<option value="true">True</option>
		<option value="false">False</option>
	</select>
	<input type="hidden" name="auth" id="auth"><br><br>
	
	<input name="mail_server_values"  value="Save" type="submit"   style="width:100px">
	
</form>	


	


