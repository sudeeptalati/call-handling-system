<?php include('gomobile_menu.php'); ?>  


<?php

$gomobile_accountid_model=AdvanceSettings::model()->findByAttributes(array('parameter'=>'gomobile_account_id'));
//echo $gomobile_accountid_model->value;

?>
<form action="index.php?r=gomobile/default/accountsetupview" method="post">
Account ID: <input type="text" name="account_id" value=<?php echo $gomobile_accountid_model->value;?> >
<br>
<input type="hidden" name="advance_parameter_id" value=<?php echo $gomobile_accountid_model->id;?> >

<input type="submit">
</form>
