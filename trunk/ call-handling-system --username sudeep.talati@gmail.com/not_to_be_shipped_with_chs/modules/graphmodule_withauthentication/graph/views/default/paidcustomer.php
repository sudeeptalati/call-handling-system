<?php

echo "Account Expired. Kindly apply for resubscription."."<br>";
//echo "Enter the New Key";
$e=Graph::model()->loadjson();
//echo $e['key'].'<br>';
//echo $e['exp_date_e'].'<br>';
$url = 	Yii::getPathOfAlias('application.modules.graph.components');	
$file= $url.'\graph.json';
//echo $file."<br>";
$url1=Yii::app()->baseUrl;
//echo $url1.'/index.php?r=graph/default/servercode_simple_for_json'
?><br>
<form name="input" action="<?php echo Yii::app()->baseUrl.'/index.php?r=graph/default/servercode_simple_for_json'?>" method="post">
Enter Key: <input type="text" name="key"><br>
<input type="submit" value="Submit">
</form>