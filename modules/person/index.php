<?php

verifyLogin('login');

global $bms;

//get action
$action = (isset($_GET['action'])) ? $_GET['action'] : "index";

switch ($action) {
   //Submit data (usually jQuery)
   case "submit":
   break;
   
   //Create/view a user
   case "create":
   case "view":

      //Get id
      $person_id = (isset($_GET['id'])) ? $_GET['id'] : $_SESSION['person_id'];

      //Test read permissions
      if ($bms->me->can("System_hasAdmin")
         || $bms->me->can("System_UsersAdmin")
         || $bms->me->can("Person_" . $person_id . "_Read")
         || $bms->me->can("Person_" . $person_id . "_Write")) {

         //Create body template
         $bms->template->body = new Template("modules/person/template.tpl");

         //Create person object
         $person = new Person($person_id);

         //Get a list of actions
         $actions = Array();
         //Users with write permission
         if ($bms->me->can("System_hasAdmin") || $bms->me->can("System_UsersAdmin") || $bms->me->can("Person_" . $person_id . "_Write")) {
            array_push($actions, array("action" => "<a href=\"index.php?page=Person&action=modify&id=" . $person_id . "\">Modify User</a><br>"));
         }

         array_push($actions, array("action" => "<a href=\"index.php?page=Email&action=text&id=" . $person_id . "\">Text User</a><br>"));
         array_push($actions, array("action" => "<a href=\"index.php?page=Person&id=" . $person_id . "#Associates\">Associates</a><br>"));
         array_push($actions, array("action" => "<a href=\"index.php?page=Person&id=" . $person_id . "#Tasks\">Tasks</a><br>"));
         array_push($actions, array("action" => "<a href=\"index.php?page=Person&action=modify&id=" . $person_id . "\">Get Directions</a><br>"));

         if ($bms->me->can("System_hasAdmin") || $bms->me->can("System_UsersAdmin")) {
            array_push($actions, array("action" => "<a href=\"index.php?page=Permissions&action=update&id=" . $person_id . "\">Update Permission</a><br>"));
         }

         array_push($actions, array("action" => "<a href=\"index.php?page=email&id=" . $person_id . "\">Email User(s)</a><br>"));

         if ($bms->me->can("System_hasAdmin") || $bms->me->can("System_UsersAdmin")) {
            array_push($actions, array("action" => "<a href=\"index.php?page=Person&action=delete&id=" . $person_id . "\">Delete User</a>"));
         }

         $bms->template->body->setValues(array(
                  "loop:actions"                =>    $actions,
                  "person_id"                   =>    $person_id,
                  "person_username"             =>    $person->get_Username(),
                  "person_password_attempts"    =>    $person->get_Password_Details()->attempts,
                  "person_last_attempt"         =>    $person->get_Password_Details()->last_attempt,
                  "person_created"              =>    $person->get_Created(),
                  "person_enabled"              =>    $person->get_Enabled(),
                  "person_firstname"            =>    $person->get_Name()->firstname,
                  "person_lastname"             =>    $person->get_Name()->lastname,
                  "person_mobile"               =>    $person->get_Contact_Details()->mobile,
                  "person_home"                 =>    $person->get_Contact_Details()->home,
                  "person_email"                =>    $person->get_Contact_Details()->email,
                  "person_address"              =>    $person->get_Address_Details()->street,
                  "person_city"                 =>    $person->get_Address_Details()->city,
                  "person_state"                =>    $person->get_Address_Details()->state,
                  "person_zip"                  =>    $person->get_Address_Details()->zip,
                  "person_recommended"          =>    $person->get_Recommended(),
                  "person_adverttype"           =>    $person->get_AdvertType()));

         //Get Hooks
         $sql = "SELECT module_name FROM Modules WHERE module_name LIKE :module AND module_enabled = 1 ORDER BY module_hook_order;";

         $db = connectToDB(true);

         $query = $db->prepare($sql);

         $result = $query->execute(array(
            ':module' => "person_hook_%"));

         while ($module = $query->fetch()) {
            include("modules/person/" . $module['module_name'] . ".php");
         }
      } else {
         system_error("You are not authorized to view this profile");
      }
   break;
   
   //Search/home
   case "index":
   default:
   
      //Grab template lib  
      
      //Construct template
      $bms->template->body = new Template("modules/person/search.tpl");
      
}
   
