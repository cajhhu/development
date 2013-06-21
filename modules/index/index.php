<?php

verifyLogin('login');

global $bms;
$bms->template->body = new Template("modules/index/index.tpl");


?>
