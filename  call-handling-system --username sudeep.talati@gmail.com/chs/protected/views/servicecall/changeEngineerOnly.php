<?php 

$service_id = $_GET['service_id'];

$servicecallModel = Servicecall::model()->findByPk($service_id);

//echo "<br>Service call id in change engg = ".$service_id;
//echo "<br>Diary id of servicecall = ".$servicecallModel->engg_diary_id;
//echo "<br>Engineer name = ".$servicecallModel->enggdiary->engineer->fullname;
//echo "<br>Status of the service call = ".$servicecallModel->enggdiary->status;


?>

 <center>
 	<b>
 		Changing Engineer for service call no :<?php echo $servicecallModel->service_reference_number;?>
 		<br>Current Engineer : <?php echo $servicecallModel->enggdiary->engineer->fullname;?>
 	</b>
 </center>
 

<?php 
echo "<hr>LIST OF ALL ENGINEERS<br>";

$engineerModel = Engineer::model()->findAll();
?>
<table>
  <tr>
    <th>Engineer Name</th>
    <th></th>
    <th></th>
  </tr>
  
 <?php 

foreach ($engineerModel as $engineer)
{

?>

	<tr>
    <!--<td><?php //echo $engineer->fullname;?></td>
    <td><?php //echo CHtml::link('View Diary', array('servicecall/engineerDiary', 'engg_id'=>$engineer->id));?></td>-->
    <td><?php echo CHtml::link($engineer->fullname, 
    								array('servicecall/selectEngineer', 'engg_id'=>$engineer->id, 'diary_id'=>$servicecallModel->engg_diary_id, 'service_id'=>$service_id)
    							);?></td>
  </tr>


<?php }//end of foreack of engineers.?>

</table>



