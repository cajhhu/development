<?php

verifyLogin();

require("modules/search/class.php");

global $bms;

$response_type = (isset($_POST['resp'])) ? $_POST['resp'] : 'full';

$search = new Search($response_type);

$results = $search->search('Person', $_POST['term']);

$bms->template->body->setValues(array(
            "term"            =>       $_POST['term'],
            "loop:headers"    =>       $search->getHeaderColumns($results['columns']),
            "loop:columns"    =>       $search->getFormattedColumns($results['columns']),
            "loop:results"    =>       $results['results'],
            "base_url"        =>       getRootURL()));
            
?>
