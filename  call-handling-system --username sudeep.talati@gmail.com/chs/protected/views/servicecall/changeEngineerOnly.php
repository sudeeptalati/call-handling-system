<?php 

$service_id = $_GET['service_id'];

$servicecallModel = Servicecall::model()->findByPk($service_id);

// echo "<br>Service call id in change engg = ".$service_id;
// echo "<br>Diary id of servicecall = ".$servicecallModel->engg_diary_id;
// echo "<br>Engineer name = ".$servicecallModel->enggdiary->engineer->fullname;
// echo "<br>Status of the service call = ".$servicecallModel->enggdiary->status;


?>

<center>
 	<b>
 		Changing Engineer for service call no :<?php echo $servicecallModel->service_reference_number;?>
 		<br>Current Engineer : <?php echo $servicecallModel->engineer->company;?>
 	</b>
 </center>
 
 <br>

<?php

$baseUrl=Yii::app()->request->baseUrl;
$changeEnggUrl=$baseUrl.'/Servicecall/selectEngineer/?diary_id='.$servicecallModel->engg_diary_id.'&service_id='.$service_id;

$updateServicecallChangeEngineerForm=$this->beginWidget('CActiveForm', array(
		'id'=>'updateService-changeEngineer-form',
		'enableAjaxValidation'=>false,
		'action'=>$changeEnggUrl,
		'method'=>'get'

));

$model = Servicecall::model();
//$engg_id = 0;
$data=CHtml::listData(Engineer::model()->findAll(array('order'=>"`company` ASC")), 'id', 'company');

echo $updateServicecallChangeEngineerForm->dropDownList($model, 'engineer_id', $data,
		array('empty'=>'All Engineers')
	);

echo "&nbsp;&nbsp;".CHtml::submitButton('Change');

$this->endWidget();

?>

 
