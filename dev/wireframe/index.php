<?php require_once("includes/functions.php") ?>
<?php require_once("includes/connection.php") ?>
<?php include("includes/header.php") ?>

<div id="participants">
Participants (names will be replaced by thumbnail in grid format)
<?php
$participants_set = get_all_participants_en();
while ( $participant = mysql_fetch_array($participants_set)) {
    echo("<P><a href=\"participant.php?id=".$participant["id"]."\" class=\"fancybox fancybox.iframe\">" . $participant["participant_number"] ." : ". $participant["participant_name"] . "</a></P>");
  }
  
  

  ?>

  
</div>



<?php require("includes/footer.php") ?>
