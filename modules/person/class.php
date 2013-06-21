<?php

class Person {

   protected   $person_id;

   //Account details
   protected   $person_username;
   private     $person_password;
   private     $person_password_salt;
   protected   $person_password_attempts;
   protected   $person_last_attempt;
   protected   $person_created;
   protected   $person_permissions;
   protected   $person_enabled;
   
   //Information
   protected   $person_firstname;
   protected   $person_lastname;

   //Contacts  
   protected   $person_mobile;         //Mobile phone
   protected   $person_home;           //Home phone
   protected   $person_email;          //Email address
   
   //Address
   protected   $person_address;
   protected   $person_city;
   protected   $person_state;
   protected   $person_zip;
   
   //Misc
   protected   $person_recommended;    //who recommended them
   protected   $person_adverttype;     //type of advertisement that got their attention


   public function __construct() {
       $a = func_get_args();
       $i = func_num_args();
       if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this,$f),$a);
       }
   }

   public function __construct1($person_id) {
      $db = ConnectToDB();

      $query = $db->prepare("SELECT * FROM Person WHERE person_id = :person_id;");

      $query->execute(array(
            ":person_id"   =>    $person_id));

      if ($data = $query->fetch()) {

         //Assign vars
         $this->person_id                 =     $person_id;
         $this->person_username           =     $data['person_username'];
         $this->person_password           =     $data['person_password'];
         $this->person_password_salt      =     $data['person_password_salt'];
         $this->person_password_attempts  =     $data['person_password_attempts'];
         $this->person_last_attempt       =     $data['person_last_attempt'];
         $this->person_created            =     $data['person_created'];
         $this->person_permissions        =     new Permissions($data['person_permissions']);
         $this->person_enabled            =     (bool)$data['person_enabled'];
         $this->person_firstname          =     $data['person_firstname'];
         $this->person_lastname           =     $data['person_lastname'];
         $this->person_mobile             =     $data['person_mobile'];
         $this->person_home               =     $data['person_home'];
         $this->person_email              =     $data['person_email'];
         $this->person_address            =     $data['person_address'];
         $this->person_city               =     $data['person_city'];
         $this->person_state              =     $data['person_state'];
         $this->person_zip                =     $data['person_zip'];
         $this->person_recommended        =     $data['person_recommended'];
         $this->person_adverttype         =     $data['person_adverttype'];

         return $this;
      }
      
      return null;
      
   }
   
   public function __construct2($data, $from_db) {

         //Assign vars
         $this->person_id                 =     $data['person_id'];
         $this->person_username           =     $data['person_username'];
         $this->person_password           =     $data['person_password'];
         $this->person_password_salt      =     $data['person_password_salt'];
         $this->person_password_attempts  =     $data['person_password_attempts'];
         $this->person_last_attempt       =     $data['person_last_attempt'];
         $this->person_created            =     $data['person_created'];
         $this->person_permissions        =     new Permissions($data['person_permissions']);
         $this->person_enabled            =     (bool)$data['person_enabled'];
         $this->person_firstname          =     $data['person_firstname'];
         $this->person_lastname           =     $data['person_lastname'];
         $this->person_mobile             =     $data['person_mobile'];
         $this->person_home               =     $data['person_home'];
         $this->person_email              =     $data['person_email'];
         $this->person_address            =     $data['person_address'];
         $this->person_city               =     $data['person_city'];
         $this->person_state              =     $data['person_state'];
         $this->person_zip                =     $data['person_zip'];
         $this->person_recommended        =     $data['person_recommended'];
         $this->person_adverttype         =     $data['person_adverttype'];

         return $this;
      
   }
   
   public function get_ID() {
   	return $this->person_id;
   }
   
   public function get_Username() {
      return $this->person_username;
   }
   
   public function get_Password_Details() {
      return (object) array(
         'attempts'        =>    $this->person_password_attempts,
         'last_attempt'    =>    $this->person_last_attempt);
   }
   
   public function get_Contact_Details() {
      return (object) array(
         'mobile'          =>    $this->person_mobile,
         'home'            =>    $this->person_home,
         'email'           =>    $this->person_email);
   }
   
   public function get_Address_Details() {
      return (object) array(
         'street'          =>    $this->person_address,
         'city'            =>    $this->person_city,
         'state'           =>    $this->person_state,
         'zip'             =>    $this->person_zip);
   }
   
   public function get_Name() {
      return (object) array(
         'firstname'       =>    $this->person_firstname,
         'lastname'        =>    $this->person_lastname,
         'name'            =>    $this->person_firstname . " " . $this->person_lastname);
   }
   
   public function get_Created() {
      return $this->person_created;
   }
   
   public function get_AdvertType() {
      return $this->person_adverttype;
   }
   
   public function get_Recommended() {
      return $this->person_recommended;
   }
   
   public function get_Enabled() {
      return (bool)$this->person_enabled;
   }
   
   public function can($perm) {
      return $this->person_permissions->can($perm);
   }
   
   public function can_search($search_types) {
      return $this->person_permissions->can_search($search_types);
   }

   public function has_any($module) {
      return $this->person_permissions->has_any($module);
   }
}

