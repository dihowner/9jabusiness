<?php
require "action.php"; $action = new Action();


if($action->sendmail("Test Mail", "9jaBus@9jaway.com", "oluwatayoadeyemi@yahoo.com", "Hi, this is a test")) {
// if(mail("oluwatayoadeyemi@yahoo.com", "Test Mail", "Hi, this is a test")) {
   echo "Sent";
} else {
    echo "Error";
}

?>