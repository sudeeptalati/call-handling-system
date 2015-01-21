<?php include('gomobile_menu.php');
?>
Account ID:<br>


<form action="index.php?r=gomobile/default/setaccountid" method="post">
<input type="text" name="gomobile_account_id" value="<?php echo $gomobile_account_id;?>">
<input name="save_gomobile_account_id" value="Edit" type="submit">
</form>