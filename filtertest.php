<?php require_once("includes/functions.php") ?>
<?php require_once("includes/connection.php") ?>
<?php require_once("includes/sessioninfo.php") ?>
<?php 
$w=array();
function get_new_participants_filter_test(){ 
	global $connection;
	global $w;
	global $w2;
	global $w3;

	if (!empty($_SESSION['gender']) && (($_SESSION['gender']) != "0")) { $w[]="f.participant_gender= '".$_SESSION['gender']."'";}
	if (!empty($_SESSION['year']) && (($_SESSION['year']) != '0')) { $w[]="f.participant_year >= '".($_SESSION['year']-9)."' AND f.participant_year <= '".$_SESSION['year']."'";}
	
	
	
	if (!empty($_SESSION['region']) && (($_SESSION['region']) != '0')) { $w[]="f.participant_region = '".$_SESSION['region']."'";}
	
	
	

if (!empty($_SESSION['language'])) {
    if (($_SESSION['language']) == 'Chinese') { $w2="ch.participant_number = f.participant_number AND ((ch.application_active = 'yes') OR (ch.interview_active = 'yes') OR (ch.interview_2_active = 'yes'))";}
	if (($_SESSION['language']) == 'Chinese + English') { $w2="ch.participant_number = f.participant_number AND en.participant_number = f.participant_number AND ((ch.application_active = 'yes' AND en.application_active = 'yes') OR (ch.interview_active = 'yes' AND en.interview_active = 'yes') OR (ch.interview_2_active = 'yes' AND en.interview_2_active = 'yes'))";}
	if (($_SESSION['language']) == 'Chinese + German') { $w2="ch.participant_number = f.participant_number AND de.participant_number = f.participant_number AND ((ch.application_active = 'yes' AND de.application_active = 'yes') OR (ch.interview_active = 'yes' AND de.interview_active = 'yes') OR (ch.interview_2_active = 'yes' AND de.interview_2_active = 'yes'))";}
	if (($_SESSION['language']) == 'Chinese + English + German') { $w2="en.participant_number = f.participant_number AND ch.participant_number = f.participant_number AND de.participant_number = f.participant_number AND ((ch.application_active = 'yes' AND de.application_active = 'yes' AND en.application_active = 'yes') OR (ch.interview_active = 'yes' AND de.interview_active = 'yes' AND en.interview_active = 'yes') OR (ch.interview_2_active = 'yes' AND de.interview_2_active = 'yes' AND en.interview_2_active = 'yes'))";}
}

	if (!empty($_SESSION['tag']) && (($_SESSION['tag']) != '0')) { $w[] ="f.themes LIKE '%,".$_SESSION['tag'].",%'";	}





	

// print_r($w);
	$where ="";
	if (count($w)) {
	$where= implode(' AND ',$w);
	}


if (!empty($_SESSION)) {
	$query="SELECT f.id FROM fairytale_main AS f";
	
	if (!empty($w2)) {
	$query.= ", fairytale_chinese AS ch ";
		if (($_SESSION['language']) == 'Chinese + English') { 
		$query.= ", fairytale_english as en ";
		}
		if (($_SESSION['language']) == 'Chinese + German') { 
		$query.= ", fairytale_german as de ";
		}
		if (($_SESSION['language']) == 'Chinese + English + German') { 
		$query.= ", fairytale_english as en, fairytale_german as de ";
		}
	$query .= " WHERE ".$w2;
	
		if (!empty($w)) { 
			$query .= " AND ". $where;
		}
		if (!empty($w3)) { 
			$query .= " AND ". $w3;
		}
	}
	
	else if (!empty($w)) { 
	$query .= " WHERE ". $where;
			if (!empty($w3)) { 
			$query .= " AND ". $w3;
			}
	}
	
	else if (!empty($w3)) {
	$query .= " WHERE ". $w3;
		if (!empty($w)) { 
		$query .= " AND ". $where;
		}
	}
	
	
	$query .= " LIMIT 1001";
	
//	}
	
	
	
	
	//echo $query;
	$new_participants_set = mysql_query($query, $connection);
	confirm_query($new_participants_set);
	return $new_participants_set; 
	
	
}



/*
	if (!empty($_SESSION['region']) && (($_POST['province']) != '0')) {
	$query="SELECT fairytale_main.id FROM fairytale_main, regions $where";
	$new_participants_set = mysql_query($query, $connection);
	confirm_query($new_participants_set);
	return $new_participants_set;
	}
	
	if (!empty($_SESSION['language']) && (($_POST['participant_lang']) == 'Chinese')) { 
	$query="SELECT fairytale_main.id FROM fairytale_main, fairytale_chinese $where";
	$new_participants_set = mysql_query($query, $connection);
	confirm_query($new_participants_set);
	return $new_participants_set;
	}

	
	else {
	$query="SELECT id FROM fairytale_main $where";
	$new_participants_set = mysql_query($query, $connection);
	confirm_query($new_participants_set);
	return $new_participants_set;
	}
	*/
	
	
/*	
//test
	if (!empty($_SESSION['language']) && (($_POST['participant_lang']) != '0')) {
	$query="SELECT fairytale_main.id FROM fairytale_main, fairytale_chinese, fairytale_english, fairytale_german, regions $where quick";
	$new_participants_set = mysql_query($query, $connection);
	confirm_query($new_participants_set);
	return $new_participants_set; 
} 
*/
}

$new_participants_set = get_new_participants_filter_test();
if ( (!empty($_SESSION)) && (count($w)) || (count($w2))  ) {
	$idarray = array();
		while ( $participant = mysql_fetch_array($new_participants_set)) { 
		$id = $participant["id"];
		$idarray[] = $participant["id"];
		echo '<script>';
		echo "$(document).ready(function() {";
  		echo "$('#picid-".$id."').removeClass('inactive').addClass('active');";
  		echo "$('#id-".$id."').removeClass('inactive1').addClass('active1');";
  		echo " });";
  		echo '</script>';
		}
		
		};

// && (count($w)) || (count($w2)) 
?>

