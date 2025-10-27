<?php require_once("includes/functions.php") ?>
<?php require_once("includes/connection.php") ?>
<?php  require_once("includes/sessioninfo.php") ?>

<?
ob_start();//for debugging 

$w=array();
function get_new_participants_filter_test(){ 
	global $connection;
	global $w;
	global $w2;
	global $w3;

	if (!empty($_SESSION['gender']) && (($_POST['gender']) != "0")) { 
	  $w[]="f.participant_gender= '".$_SESSION['gender']."'";
	}
	if (!empty($_SESSION['year']) && (($_POST['generation']) != '0')) { 
	  $w[]="f.participant_year >= '".($_SESSION['year']-9)."' AND f.participant_year <= '".$_SESSION['year']."'";
	}
	if (!empty($_SESSION['region']) && (($_SESSION['region']) != '0')) { $w[]="f.participant_region = '".$_SESSION['region']."'";}


if (!empty($_SESSION['language'])) {
    if (($_SESSION['language']) == 'Chinese') { $w2="ch.participant_number = f.participant_number AND (ch.application_active = 'yes') OR (ch.interview_active = 'yes') OR (ch.interview_2_active = 'yes')";}
	if (($_SESSION['language']) == 'Chinese + English') { $w2="ch.participant_number = f.participant_number AND en.participant_number = f.participant_number AND (ch.application_active = 'yes' AND en.application_active = 'yes') OR (ch.interview_active = 'yes' AND en.interview_active = 'yes') OR (ch.interview_2_active = 'yes' AND en.interview_2_active = 'yes')";}
	if (($_SESSION['language']) == 'Chinese + German') { $w2="ch.participant_number = f.participant_number AND de.participant_number = f.participant_number AND (ch.application_active = 'yes' AND de.application_active = 'yes') OR (ch.interview_active = 'yes' AND de.interview_active = 'yes') OR (ch.interview_2_active = 'yes' AND de.interview_2_active = 'yes')";}
	if (($_SESSION['language']) == 'Chinese + English + German') { $w2="en.participant_number = f.participant_number AND ch.participant_number = f.participant_number AND de.participant_number = f.participant_number AND (ch.application_active = 'yes' AND de.application_active = 'yes' AND en.application_active = 'yes') OR (ch.interview_active = 'yes' AND de.interview_active = 'yes' AND en.interview_active = 'yes') OR (ch.interview_2_active = 'yes' AND de.interview_2_active = 'yes' AND en.interview_2_active = 'yes')";}
}


	if (!empty($_SESSION['tag']) && (($_SESSION['tag']) != '0')) { $w[] ="f.themes LIKE '%,".$_SESSION['tag'].",%'";	}

	

// print_r($w);
	$where ="";
	if (count($w)) {
	$where= implode(' AND ',$w);
	}


if (!empty($_SESSION)) {
	$query="SELECT f.id, f.participant_name, f.participant_photo, r.Participant_Latitude, r.Participant_Longitude FROM fairytale_main AS f INNER JOIN regions AS r ON f.participant_region = r.id";
	
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
	$query .= ", themes AS t WHERE". $w3;
		if (!empty($w)) { 
		$query .= " AND ". $where;
		}
	}
	
	
	$query .= " LIMIT 6001";
	}
	
	
	
//	$query="SELECT fairytale_main.id, fairytale_main.participant_name, fairytale_main.participant_photo, regions.Participant_Latitude, regions.Participant_Longitude FROM fairytale_main, regions WHERE fairytale_main.participant_region = regions.id $where";
	$new_participants_set = mysql_query($query, $connection);
	confirm_query($new_participants_set);
	return $new_participants_set;
}


$new_participants_set = get_new_participants_filter_test();
$json = array();

 while ($row = mysql_fetch_array($new_participants_set)){
    $bus = array(
        'latitude' => substr($row['Participant_Latitude'], 0, 3) . rand(0,999999),
        'longitude' => substr($row['Participant_Longitude'], 0, 4) . rand(0,999999),
        'name' => $row['participant_name'],
        'icon' => get_participant_portrait_small($row['id']),
        'id' => $row['id']
    );
    array_push($json, $bus);
}




$jsonstring = json_encode($json);
//echo json_encode(array('data' => $json));

// echo "$jsonstring";


/* save comment to file */
$markerDataFile = 'markers.json';
file_put_contents($markerDataFile, $jsonstring);
echo $jsonstring;
