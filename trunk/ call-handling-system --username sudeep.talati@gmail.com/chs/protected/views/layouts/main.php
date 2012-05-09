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

</head>

<body>
<?php
$company_logo=Yii::app()->request->baseUrl."/images/company_logo.png";
$rapport_logo=Yii::app()->request->baseUrl."/images/rapport_logo.png";


//$header_name= CHtml::encode(Yii::app()->name);
$config=Config::model()->findByPk(1);
$header_name=$config->company;
$baseUrl= Yii::app()->request->baseUrl; 
?>

<div class="container" id="page">
	
	<table style="width:100%;">
	<tr>
		
		<td style="margin:50px; text-align:left;" >
			<?php //echo CHtml::image($company_logo,"ballpop",array("width"=>"200", "height"=>"75")); ?>
			<a href='<?php echo $baseUrl;?>' style='color:#555;text-decoration:  none;' >
			<?php echo CHtml::image($company_logo); ?>
			</a>
		</td>
		
		<td style="margin:20px; text-align:right;" ><div id="logo" >
		<a href='<?php echo $baseUrl;?>' style='color:#555;text-decoration:  none;' >
			<?php echo $header_name; ?><br><small>Call Handling</small></div>
		</a>
		</td>
		
	</tr>
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
				
				array('label'=>'Service Call', 'url'=>array('/customer/freeSearch')),					
				array('label'=>'Diary', 'url'=>array('/enggdiary/changeEngineer/?month='.date('m').'&year='.date('y'))),
				array('label'=>'New Customer', 'url'=>array('/customer/create')),
				//array('label'=>'Contract', 'url'=>array('/contract/admin')),
	
				array('label'=>'Engineer', 'url'=>array('/engineer/admin')),
				array('label'=>'Setup', 'url'=>array('/config/1')),
				array('label'=>'Back Up', 'url'=>array('/site/backup'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest, 'linkOptions'=>array('confirm'=>'Are you sure you want to Logout?'))
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