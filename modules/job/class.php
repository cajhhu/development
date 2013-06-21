<?php

require_once("modules/person/class.php");

class Job {


   protected   $job_id;

   //Account details
   private     $job_title;
   private     $job_type;
   private     $job_description;
   private     $job_date;
   private     $job_time;
   private     $job_names;
   private     $job_address;
   private     $job_city;
   private     $job_state;
   private     $job_zip;
   private     $job_discount;
   private     $job_status;

   //STATUSES
   protected static $STATUS_ACTIVE           =  1;

   protected static $STATUS_COMPLETE         =  2;

   protected static $STATUS_IN_PROGRESS      =  3;

   protected static $STATUS_ON_HOLD          =  4;

   protected static $STATUS_AWAITING_CLIENT  =  5;

   //Construct
   public function __construct($job_id) {

      $db = ConnectToDB();

      $query = $db->prepare("SELECT * FROM Job j, Person p, Relations r
      		WHERE r.Parent_module_name = 'Person'
      		AND r.Parent_module_id = p.person_id
      		AND r.Child_module_name = 'Job'
      		AND r.Child_module_id = j.job_id
      		AND job_id = :job_id;");

      $query->execute(array(
            ":job_id"   =>    $job_id));

      if ($data = $query->fetch()) {

         //Assign vars
         $this->job_id			=	$job_id;
         $this->job_title		=	$data['job_title'];
         $this->job_type		=	$data['job_type'];
         $this->job_description		=	$data['job_description'];
         $this->job_date		=	$data['job_date'];
         $this->job_time		=	$data['job_time'];
         $this->job_names		=	$data['job_names'];
         $this->job_address		=	$data['job_address'];
         $this->job_city		=	$data['job_city'];
         $this->job_state		=	$data['job_state'];
         $this->job_zip			=	$data['job_zip'];
         $this->job_discount		=	$data['job_discount'];
         $this->job_status		=	$data['job_status'];
         $this->job_poc			=	new Person($data, true);

         return $this;
      }
   }

   public function getTitle() {
      return $this->job_title;
   }

   public function getId() {
      return $this->job_id;
   }

   public function getType() {
      return $this->job_type;
   }

   public function getDescription() {
      return $this->job_description;
   }

   public function getDate() {
      return $this->job_date;
   }

   public function getTime() {
      return $this->job_time;
   }

   public function getNames() {
      return $this->job_names;
   }

   public function getAddress() {
      return $this->job_address;
   }

   public function getCity() {
      return $this->job_city;
   }

   public function getState() {
      return $this->job_state;
   }

   public function getZip() {
      return $this->job_zip;
   }

   public function getDiscount() {
      return $this->job_discount;
   }

   public function getStatus() {
      return $this->job_status;
   }
   
   public function getPOC() {
   	return "<a href=\"index.php?page=person&action=view&id=" . $this->job_poc->get_ID() . "\">" . $this->job_poc->get_Name()->name . "</a>";
   }

   public function getFormattedStatus() {
	switch($this->job_status) {
		case "5":
			return "Awaiting Client";
		break;
		case "4":
			return "On Hold";
		break;
		case "3":
			return "In Progress";
		break;
		case "2":
			return "Completed";
		break;
		case "1":
			return "Active";
		break;
		default:
			return "Unknown";
	}
   }
}

