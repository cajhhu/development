<?php

session_start();

//Error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);

$GLOBALS['debug'] = false;

//Includes
require("includes/bms.php");

//Create bms object
$bms = new bms();

require("includes/database.php");
require("includes/functions.php");
require("modules/person/class.php");
require("includes/templates.php");


//Set a single object for the logged in user
if (isset($_SESSION['logged_in_id'])) {
   $bms->me = new Person($_SESSION['logged_in_id']);
}

//Grab page
$page = (isset($_GET['page'])) ? $_GET['page'] : "index";

//determine module

$db = ConnectToDB();

//Header
if (!isset($_POST['resp']) || $_POST['resp'] != 'ajax') {
   $bms->template->header = new Template("header.tpl");

   $navigation = array("loop:navigation" => array());

   if (isset($bms->me) && ($bms->me->can('System_hasAdmin') || $bms->me->can('System_UsersAdmin'))) {
      array_push($navigation["loop:navigation"], array("module" => "Person",    "title" => "Clients"));
   }
   if (isset($bms->me) && ($bms->me->has_any('job'))) {
      array_push($navigation["loop:navigation"], array("module" => "Job",       "title" => "Jobs"));
   }
   if (isset($bms->me) && ($bms->me->has_any('task'))) {
      array_push($navigation["loop:navigation"], array("module" => "Task",      "title" => "Tasks"));

   }
   if (isset($bms->me) && ($bms->me->has_any('gallery'))) {
      array_push($navigation["loop:navigation"], array("module" => "Gallery",   "title" => "Gallery"));
   }
   if (isset($bms->me) && ($bms->me->can('System_hasAdmin'))) {
      array_push($navigation["loop:navigation"], array("module" => "Email",     "title" => "Mass Email"));
   }
   if (isset($bms->me)) {
      array_push($navigation["loop:navigation"], array("module" => "Logout",    "title" => "Logout"));
   }

   $bms->template->header->setValues($navigation);

}
//Grab all of the modules

$query = $db->prepare("
            SELECT module_name
            FROM Modules
            WHERE module_name = :module_name;");
            
$query->execute(array(
            ':module_name'    =>    $page));
      
   
if ($data = $query->fetch()) {
   require("modules/" . $data['module_name'] . "/index.php");
} else {
   require("modules/index/index.php");
}

//Footer
if (!isset($_POST['resp']) || $_POST['resp'] != 'ajax') {
   $bms->template->footer = new Template("footer.tpl");

}

if (!isset($_POST['resp']) || $_POST['resp'] != 'ajax') {
   $bms->template->header->flush_template();
}

$bms->template->body->flush_template();

if (!isset($_POST['resp']) || $_POST['resp'] != 'ajax') {
   $bms->template->footer->flush_template();
}

?>
