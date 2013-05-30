<div class="form">

<?php 
include 'setup_sidemenu.php';
?>
<table><tr>
	<td> <?php echo CHtml::link('Manage Notification Rules',array('/notificationRules/admin')); ?></td>
	<td> <?php echo CHtml::link('Create Notification Rules',array('/notificationRules/create')); ?></td>
	<td> <?php echo CHtml::link('SMS Setup',array('/setup/smsSettingsView')); ?></td>
	<td> <?php echo CHtml::link('Email Setup',array('/setup/mailServer')); ?></td>
</tr></table>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setup-mailSettings-form',
	'enableAjaxValidation'=>false,
)); ?>

	<h2>Mail Settings</h2>
	

<?php 

$root = dirname(dirname(dirname(__FILE__)));
//echo $root."<br>";
$filename = $root.'/config/mail_server.json';
$data = file_get_contents($filename);
	
	if(isset($_POST['mail_server_values']))
	{
		$smtp_host = $_POST['smtp_host'];
		//echo $smtp_host."<br>";
		$smtp_username =  $_POST['username'];
		//echo $smtp_username."<br>";
		$smtp_password = $_POST['password'];
		//echo $smtp_password."<br>";
		$smtp_encryption =  $_POST['encryption'];
		//echo $smtp_encryption."<br>";
		$smtp_port = $_POST['port'];
		//echo $smtp_port."<br>";
		
		if(file_exists($filename))
		{
			//echo "File is present<br>";
			$data = file_get_contents($filename);
			$decodedata = json_decode($data, true);
				
			$decodedata['smtp_host'] = $smtp_host;
			$decodedata['smtp_username'] = $smtp_username;
			$decodedata['smtp_password'] = $smtp_password;
			$decodedata['smtp_encryption'] = $smtp_encryption;
			$decodedata['smtp_port'] = $smtp_port;
		
			$fh = fopen($filename, 'w');
			fwrite($fh, json_encode($decodedata));
			fclose($fh);
		
		}//end of if file present.
		else
			echo "Mail settings file is not found";
	
	}//end of if(isset()). ***** END OF TAKING VALUES FROM FORM *******
	else 
	{
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
		}//end of if file exists.
		else 
			echo "Mail settings file is not found";
		
	}//end of else.
	
?>

<!-- ***** SAVING VALUES TO JSON FILE ********* -->

<?php 

/*	
	
	if(file_exists($filename))
	{
		//echo "File is present<br>";
 		$data = file_get_contents($filename);
 		$decodedata = json_decode($data, true);
 		
		$decodedata['smtp_host'] = $smtp_host;
		$decodedata['smtp_username'] = $smtp_username;
		$decodedata['smtp_password'] = $smtp_password;
		$decodedata['smtp_encryption'] = $smtp_encryption;
		$decodedata['smtp_port'] = $smtp_port;
		
		$fh = fopen($filename, 'w');
  		fwrite($fh, json_encode($decodedata));
  		fclose($fh);
		
	}//end of if file present.
	
	else 
	{
		echo "file not present";
	}
	
	
	*/

?>


<!-- ***** END OF SAVING VALUES TO JSON FILE ********* -->



	<div class="row">
		<?php echo "<b>Host</b><br>";?>
		<?php echo CHtml::textField('',$smtp_host, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		<?php echo "<b>User Name</b><br>";?>
		<?php echo CHtml::textField('',$smtp_username, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		<?php echo "<b>Password</b><br>";?>
		<?php echo CHtml::passwordField('',$smtp_password, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		<?php echo "<b>Encryption</b><br>";?>
		<?php echo CHtml::textField('',$smtp_encryption, array('disabled'=>'disabled'));?>
	</div>

	<div class="row">
		<?php echo "<b>Port</b><br>";?>
		<?php echo CHtml::textField('',$smtp_port, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row" >
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo CHtml::button('Edit', array('submit' => array('setup/mailServer'))); ?>
	</div>

	
<?php $this->endWidget(); ?>

</div><!-- form -->