class Permissions {
   protected $hasAdmin;                            //Full system access
   protected $UsersAdmin;                          //Full users access including assigning permissions
   protected $ModulesAdmin;                        //Full Modules permissions including read/write privs to all modules
   protected $ModulePermissions = Array();      //Individual item permissions  [0]Module [1]Item_id [2]Right
   
   public function __construct($perms) {
      
      if ($perms != NULL) {

         $result = unserialize($perms);
         $this->hasAdmin = (bool)$result['hasAdmin'];
         $this->UsersAdmin = (bool)$result['UsersAdmin'];
         $this->ModulesAdmin = (bool)$result['ModulesAdmin'];
         
         foreach($result['ModulePermissions'] as $key => $value) {
            $keys = explode("_", $key);
            $this->ModulePermissions[$keys[0]][$keys[1]][$keys[2]] = $value;
         }  
         
         return $this;
      } else {
         return NULL;
      }
   }
   
   
   // Usage:   $user->can('System_hasAdmin');  OR  $user->can('Person_4_Write');
   public function can($function) {
      $requested_right = explode("_", $function);
      
      if ($requested_right[0] == "System") {
         if ($requested_right[1] == "hasAdmin") {
            if ($this->hasAdmin) {
               return true;
            } else {
               return false;
            }
         } else if ($requested_right[1] == "UsersAdmin") {
            if ($this->UsersAdmin) {
               return true;
            } else {
               return false;
            }
         } else if ($requested_right[1] == "ModulesAdmin") {
            if ($this->Modules_Admin) {
               return true;
            } else {
               return false;
            }
         } else {
            return false;
         }
      } else {
         //0 = Module
         //1 = Item id
         //2 = Right (read/write, etc, it's scalable)
         if (isset($this->ModulePermissions[$requested_right[0]][$requested_right[1]][$requested_right[2]])) {
            if ($this->ModulePermissions[$requested_right[0]][$requested_right[1]][$requested_right[2]]) {
               return true;
            } else {
               return false;
            }
         } else {
            return false;
         }
      }
   }
   
   //Function: can_search()
   //@param: $search_types array()
   //This function returns a list of ids that the user class has permission to
   public function can_search($search_types) {
      if ($search_types) {
               
         $list = array();

         //If the types arn't already an array, convert it to an array so I only have to write the next part once       
         if (!is_array($search_types)) {
            $search_types = array($search_types);  
         }
         
         //Search that module.
         foreach ($search_types as $type) {
            if (!isset($list[$type])) {
               $list[$type] = array();
            }

            //If they have no permissions of this type
            if (isset($this->ModulePermissions[$type])) {
               //Grab the item
               foreach ($this->ModulePermissions[$type] as $key => $value) {
                  //Search each right for that item
                  foreach ($this->ModulePermissions[$type][$key] as $right) {
                     //If any right is true
                     if ($right) {
                        //Push the id
                        array_push($list[$type], $key);
                     }
                  }
               }
            }
         }
         
         
         //Return as array of unique ids.  Because there can be multiple (true) rights per item, the array can have duplicate ids.  No reason to leave them there.
         foreach ($list as $type => $value) {
            $list[$type] = array_unique($list[$type]);
         }
         
         return $list;
         
         
      } else {
         return NULL;
      }
   }

   public function has_any($module) {
      return true;
   }
}
