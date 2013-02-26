<div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>


<?php
// $this->breadcrumbs=array(
// 	'Setups'=>array('index'),
// 	$model->id=>array('view','id'=>$model->id),
// 	'Update',
// );

// $this->menu=array(
// 	array('label'=>'Change Logo', 'url'=>array('changeLogo')),
// //	array('label'=>'Email Settings', 'url'=>array('emailSetup')),
// 	array('label'=>'About & Help', 'url'=>array('about')),
// 	array('label'=>'Restore Database', 'url'=>array('restoreDatabase')),
// 	array('label'=>'Manage Setup', 'url'=>array('setup/1')),
	
// );

?>

<h1>Update Setup</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>