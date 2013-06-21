<?php


$error = "";   
global $bms;
$bms->template->body = new Template("modules/login/login_header.tpl");
   
IF (isset($_POST['username']) && isset($_POST['password'])) {
   //POST FUNCTIONS
   
   $username = trim(strtolower($_POST['username']));
   $password = trim($_POST['password']);  
   
   if ($username == "" || $password == "") {
      $error = "Username or password blank";
   } else {
   
      //Check if username exists and get password salt
      $query = $db->prepare("
            SELECT person_password_salt
            FROM Person
            WHERE person_username = :username
            LIMIT 0,1;");
            
      $query->execute(array(
            ":username"    =>    $username));

      //Username exists    
      if ($data = $query->fetch()) {

         //Generate encrypted password
         $password = md5(md5($password) . $data['person_password_salt']);  
         
         $query = $db->prepare("
               SELECT person_id
               FROM Person
               WHERE person_password = :password
               LIMIT 0,1;");
               
         $query->execute(array(
               ":password"    =>    $password));
                        
         if ($data = $query->fetch()) {
            $_SESSION['logged_in_id'] = $data['person_id'];
            $_SESSION['logged_in_password'] = $password;
            $destination = (isset($_GET['destination'])) ? $_GET['destination'] : 'index';
            header("Location: " . getRootURL() . '/index.php?page=' . $destination);
            exit;
         }  else {
            $error = "Invalid password";
         }
      } else {
         $error = "Username does not exist!";
      }
   }
   
}

//LOGIN FORM
$bms->template->body->append_Template("modules/login/login_box.tpl");

