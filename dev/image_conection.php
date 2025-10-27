<?php require_once("includes/functions.php") ?>
<?php require_once("includes/connection.php") ?>

<?php

	$query = "SELECT id, file_name FROM directus_media WHERE id > 57";
	$images = mysql_query($query);


while($row = mysql_fetch_array($images)) {
$id = $row['id'];
$number = substr($row['file_name'],0,4);
$query = "UPDATE fairytale_main SET participant_photo = '".$id."' WHERE participant_number = '".$number."'";
mysql_query($query);
 

}



?>