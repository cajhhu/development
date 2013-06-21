<?

$_GLOBALS['ME'] = null;
$_SESSION['person_id'] = null;
$_SESSION['person_password'] = null;
session_destroy();

$bms->body = new Template("modules/logout/logout.tpl");

?>