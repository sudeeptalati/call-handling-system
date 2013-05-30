
<?php 
include 'setup_sidemenu.php';
?>

<h1>Spares Lookup Url</h1>

<?php 

	$new_cloud_url = '';
	if(isset($_POST['cloud_url_update']))
	{
		//echo "<hr>UPDATE BUTTON IS CLICKED<hr>";
		//echo "Cloud url from textarea = ".$_POST['cloud_url']."<br>";
		$new_cloud_url = $_POST['cloud_url'];
		
		$db = new PDO('sqlite:../local_items_database/api/master_database.db');
		$result = $db->query("UPDATE  cloud_setup SET spares_lookup_cloud_url='$new_cloud_url' WHERE id = 1;");
			
	}//end of if(isset ()) of cloud_url_update button.
		
	//echo "<br>Cloud url outside if loop = ".$new_cloud_url;
		

?>

<div class="row">
		<?php echo "<b>Updated Cloud URL</b><br>";?>
		<?php echo CHtml::textArea('',$new_cloud_url, array('disabled'=>'disabled', 'cols'=>'65'));?>
</div>