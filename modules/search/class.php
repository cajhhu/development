<?php

class Search {
   
   
   public function __construct($type = 'full') {
      
      global $bms;
      
      if ($type == 'full') {
         $bms->template->body = new Template("modules/search/full_results.tpl");
      } else {
         $bms->template->body = new Template("modules/search/ajax_results.tpl");
      }
      
      return $this;
   }
   
   public function search($modules, $term) {
      
      //Get the item ids that this user can search on
      global $bms;
      $perms = $bms->me->can_search($modules);

      $sql = "";
      
      $db = ConnectToDB();
      
      $result_array = array();
      
      foreach($perms as $type => $items) {

         $id = $type . "_id";
         $name = $this->getObjectName($type);
         $module = chr(34) . $type . chr(34);
         $columns = $this->getColumns($type);

         $sql .= "\nSELECT " . $id . " as 'id', " . $module . " as 'module', " . $name . " as 'name'";

         foreach ($columns['view'] as $view) {
            $sql .= ", " . $view;
         }

         $sql .= " FROM " . $type . " WHERE";
            
         if (!$bms->me->can("System_hasAdmin") && !$bms->me->can("System_UsersAdmin")) {
            $sql .= " " . $type . "_id IN (" . implode(",", $items) . ") AND ";
         }
         
         $sql .= " (0 ";
            
         foreach ($columns['where'] as $column) {
               $sql .= " OR " . $column . " LIKE :search_term";
         }
            
         $sql .= ");\nUNION ALL";
      }

      $sql = substr($sql, 0, -9);

      if ($GLOBALS['debug']) {
         echo $sql;
      }

      $query = $db->prepare($sql);

      $query->execute(array(
            ":search_term"    =>    "%" . $term . "%"));
            
      $i = 0;

      $total_column = $query->columnCount();

      for ($counter = 0; $counter <= $total_column - 1; $counter++) {
         $meta = $query->getColumnMeta($counter);
         $returned_columns[] = $meta['name'];
      }

      while($value = $query->fetch()) {
         $i++;
         $result_array[$i]['row'] = (($i%2)==1) ? 'odd' : 'even';
         foreach ($returned_columns as $column) {
            $result_array[$i][$column] = $value[$column];
         }
      }
      
      return array("columns" => $returned_columns, "results" => $result_array);
      
   }
   
   public function getColumns($table = '') {
      
         $columns = array();
         $views = array();
      
         $db = ConnectToDB();
         
         $query = $db->prepare("
               SELECT search_column, search_display_title, search_search, search_display
               FROM Search_columns
               WHERE search_table = :table
               ORDER BY search_order;");
               
         $query->execute(array(
               ":table"       =>       $table));
         
         while ($data = $query->fetch()) {
            if ($data['search_search'] == 1) {
               array_push($columns, $data['search_column']);
            }
            if ($data['search_display'] == 1) {
               array_push($views, $data['search_column'] . " as '" . $data['search_display_title'] . "'");
            }
         }
         
         return array("view" => $views, "where" => $columns);
   }
   
   public function getObjectName($table = '') {

         $db = ConnectToDB();
         
         $query = $db->prepare("
               SELECT search_object
               FROM Search_objects
               WHERE search_table = :table");
               
         
         $query->execute(array(
               ":table"       =>       $table));
            
         if ($data = $query->fetch()) {
            return $data['search_object'];
         }
      
   }

   public function getHeaderColumns($columns) {

      $formatted_columns = Array();

      foreach ($columns as $column) {
         if ($column != "id" && $column != "module") {
            array_push($formatted_columns, array("column" => ucwords(strtolower($column))));
         }
      }

      return $formatted_columns;
   }

   public function getFormattedColumns($columns) {

      $formatted_columns = Array();

      foreach ($columns as $column) {
         if ($column != "id" && $column != "module") {
            if ($column == "name") {
               $column = "<a href='{base_url}/index.php?page={module}&action=view&id={id}'>{name}</a>";
            } else {
               $column = "{" . (string)$column . "}";
            }
            array_push($formatted_columns, array("column" => $column));
         }
      }

      return $formatted_columns;
   }
}
