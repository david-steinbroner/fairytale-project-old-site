<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);

session_start();

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



// HEADER FUNCTIONS --------------------------

function meta_tags($tag){
global $connection;
	$query = "SELECT * FROM meta WHERE id=1";
	$result= mysql_query($query, $connection);
	confirm_query($result);	
	$row = mysql_fetch_array($result);
	$meta= $row["{$tag}"];
	return $meta;

}




// HOME PAGE FUNCTIONS -------------------------


function get_all_participants_en() { 
global $connection;
$query = "SELECT *
		FROM fairytale_main  
		ORDER BY participant_number ASC";
$participants_set = mysql_query($query, $connection);
confirm_query($participants_set);
return $participants_set;
}

function get_participant_portrait_bg($id) {  // display image
global $connection;
$registerquery = mysql_query("SELECT participant_photo FROM fairytale_main
		WHERE fairytale_main.id = {$id}", $connection);
$row = mysql_fetch_row($registerquery);
$picid = str_replace(",", "",$row[0]);
if (!empty($picid)) {
$query2 = "SELECT source FROM directus_media
		WHERE directus_media.id =".$picid;
$pic = mysql_query($query2, $connection);
confirm_query($pic);
$row = mysql_fetch_array($pic);
$url = "http://data.fairytaleproject.net/admin/media/thumbnails/". $row['source'] ."?w=100&amp;h=100&amp;c=true";
return $url;
} else {
$url = "http://static.fairytaleproject.net/images/blank.gif";
return $url;
}
}


function get_participant_portrait_bg_bigger($id) {  // display image
global $connection;
$registerquery = mysql_query("SELECT participant_photo FROM fairytale_main
		WHERE fairytale_main.id = {$id}", $connection);
$row = mysql_fetch_row($registerquery);
$picid = str_replace(",", "",$row[0]);
if (!empty($picid)) {
$query2 = "SELECT source FROM directus_media
		WHERE directus_media.id =".$picid;
$pic = mysql_query($query2, $connection);
confirm_query($pic);
$row = mysql_fetch_array($pic);
$url = "http://data.fairytaleproject.net/admin/media/thumbnails/". $row['source'] ."?w=200&amp;h=200&amp;c=false";
return $url;
} else {
$url = "http://static.fairytaleproject.net/images/blank.gif";
return $url;
}
}


//  FILTERING FUNCTIONS ----------------------

function get_new_participants_filter(){ 
	global $connection;
	 $w=array();
	if (!empty($_SESSION['language']) && (($_SESSION['language']) != ' ')) { $w[]="participant_lang= '".$_SESSION['language']."'";}
	if (!empty($_SESSION['gender']) && (($_SESSION['gender']) != ' ')) { $w[]="participant_gender= '".$_SESSION['gender']."'";}
	if (!empty($_SESSION['region']) && (($_SESSION['region']) != ' ')) { $w[]="participant_region= '".$_SESSION['region']."'";}
	if (!empty($_SESSION['year']) && (($_SESSION['year']) != ' ')) { $w[]="participant_year >= '".($_SESSION['year']-9)."' AND participant_year <= '".$_SESSION['year']."'";}
	if (!empty($_SESSION['tag']) && (($_SESSION['tag']) != ' ')) { $w[]="tags LIKE '%".$_SESSION['tag']."%'";}

// print_r($w);

	if (count($w)) {
	$where="WHERE ".implode(' AND ',$w);
	} else { $where='';}
	$query="SELECT * FROM fairytale_main $where";
	$new_participants_set = mysql_query($query, $connection);
	confirm_query($new_participants_set);
	return $new_participants_set;

} 

function select_participants_filter_region($post) {
global $connection;
  $query="SELECT * FROM regions";
  $result=mysql_query($query, $connection);
  $options="";
  confirm_query($result);
  while ($row=mysql_fetch_array($result)) {
  	$id=$row["id"];
  	$returnedoptions=$row["Participant_Region"];  
  	$returnedoptions_ch=$row["Participant_Region_Chinese"];  	
  	$returnedoptions_de=$row["Participant_Region_German"];  		
	
  	$options.="<option value='$id'";
  	if ((!empty($_SESSION["{$post}"])) && ($_SESSION["{$post}"] == $returnedoptions )) {
  	$options.= " selected='selected'";
  	}
   	$options.= ">".$returnedoptions_ch." / ".$returnedoptions." / ".$returnedoptions_de."</option>";}

    	return $options;
} 




function select_participants_filter_themes($post) {
global $connection;
  $query="SELECT * FROM themes";
  $result=mysql_query($query, $connection);
  $options="";
  confirm_query($result);
  while ($row=mysql_fetch_array($result)) {
  	$id=$row["id"];
  	$theme_english=$row["theme_english"];  	
  	$theme_chinese=$row["theme_chinese"];  	
  	$theme_german=$row["theme_german"];  	

  	$options.="<option value='$id'";
  	if ((!empty($_SESSION["{$post}"])) && ($_SESSION["{$post}"] == $id )) {
  	$options.= " selected='selected'";
  	}
   	$options.= ">".$theme_chinese ." / ". $theme_english ." / ". $theme_german."</option>";}

    	return $options;
} 


// PARTICIPANT PAGE

function get_participant_info($id, $language) {
global $connection;
$query = "SELECT * FROM fairytale_main, fairytale_{$language} WHERE
		fairytale_main.participant_number = fairytale_{$language}.participant_number AND
		fairytale_main.id = {$id}";
$info_set = mysql_query($query, $connection);
confirm_query($info_set);
return $info_set;
}



function get_participant_pictures_thumb($id) {  // display image
global $connection;
  $query="SELECT participant_pictures FROM fairytale_main
		WHERE id = ".$id;
  $result=mysql_query($query, $connection);
  confirm_query($result);
//  echo $result;
while($row = mysql_fetch_array($result)) { 
$pics = $row["participant_pictures"];
 $explodedpics = explode(",", $pics);
// print_r($explodedpics);
 foreach ($explodedpics as $pic=>&$picid) {
	 $query2 = "SELECT source, caption, id FROM directus_media WHERE id = '". $picid ."'";
		$picquery = mysql_query($query2, $connection);
		confirm_query($picquery);
		$row = mysql_fetch_array($picquery);
		$pic = $row['source'];
		if (!empty($pic)){
		$url = "<a href='participant_media.php?source=". $row['id']."' target='participantcontent'><img src='http://data.fairytaleproject.net/admin/media/thumbnails/". $row['source'] ."?w=40&amp;h=40&amp;c=true' alt='".	$row['caption'] ."'></a>";
		echo $url;
		}
}
}
};


function get_participant_media($id) {  // display image
global $connection;
 $query2 = "SELECT type, source, caption, id FROM directus_media WHERE id = ".$id;
		$picquery = mysql_query($query2, $connection);
		confirm_query($picquery);
		$row = mysql_fetch_array($picquery);
		$pic = $row['source'];
		$type = $row['type'];
		if (!empty($pic)){
			if ($type == 'audio'){
			$url = "<audio controls='controls'><source src='http://data.fairytaleproject.net/mediafiles/files/". $row['source'] ."'>  Your browser does not support the audio element.</audio>";
			echo $url;
			}
			if ($type == 'video'){
			$url = "<video controls='controls'><source src='http://data.fairytaleproject.net/mediafiles/files/". $row['source'] ."'>  Your browser does not support the video element.</video>";
			echo $url;
			}
			if ($type == 'application'){
			$url = "<iframe src='http://docs.google.com/gview?url=http://data.fairytaleproject.net/mediafiles/files/". $row['source'] ."&embedded=true' frameborder='0'></iframe>";
			echo $url;
			}
			if ($type == 'image') {
		$url = "<img src='http://data.fairytaleproject.net/mediafiles/files/". $row['source'] ."' alt='".	$row['caption'] ."'>";
		echo $url;
		}
		echo "<div id='caption'>".$row['caption'] ."</div> <br/>";
	}
};

function get_participant_media_thumb($id) {  // display media thumbs
global $connection;
  $query="SELECT participant_media FROM fairytale_main
		WHERE id = ".$id;
  $result=mysql_query($query, $connection);
  confirm_query($result);
//  echo $result;
while($row = mysql_fetch_array($result)) { 
$pics = $row["participant_media"];
 $explodedpics = explode(",", $pics);
// print_r($explodedpics);
 foreach ($explodedpics as $pic=>&$picid) {
	 $query2 = "SELECT source, id, type, caption FROM directus_media WHERE id = '". $picid ."'";
		$picquery = mysql_query($query2, $connection);
		confirm_query($picquery);
		$row = mysql_fetch_array($picquery);
		$type = $row['type'];
		if ($type == 'audio'){
		$url = "<a href='participant_media.php?source=". $row['id']."' target='participantcontent'><img src='http://data.fairytaleproject.net/mediafiles/sound.jpg' alt='".	$row['caption'] ."'></a>";
		echo $url;
		}
		if ($type == 'video'){
		$url = "<a href='participant_media.php?source=". $row['id']."' target='participantcontent'><img src='http://data.fairytaleproject.net/mediafiles/video.jpg' alt='".	$row['caption'] ."'></a>";
		echo $url;
		}
		if ($type == 'application'){
		$url = "<a href='participant_media.php?source=". $row['id']."' target='participantcontent'><img src='http://data.fairytaleproject.net/mediafiles/doc.jpg' alt='".	$row['caption'] ."'></a>";
		echo $url;
		}
		
		}
}
};



function get_region($id, $language) {
  global $connection;
  $query = "SELECT * FROM regions, fairytale_main WHERE fairytale_main.id = ".$id." AND fairytale_main.participant_region = regions.id";
  $result=mysql_query($query, $connection);
  confirm_query($result);
  while ($row=mysql_fetch_array($result)) {
  	if ($language == "Chinese") { echo $row["Participant_Region_Chinese"]."</p>";  }
  	else if ($language == "English") { echo $row["Participant_Region"]."</p>";  }
  	else if ($language == "German") { echo $row["Participant_Region_German"]."</p>";  }

  	}
  	}


function get_theme($id, $language) {
  global $connection;
  $query = "SELECT * FROM fairytale_main WHERE id = ".$id;
  $result=mysql_query($query, $connection);
  confirm_query($result);
$row = mysql_fetch_array($result);
$themes = $row['themes'];
$content ="";
 $explodedthemes = explode(",", $themes);
 foreach ($explodedthemes as $theme=>&$themeid) {
	 $query2 = "SELECT * FROM themes WHERE id = '". $themeid ."'";
	   $result=mysql_query($query2, $connection);
	   confirm_query($result);
  while ($row=mysql_fetch_array($result)) {
  	if ($language == "Chinese") { $content.= " ".$row["theme_chinese"].","; }
  	else if ($language == "English") { $content .= " ".$row["theme_english"].","; }
  	else if ($language == "German") { $content.= " ".$row["theme_german"].",";  }
}
}
//$output = substr($content, 0, -1);
//return $output;
return $content;
  	}


function get_translator($id, $type) {
  global $connection;
  $query = "SELECT * FROM fairytale_main WHERE id = ".$id;
  $result=mysql_query($query, $connection);
  confirm_query($result);
$row = mysql_fetch_array($result);
//$transtype = "'credits_for_".$type."'";
if ($type == "app") {
$return = $row['credits_for_application'];
}
if ($type == "int") {
$return = $row['credits_for_interview'];
}
if ($type == "int2") {
$return = $row['credits_for_follow-up'];
}
$content ="";
$explodedtrans = explode(",", $return);
$total = count($return);
 foreach ($explodedtrans as $trans=>&$transid) {
	 $query2 = "SELECT * FROM translators WHERE id = '". $transid ."'";
	   $result=mysql_query($query2, $connection);
	   confirm_query($result);
  while ($row=mysql_fetch_array($result)) {
  if ($row["redact_listing"] == "Public"){
  	$content.= " ".$row["name"].", ";
  	} else {
	  	$content .= "Anonymous, ";
  	}
  	}
} 
$output = substr($content, 0, -2);
return $output;
  	}



//CONTENT PAGES
function get_page_content($id) { 
global $connection;
$query = "SELECT *
		FROM pages 
		WHERE id = {$id}";
$content_set = mysql_query($query, $connection);
confirm_query($content_set);
return $content_set;
}


//MAP

function get_participant_portrait_small($id) {  // display image
global $connection;
$registerquery = mysql_query("SELECT participant_photo FROM fairytale_main
		WHERE fairytale_main.id = {$id}", $connection);
$row = mysql_fetch_row($registerquery);
$picid = str_replace(",", "",$row[0]);
if (!empty($picid)) {
$query2 = "SELECT source FROM directus_media
		WHERE directus_media.id = '".$picid."'";
$pic = mysql_query($query2, $connection);
confirm_query($pic);
$row = mysql_fetch_array($pic);
$url = "http://data.fairytaleproject.net/admin/media/thumbnails/". $row['source'] ."?w=100&amp;h=100&amp;c=true";
return $url;
} else {
$url = "http://static.fairytaleproject.net/images/blank.gif";
return $url;
}
}
?>