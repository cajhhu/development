<?php

verifyLogin('login');
require("modules/job/class.php");
global $bms;

//get action
$action = (isset($_GET['action'])) ? $_GET['action'] : "index";

switch ($action) {
   //Submit data (usually jQuery)
   case "submit":
   break;
   case "view":
   
	$job_id = (isset($_GET['id'])) ? $_GET['id'] : 0;
	
	//Permissions
		//Admin
	if ($bms->me->can("System_hasAdmin")
   		//Can read this job
   		|| $bms->me->can("Job_" . $job_id . "_Read")
   		//Can write to this job
   		|| $bms->me->can("Job_" . $job_id . "_Write")) {
   		
   		
	   	$bms->template->body = new Template("modules/job/job.tpl");
	   	
	   	$job = new Job($job_id);
	   	$bms->template->body->setValues(array(
	   		"job_title"			=>	$job->getTitle(),
	   		"job_formatted_status"		=>	$job->getFormattedStatus(),
	   		"job_description"		=>	$job->getDescription(),
	   		"job_type"			=>	$job->getType(),
	   		"job_date"			=>	$job->getDate(),
	   		"job_time"			=>	$job->getTime(),
	   		"job_address"			=>	$job->getAddress(),
	   		"job_city"			=>	$job->getCity(),
	   		"job_state"			=>	$job->getState(),
	   		"job_zip"			=>	$job->getZip(),
	   		"job_names"			=>	$job->getNames(),
	   		"job_discount"			=>	$job->getDiscount(),
	   		"job_title"			=>	$job->getTitle(),
	   		"job_poc"			=>	$job->getPOC()));
	} else {
		system_error("You are not authorized to view this job.");
	}
         
   break;
   
   //Search/home
   case "index":
   default:
}