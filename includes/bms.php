<?php

class bms {

   public $template;
   public $me;

   public function __construct() {
      $template = (object)array("header" => NULL, "body" => NULL, "footer" => NULL);
   }
}
