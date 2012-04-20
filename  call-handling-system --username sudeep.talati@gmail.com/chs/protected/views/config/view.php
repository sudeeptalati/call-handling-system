<?php


$this->menu=array(
	array('label'=>'Change Logo', 'url'=>array('config/changeLogo')),
	array('label'=>'About & Help', 'url'=>array('config/about')),
	array('label'=>'Restore Database', 'url'=>array('config/restoreDatabase')),
	array('label'=>'Job Status', 'url'=>array('JobStatus/admin')),
	
);

?>


<h1>Set Up</h1>
<div style="text-align:right;" >
<?php echo CHtml::link('Edit',array('update', 'id'=>$model->id)); ?>
</div>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	//	'id',
		'company',
		'address',
		'town',
		'postcode_s',
		'postcode_e',
		'county',
		'country',
		'email',
		'website',
		'telephone',
		'mobile',
		'alternate',
		'fax',
		'vat_reg_no',
		'company_number',
		array(
			'name'=>'postcodeanywhere_account_code',
			'type'=>'raw',
			'value'=>'<a href="admin" target="_blank">'.$model->postcodeanywhere_account_code.'</a>'
		),

		//'postcodeanywhere_account_code',
		'postcodeanywhere_license_key',


		'custom4',
		'custom5',
	),
)); ?>


