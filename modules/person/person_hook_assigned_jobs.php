<?


//Get jobs that the viewing user has permission to see
$sql = "SELECT job_id, job_title, job_type, job_date, job_time, job_city, job_state FROM Job j, Relations r
   WHERE r.parent_module_name =  'Person'
   AND r.child_module_name    =  'Job'
   AND r.parent_module_id     =  :person_id
   AND r.child_module_id      =  j.job_id";
   if (!$bms->me->can("System_hasAdmin")) {
      $items = $bms->me->can_search("Job");
      $sql .= " AND job_id IN (" . implode(",", $items["Job"]) . ")";
   }
   $sql .= " ORDER BY job_date DESC, job_time DESC;";

$query = $db->prepare($sql);

$query->execute(array(
   ":person_id"   => $person_id));

//Build column array
$i = 0;

$total_column = $query->columnCount();
$result_array;

for ($counter = 0; $counter <= $total_column - 1; $counter++) {
 $meta = $query->getColumnMeta($counter);
 $returned_columns[] = $meta['name'];
}

//Build results array
while($value = $query->fetch()) {
 $i++;
 $result_array[$i]['row'] = (($i%2)==1) ? 'odd' : 'even';
 foreach ($returned_columns as $column) {
    $result_array[$i][$column] = $value[$column];
 }
}

//Build actions array
$actions = Array();

if ($bms->me->can("System_hasAdmin") || $bms->me->can("Person_" . $person_id . "_Write")) {
   array_push($actions, array("action" => "<a href=\"/index.php?page=job&action=add\">Add Job</a>"));
}

//Send it to the template object and append it to the body
if (isset($result_array) && is_array($result_array) ) {
   $bms->template->body->append_Template("modules/person/person_hook_assigned_jobs.tpl", array(
      "loop:actions"    =>    $actions,
      "base_url"        =>    getRootURL(),
      "loop:jobs"       =>    $result_array));
}
