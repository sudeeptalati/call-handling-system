<?php
$this->breadcrumbs=array(
 
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Customer', 'url'=>array('index')),
	array('label'=>'Create Customer', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('customer-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php ?>
<h1>Manage Customers</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customer-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'title',
		//'first_name',
		//'last_name',
		'fullname',
		'town',
		'postcode_s',
		//'product_id',
		array('name'=>'product_brand', 'value'=>'$data->product->brand->name'),
		array('name'=>'product_type', 'value'=>'$data->product->productType->name'),
		array('name'=>'model_number', 'value'=>'$data->product->model_number'),
		array('name'=>'serial_number', 'value'=>'$data->product->serial_number'),
		//'telephone',
		//'address_line_1',
		//array( 'name'=>'created_by_user', 'value'=>'$data->createdByUser->username' ),
		/*
		'address_line_2',
		'address_line_3',
		'country',
		'mobile',
		'fax',
		'email',
		'notes',
		'created_by_user_id',
		'created',
		'modified',
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
			'buttons' => array(
				'update' =>array
				(
//					'label'=>'update Customer',
//		            'imageUrl'=>Yii::app()->request->baseUrl.'/images/update.png',
//					'options' => array('class'=>'update-button'),
//					'url' => 'Yii::app()->createUrl("customer/updateCustomer" , array("customer_id"=>$data->id, "product_id"=>$data->product_id))',
					'url' => 'Yii::app()->createUrl("Customer/openDialog" , array("customer_id"=>$data->id, "product_id"=>$data->product_id))',
//					//'click' => 'function(){alert("id is :'.$model->allProducts($model->id).'");}',
//					//'click' => 'function(){alert("'.$model->displayAllProducts(array("id"=>$data["id"])).'");}',
//					//'click' => 'function(){alert("'.$model->displayAllProducts($data["id"]).'");}',
//					//'click' => "js:'function(){alert("$row['id']");}'",
//					//'click' => 'js:function(){alert("first element in cgridview is "+$(this).parent().parent().children(":nth-child(1)").text());}'
//					//'click' => 'click' => 'js:function(){alert("first element in cgridview is "+$(this).attr(id)+;}'
					
				),
			),	
		) ,
		array(
			//'name'=>'',
			'type' => 'raw',
			'value' => 'CHtml::link("Add another product",array("product/addProduct", "id"=>$data->id))',
		),
	),
)); ?>
