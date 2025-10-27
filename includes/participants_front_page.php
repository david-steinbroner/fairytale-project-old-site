<?php

	$participants_set = get_all_participants_en();
	
	while ( $participant = mysql_fetch_array($participants_set)) {
		 $picid = get_participant_portrait_bg($participant["id"]);
		 $bigpicid = get_participant_portrait_bg_bigger($participant["id"]);
		echo '<div class="outer">';
        echo '<a class="participant fancybox fancybox.iframe" href="#" id="'. $participant["id"] .'">';
		echo '<img class="participant_front_page lazy inactive" id="picid-'. $participant["id"] .'" data-original="'.$bigpicid.'" src="images/person.png" alt="'.$participant["id"].'"><noscript><img class="lazy" src="'.$picid.'" alt="'.$participant["id"].'"></noscript>';
  		echo ("<p class='id inactive1' id='id-". $participant["id"] ."'>". $participant["participant_number"] ."</p>");
  		echo "</a></div>";
  		}
  
?>



<?php
/*


//onclick=\'$("#IDform").val("'.$participant["id"].'");$("#postid").submit();\'


//	$participants_set = get_all_participants_en();
	
	while ( $participant = mysql_fetch_array($participants_set)) {
		 $picid = get_participant_portrait_bg($participant["id"]);
		echo '<div class="outer">';
        echo '<a href="participant.php?id='.$participant["id"]. '" class="fancybox fancybox.iframe">';
		echo '<img class="lazy inactive" id="'. $participant["id"] .'" data-original="'.$picid.'" src="images/person.png" alt="'.$participant["id"].'"><noscript><img class="lazy" src="'.$picid.'" alt="'.$participant["id"].'"></noscript>';
  		echo ("<p class='id inactive1' id='id-". $participant["id"] ."'>". $participant["participant_number"] ."</p>");
  		echo "</a></div>";
}
  
 */ 
?>