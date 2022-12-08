<?php

include ("model.php");

//$register = New Model();
//$register->save ($_POST,"user","id_user");

$model = New Model();

$sql = "SELECT * FROM `user` WHERE email_user ='".$_POST['email_user']."' AND pswd_user ='".$_POST['pswd_user']."'";
print_r ($_POST);
print_r ("<br>");
print_r ($sql."<br>");

$monuser = $model->findfromreq ($sql);
//echo('***AVANT_MONUSER***<br>');
print_r($monuser);
//echo('***APRES_MONUSER**<br>');

if (count($monuser) == 1) {
    header("Location: ../pages/index.php");
    //echo (count($monuser));
}
else{
    header("Location: ../pages/login.php");
    //echo ("COUNT PAS BON");
}

?>
