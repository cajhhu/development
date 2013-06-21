<?php
   
$db;  

function ConnectToDB() {   

   $DATABASE_HOST = "localhost";
   $DATABASE_USER = "";
   $DATABASE_PASS = "";
   $DATABASE_NAME = "";
   
   $db = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME, $DATABASE_USER, $DATABASE_PASS, array(PDO::ATTR_PERSISTENT => true));

   return $db;
}
   
?>
