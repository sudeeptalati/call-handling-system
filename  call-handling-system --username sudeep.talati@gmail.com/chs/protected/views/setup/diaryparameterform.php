
<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>

<br>
<?php 

$no_next_days = ''; 
$allowedtraveldistancebetweenpostcodes = '';
$totalnoofcallsperday = '';
$workingdaysofweekstring = '';
$averagetimeperservicecall = '';
$totaldistancetobetravelledinaday = '';


$root = dirname(dirname(dirname(__FILE__)));
//echo $root."<br>";

$filename = $root.'/config/diary_parameters.json';

if(file_exists($filename))
{
	//echo "File exixts";
	$diarydata = file_get_contents($filename);
	$diaryDecodedData = json_decode($diarydata, true);
	//echo $filename."<br>";
	//print_r($diaryDecodedData);
	
	$no_next_days = $diaryDecodedData['no_next_days'];
	//echo "<br>user name = ".$gateway_username;
	$allowedtraveldistancebetweenpostcodes = $diaryDecodedData['allowedtraveldistancebetweenpostcodes'];
	//echo "<br>password = ".$gateway_password;
	$workingdaysofweekstring = $diaryDecodedData['workingdaysofweekstring'];
	//echo "<br>Api key = ".$gateway_apikey;
	$totalnoofcallsperday = $diaryDecodedData['totalnoofcallsperday'];
	$averagetimeperservicecall = $diaryDecodedData['averagetimeperservicecall'];
	$totaldistancetobetravelledinaday = $diaryDecodedData['totaldistancetobetravelledinaday'];
	
}



?>


<form action="<?php echo Yii::app()->createUrl('setup/diaryparametersview')?>" method="post">
	
	<b>No. of next days</b><br><input type="text" name="no_next_days" value=<?php echo $no_next_days;?>><br><br>
	
	<b>Allowed distance between two postcodes</b><br><input type="text" name="allowedtraveldistancebetweenpostcodes" value=<?php echo $allowedtraveldistancebetweenpostcodes;?>><br><br>
	
	<b>Working days of week</b><br><input type="text" name="workingdaysofweekstring" value=<?php echo $workingdaysofweekstring;?>><br><br>
	
	<b>No. of calls per day</b><br><input type="text" name="totalnoofcallsperday" value=<?php echo $totalnoofcallsperday;?>><br><br>
	
	<b>Average time per call</b><br><input type="text" name="averagetimeperservicecall" value=<?php echo $averagetimeperservicecall;?>><br><br>
	
	<b>Distance to be travelled in a day</b><br><input type="text" name="totaldistancetobetravelledinaday" value=<?php echo $totaldistancetobetravelledinaday;?>><br><br>
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="diary_parameters_values"  type="submit" style="width:100px">
	
</form>	