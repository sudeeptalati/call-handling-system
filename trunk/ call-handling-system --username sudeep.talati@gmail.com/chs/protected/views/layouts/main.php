<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<?php 
	
		$request='http://rapportsoftware.co.uk/versions/rapport_callhandling.txt';	
		$available_version = file_get_contents($request, true);
		$installed_version=Yii::app()->params['software_version'];
		if ($available_version!=$installed_version)
		{	?>
			<span style="background-color:yellow; color:black;">
			Your current version is <?php echo $installed_version; ?>
			There is a new updated version <?php echo $available_version ?> available for this software. Please go to rapportsoftware.co.uk to download and update the package
			</span>
			<?php 
		}
	?>
</head>

<body>
<?php
$company_logo=Yii::app()->request->baseUrl."/images/company_logo.png";
$rapport_logo=Yii::app()->request->baseUrl."/images/rapport_logo.png";
//$header_name= CHtml::encode(Yii::app()->name);
$config=Config::model()->findByPk(1);
$header_name=$config->company;

?>

<div class="container" id="page">
	
	<table><tr>
		<td style="margin:20px; vertical-align:middle;" ><div id="logo" ><?php echo $header_name; ?><br><small>Call Handling</small></div></td>
		<td style="margin:20px; text-align:right;" >
	<?php echo CHtml::image($company_logo,"ballpop",array("width"=>"200", "height"=>"75")); ?>
	</td>
	<tr>
	</table>
	
	
	<div id="header">
		</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				//array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
				//array('label'=>'Brand', 'url'=>array('/brand/admin')),
				//array('label'=>'Product Type', 'url'=>array('/productType/admin')),
				//array('label'=>'Contract Type', 'url'=>array('/contractType/admin')),
				//array('label'=>'Contact Details', 'url'=>array('/contactDetails/admin')),
				//array('label'=>'Product', 'url'=>array('/product/admin')),
				
				array('label'=>'Servicecall', 'url'=>array('/customer/freeSearch')),					
				array('label'=>'Customer', 'url'=>array('/customer/admin')),
				array('label'=>'Contract', 'url'=>array('/contract/admin')),
				array('label'=>'Diary', 'url'=>array('/enggdiary/changeEngineer/?month='.date('m').'&year='.date('y'))),
				array('label'=>'Engineer', 'url'=>array('/engineer/admin')),
				array('label'=>'Setup', 'url'=>array('/config/1')),
				array('label'=>'Back Up', 'url'=>array('/site/backup'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div id="footer">
	
	<table><tr><td>
	<?php echo CHtml::image($rapport_logo,"ballpop", array("width"=>"170", "height"=>"56.6")); ?>
	</td>
	<td style="text-align:right;">
		Copyright &copy; <?php echo date('Y'); ?> by UK Whitegoods Ltd.<br/>

			
	</td></tr></table>
</div><!-- footer -->
</div><!-- page -->

</body>
</html>