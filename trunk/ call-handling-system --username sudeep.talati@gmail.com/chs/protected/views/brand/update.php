 <div id="sidemenu">             
<?php include('setup_sidemenu.php'); ?>   
</div>
 
<h1>Update Brand :  <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('updateBrand', array('model'=>$model)); ?>