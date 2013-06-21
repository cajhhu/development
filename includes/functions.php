<?php
//The following function is reused under the GFDL and taken from the English Wikipedia Unblock Ticket Request System
function loggedIn() {
   if (!isset($_SESSION)) { 
      session_name('SysLogin');
      session_start();
   }

   if (isset($_SESSION['logged_in_id']) && isset($_SESSION['logged_in_password'])) {
      // presumably good, but confirming that the cookie is valid...
      $user = $_SESSION['logged_in_id'];
      $password = $_SESSION['logged_in_password'];
      $db = connectToDB(true);

      $query = $db->prepare('
         SELECT person_id FROM Person
         WHERE person_id = :person_id
         AND person_password = :passwordHash');

      $result = $query->execute(array(
         ':person_id' => $user,
         ':passwordHash' => $password));

      if ($result === false) {
         $error = var_export($query->errorInfo(), true);
         debug('ERROR: ' . $error . '<br/>');
      }

      $data = $query->fetch(PDO::FETCH_ASSOC);
      $query->closeCursor();

      if ($data !== false) {
         return true;
      }
   }
   return false;
}

//The following function is reused under the GFDL and taken from the English Wikipedia Unblock Ticket Request System
function verifyLogin($destination = 'index'){
   if(!loggedIn()){
      header("Location: " . getRootURL() . '/index.php?page=login&destination=' . $destination);
      exit;
   } else {
      return true;
   }
}

function debug($message) {
   if ($SHOW_DEBUG == true) {
      echo $message;
   }
}

function getRootURL() {
   return "http://bms-dev.no-ip.org/bms";
}

function system_error($error) {

   global $bms;

   $bms->template->body = new Template("includes/error.tpl");
   $bms->template->body->setValues(array(
      "error"     =>    $error));
}
