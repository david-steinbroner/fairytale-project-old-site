<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php
$id = $_GET['id']; 
?>
<html>
<head>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css">
</head>
<body style="background:#ffffff;">
<div id="participant_wrapper">
<div id="participant_sidebar">
<div id="participant_sidebar_header">
<div id="participant_sidebar_thumb">
<br /><p>Thumbnail</p> </div>

<h2><p>Participant Name(s):</p>
<?php

$quote = get_participant_quote($id);
while($row = mysql_fetch_array($quote))
  {
  echo $row['participant_name_ch'];
  echo "<br />".$row['participant_name_en'];
  echo "<br />".$row['participant_name_de'];
  echo "</h2><br /><br />";
  }
  
?>
</div>
<form action="participant_filter.php" method="post"> 

<div class="filters">
<p>Select Content:</p>
<select name="content" class="filter">
<option value="">Content Type</option>
</select>
</div>


<div class="filters">
<p>Select Language:</p>
<select name="language" class="filter">
<option value="">Language</option>
</select>
</div>
</form>

<p>Pictures</p>

</div>
  
  <div id="participant_content">
<?php 
 $quote = get_participant_quote($id);
 while($row = mysql_fetch_array($quote))
  {
  echo "<b> Quote (Ch): ".$row['participant_int_ch_quote'];
  echo "<br /> Quote (En): ".$row['participant_int_en_quote'];
  echo "<br /> Quote (De): ". $row['participant_int_de_quote'];
  echo "</b><br />";
  }
?>

<br /><br/>
<p> Test Copy (for scrollbar purposes)</p>
<br/>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus urna nisl, tincidunt eu pharetra vel, accumsan hendrerit nibh. Maecenas eu metus quis quam porttitor pellentesque eu id velit. Nullam lacus felis, dapibus sed imperdiet vel, bibendum sit amet tellus. Duis aliquam consequat mi, ac suscipit ipsum adipiscing quis. Aenean id ante ac dolor consectetur tempor. Donec lacinia lobortis eros id adipiscing. Duis magna magna, rutrum nec semper ut, mollis in risus. Morbi posuere imperdiet eros in condimentum. Phasellus sed sapien magna, vitae dignissim dui. Cras id sapien eget orci scelerisque viverra. Aliquam mattis lorem nec quam vulputate eget laoreet dui tempor. Nam turpis dui, cursus vel lobortis nec, rhoncus et enim. Nam sed dui libero, eget iaculis nunc.
</p>
<p>Pellentesque sit amet felis felis. Mauris at augue mauris. Morbi enim nisl, blandit sit amet faucibus dictum, pulvinar eget lectus. Aenean interdum, odio a pellentesque convallis, velit mi imperdiet dui, vitae laoreet ante arcu a ligula. Curabitur sollicitudin nibh at tellus sollicitudin eget dignissim nisi tincidunt. Proin sed ipsum suscipit nulla eleifend scelerisque et volutpat orci. Ut rutrum tellus ut dui rutrum cursus. Nullam adipiscing adipiscing ultrices. Mauris ut odio hendrerit arcu dictum tristique. Nunc tristique, nulla sed congue volutpat, orci dolor porta ligula, at semper odio sem a orci. Nullam porta lacinia nisl nec lobortis. Duis vitae sapien id est consequat auctor. In eu nisl in ipsum laoreet dictum. Curabitur vestibulum porta mauris, ac ultricies purus egestas mattis. Etiam non eros odio.
</p>
<p>Vivamus leo mi, molestie eget eleifend nec, ornare sed libero. Morbi non libero nec urna semper suscipit. Curabitur eget sem massa, ac commodo dui. Nunc eleifend velit eget felis volutpat elementum. Pellentesque varius, purus ultricies aliquam posuere, justo arcu iaculis sem, in elementum orci diam eget arcu. Donec orci nibh, convallis ut mollis ac, hendrerit sit amet lorem. Vivamus aliquam turpis quis nisl tincidunt euismod. Nullam quam dolor, bibendum id auctor eu, viverra mattis eros. Sed interdum urna ut eros ultricies pellentesque.
</p><br />

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus urna nisl, tincidunt eu pharetra vel, accumsan hendrerit nibh. Maecenas eu metus quis quam porttitor pellentesque eu id velit. Nullam lacus felis, dapibus sed imperdiet vel, bibendum sit amet tellus. Duis aliquam consequat mi, ac suscipit ipsum adipiscing quis. Aenean id ante ac dolor consectetur tempor. Donec lacinia lobortis eros id adipiscing. Duis magna magna, rutrum nec semper ut, mollis in risus. Morbi posuere imperdiet eros in condimentum. Phasellus sed sapien magna, vitae dignissim dui. Cras id sapien eget orci scelerisque viverra. Aliquam mattis lorem nec quam vulputate eget laoreet dui tempor. Nam turpis dui, cursus vel lobortis nec, rhoncus et enim. Nam sed dui libero, eget iaculis nunc.
</p>
<p>Pellentesque sit amet felis felis. Mauris at augue mauris. Morbi enim nisl, blandit sit amet faucibus dictum, pulvinar eget lectus. Aenean interdum, odio a pellentesque convallis, velit mi imperdiet dui, vitae laoreet ante arcu a ligula. Curabitur sollicitudin nibh at tellus sollicitudin eget dignissim nisi tincidunt. Proin sed ipsum suscipit nulla eleifend scelerisque et volutpat orci. Ut rutrum tellus ut dui rutrum cursus. Nullam adipiscing adipiscing ultrices. Mauris ut odio hendrerit arcu dictum tristique. Nunc tristique, nulla sed congue volutpat, orci dolor porta ligula, at semper odio sem a orci. Nullam porta lacinia nisl nec lobortis. Duis vitae sapien id est consequat auctor. In eu nisl in ipsum laoreet dictum. Curabitur vestibulum porta mauris, ac ultricies purus egestas mattis. Etiam non eros odio.
</p>
<p>Vivamus leo mi, molestie eget eleifend nec, ornare sed libero. Morbi non libero nec urna semper suscipit. Curabitur eget sem massa, ac commodo dui. Nunc eleifend velit eget felis volutpat elementum. Pellentesque varius, purus ultricies aliquam posuere, justo arcu iaculis sem, in elementum orci diam eget arcu. Donec orci nibh, convallis ut mollis ac, hendrerit sit amet lorem. Vivamus aliquam turpis quis nisl tincidunt euismod. Nullam quam dolor, bibendum id auctor eu, viverra mattis eros. Sed interdum urna ut eros ultricies pellentesque.
</p>

</div>


</div>
</body>
</html>