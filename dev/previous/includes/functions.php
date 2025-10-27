<?php
// This file is the place to store all basic functions.

function mysql_prep($value) {
$magic_quotes_active = get_magic_quotes_gpc();
$new_enough_php = function_exists( "mysql_real_escape_string") ; //ie. PHP >= 4.3.0
if ($new_enough_php) {
//undo any magic quote effects so mysql_real_escape_string can do the work
	if ($magic_quotes_active) { $value = stripslashes( $value );}
	$value = mysql_real_escape_string( $value );
} else { // before PP v4.3.0
// is magic quotes aren't already on then add slashes manually
	if (!magic_quotes_active ) { $value = addslashes( $value); }
	// if magic quotes are active, then the slashes already exist 
	}
	return $value;
}

//redirect
function redirect_to($location) {
 if($location != NULL) {
 header("Location: {$location}");
 exit;
 }
}

//confirm query
function confirm_query($result_set) {
	if(!$result_set){
		die("Database query failed: " . mysql_error());
	}
}

function get_all_participants_en() {
global $connection;
$query = "SELECT *
		FROM archive_fairytale  
		ORDER BY id ASC";
$participants_set = mysql_query($query, $connection);
confirm_query($participants_set);
return $participants_set;
}

function select_participants_filter($option) {
global $connection;
  $query="SELECT DISTINCT {$option} FROM archive_fairytale";
  $result=mysql_query($query, $connection);
  $options="";
  confirm_query($result);
  while ($row=mysql_fetch_array($result)) {
  
  	$id=$row["{$option}"];
  	$returnedoptions=$row["{$option}"];

  	$options.="<OPTION VALUE=\"$id\">".$returnedoptions.'</option>';
  }
    	return $options;
} 

function get_participant_quote($id) {
global $connection;
$query = "SELECT *
		FROM archive_fairytale  
		WHERE id = {$id}";
$quote_set = mysql_query($query, $connection);
confirm_query($quote_set);
return $quote_set;
}


function get_all_participants_filter($filter_id, $filter_value) {
global $connection;
$query = "SELECT *
		FROM archive_fairytale  
		WHERE {$filter_id} = {$filter_value}
		ORDER BY id ASC";
$participants_set = mysql_query($query, $connection);
echo $query;
confirm_query($participants_set);
return $participants_set;
}

?>