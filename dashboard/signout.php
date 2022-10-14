<?php require "../action.php"; $action = new Action();

unset($_COOKIE["username"]);
$_SESSION["logOut"] = true;
$action->redirect_to("../login");
?>