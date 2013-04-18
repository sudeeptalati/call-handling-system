<div class="form">

<?php 
include 'setup_sidemenu.php';
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setup-smsSettingsView-form',
	'enableAjaxValidation'=>false,
));
?>

<?php 

/***** GETTING DATA FROM smsSettingsForm *************/
	if(isset($_POST['smsgateway_setting_values']))
	{
		$gateway_username = $_POST['gateway_username'];
		//echo $gateway_username;
		$gateway_password =  $_POST['gateway_password'];
		//echo "<br>".$gateway_password;
		$gateway_apikey = $_POST['gateway_apikey'];
		//echo "<br>Api key = ".$gateway_apikey;
		 
	}//end of if(isset).
	
	/***** END OF GETTING DATA FROM smsSettingsForm *************/
	
?>

<!-- ****** CODE TO REPLACE JSON FILE WITH CHANGED DATA ********* -->

<?php 

$root = dirname(dirname(dirname(__FILE__)));
//echo $root."<br>";
$filename = $root.'/config/smsgateway_settings.json';
$data = file_get_contents($filename);

if(file_exists($filename))
{
	//echo "<br>File is present";
	$smsdata = file_get_contents($filename);
	$smsDecodedData = json_decode($smsdata, true);
	
	$smsDecodedData['gateway_username'] = $gateway_username;
	$smsDecodedData['gateway_password'] = $gateway_password;
	$smsDecodedData['gateway_apikey'] = $gateway_apikey;
	
	$fh = fopen($filename, 'w');
	fwrite($fh, json_encode($smsDecodedData));
	fclose($fh);
}

?>
	
<!-- ****** END OF CODE TO REPLACE JSON FILE WITH CHANGED DATA ********* -->	
	
	<h2>SMS Gateway Settings</h2>
	
<!-- ********** DISPLAYING CHANGED DATA ************ -->
	
	<div class="row">
		<?php echo "<b>User Name</b><br>";?>
		<?php echo CHtml::textField('',$gateway_username, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		<?php echo "<b>Password</b><br>";?>
		<?php echo CHtml::textField('',$gateway_password, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		<?php echo "<b>Api Key</b><br>";?>
		<?php echo CHtml::textField('',$gateway_apikey, array('disabled'=>'disabled'));?>
	</div>
	
	<div class="row">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo CHtml::button('Update', array('submit' => array('setup/smsSettingsForm'))); ?>
	</div>
	
<!-- ********** DISPLAYING CHANGED DATA ************ -->	
	

<?php $this->endWidget(); ?>

</div><!-- form -->