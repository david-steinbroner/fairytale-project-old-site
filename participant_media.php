<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php 
session_start();
?>
	
 <?php
$id = $_SESSION['id'];

$media = $_GET['source'];
?>


<!DOCTYPE html>
<html>
<head>
<title>Participant - The Fairytale Project</title>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css">
</head>
<body>

<div id="media">
<?php
$display = get_participant_media($media);

?>

</div>



</body>
</html>