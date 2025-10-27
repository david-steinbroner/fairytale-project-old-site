<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php
$id = $_GET['id']; 
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css">
</head>
<body style="background:#ffffff;">
<div id="participant_wrapper">
<div id="participant_sidebar">
<div id="participant_sidebar_header">
<div id="participant_sidebar_thumb">
<br /><p>Thumbnail</p> 
</div>

<h2><p>Participant Name(s):</p>
<?php

$name_en = get_participant_name_en($id);
while($row = mysql_fetch_array($name_en))
  {
	echo $row['name'];
  }
  
$name_ch = get_participant_name_ch($id);
while($row = mysql_fetch_array($name_ch))
  {
	echo "<br />" . $row['name'];
  }
  
  $name_de = get_participant_name_de($id);
while($row = mysql_fetch_array($name_de))
  {
	echo "<br />" . $row['name'];
  }
  
?>
<br/><br/><br/>
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
<b>Quote (Ch):</b>
<?php 
 $quote_ch = get_participant_quote_ch($id);
 while($row = mysql_fetch_array($quote_ch))
  {
  echo $row['interview_quote']."  <br />";
  }
  ?>
  <br /><b>Quote (En):</b>
  <?
   $quote_en = get_participant_quote_en($id);
 while($row = mysql_fetch_array($quote_en))
  {
  echo $row['interview_quote']."  <br />";
  }
  ?>
  <br /><b>Quote (De):</b>
  <?
   $quote_de = get_participant_quote_de($id);
 while($row = mysql_fetch_array($quote_de))
  {
  echo $row['interview_quote']."  <br />";
  }
?>

<br /><br/>


</div>


</div>
</body>
</html>