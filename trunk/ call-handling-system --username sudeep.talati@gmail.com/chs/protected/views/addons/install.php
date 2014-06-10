<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>


<h1>Installing Addon</h1>

<div id="submenu">   
<li><?php echo CHtml::link('Manage',array('admin')); ?></li>
<li><?php echo CHtml::link('Install',array('index')); ?></li>

</div>
 <br><br>




<?php


	
	if ($errors)
		{
			echo "<h3><span style='color:red'>Error in Installing Module</span></h3>'";
			foreach ($errors as $e)
			{
				echo "<span style='color:red'>";
				echo $e[0];
				echo "<span><br>";

			}
		}
		
		
		
		foreach ($log_msgs as $l)
			{
				echo "<span style='color:green'>";
				echo $l[0];
				echo "<span><br>";

			}
?>
