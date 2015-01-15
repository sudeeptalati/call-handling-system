<?php include('gomobile_menu.php'); ?>  
 Account ID :
<?php
echo $gomobile_account_id;
?>
<br>
<form action="index.php?r=gomobile/default/setaccountid" method="post">
<input name="Edit" value="Edit" type="submit">

</form>