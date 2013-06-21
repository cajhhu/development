<?php

class Template {
   
   private $template_data;
   
   public function __construct($file_path = NULL) {
      if ($file_path == NULL) {
         die("Template not specified");
      }
      
      $this->template_data = file_get_contents($file_path);    //Load file contents into string    
      
   }
   
   public function setValues($valArray) {
      //Two parts to this function.  They are split into two parts because I want to check
      //the entire template for loops and fill those out before I go back and do my other
      //variables

      $startstring;     //Part before the loop     
      $loopstring;         //The looped content itself
      $endstring;       //The part after the loop.
      $i=0;

      //Parse loops first

      foreach ($valArray as $loop => $subarray) {
         if (substr($loop, 0, 4) == "loop") {      
            
            $start = strpos($this->template_data, "{" . $loop . "}");
            $mid = strpos($this->template_data, "{/" . $loop . "}"); 
            $end = strpos($this->template_data, "{/" . $loop . "}");                   
            
            $startstring   =     substr($this->template_data, 0, strpos($this->template_data, "{" . $loop . "}"));
            $loopstring    =     substr($this->template_data, strpos($this->template_data, "{" . $loop . "}") + 2 + strlen($loop));
            $loopstring    =     substr($this->template_data, strpos($this->template_data, "{" . $loop . "}") + 2 + strlen($loop), strpos($loopstring, "{/" . $loop . "}"));
            $endstring     =     substr($this->template_data, strpos($this->template_data, "{/" . $loop . "}") + 3 + strlen($loop));
   
            
            foreach ($subarray as $row) {

               $rowstring = $loopstring;

               foreach ($row as $column => $value) {
                  $rowstring = str_replace("{" . $column . "}", $value, $rowstring);
               }

               $startstring .= $rowstring;
            }
            $this->template_data = $startstring . $endstring;
         }
      }

      //Parse non-loops
      
      foreach ($valArray as $key => $value) {
         if (substr($key, 0, 4) != "loop") {
            $this->template_data = str_replace("{" . $key . "}", $value, $this->template_data);
         }
      }

   }

   public function flush_template() {
      echo $this->template_data;
   }
   
   public function get_template_data() {
   	return $this->template_data;
   }
   
   public function append_template($file_path = NULL, $valArray = NULL) {
   	$new_template = new Template($file_path);
   	if (is_array($valArray)) {
         	$new_template->setValues($valArray);
        }
   	$this->template_data = $this->template_data . $new_template->get_template_data();
   	unset($new_template);

   }
}
