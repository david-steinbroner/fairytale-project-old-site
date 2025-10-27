<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php
session_start();
/*
if (is_numeric($_GET['id'])){
$id = mysql_real_escape_string($_GET['id']);
$_SESSION['id'] = $id;
}
*/
if (is_numeric($_POST['id'])){
$id = mysql_real_escape_string($_POST['id']);
$_SESSION['id'] = $id;
}

?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!--<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css">-->
</head>
<body>
<div id="participant_wrapper">
<div id="participant_sidebar">
<div id="participant_sidebar_header">
<div id="participant_sidebar_thumb">

<?php
$picid = get_participant_portrait_bg($id);
echo "<img src='".$picid."' alt='Participant ".$id."' >";
?>


</div>

<h2>
<p class='participantnumber'>
<?php
$info_en = get_participant_info($id, english);
while($row = mysql_fetch_array($info_en))
  {
	echo $row['participant_number'];
  }
  ?>
</p>
<p>已删除名字以保护参与者。</p>
<p>Name removed to protect participant.</p>
<p>Name wurde zum Schutz des Teilnehmers gelöscht.</p>
 
 <?
/*  
  $info_ch = get_participant_info($id, chinese);
while($row = mysql_fetch_array($info_ch))
  {
	echo "<br />" . $row['name'];
  }
  
  $info_de = get_participant_info($id, german);
while($row = mysql_fetch_array($info_de))
  {
	echo "<br />" . $row['name'];
  }
  */
?>

 </h2>
<br/><br/><br/>
</div>
<form action="participant_content.php" method="post" target="participantcontent"> 

<div class="filters">
<p>1. 选择语言 / Select language / Sprach auswählen:</p>
<select name="language" class="filter" onchange='this.form.submit()'>
<option value="chinese">中文</option>
<option value="english">English</option>
<option value="german">Deutsch</option>
</select>
</div>

<div class="filters">
<p>2. 选择内容 / Select content / Inhalt auswählen:</p>
<select name="content" class="filter" onchange='this.form.submit()'>
<option value="">简介 / Biography / Biografie</option>
<option value="application">申请问卷 / Application / Applikation</option>
<option value="interview">访谈 / Interview / Gespräch</option>
<option value="followup">后续访谈 / Follow-up interview / Nach gespräch</option>

</select>

</div>


</form>
<br/>
<div id="pictures">
<?php
$pics = get_participant_pictures_thumb($id);
if (!empty($pics)) {
	echo $pics;
	
}
?>
</div><br/>
<div id="othermedia">
<?php
$clips = get_participant_media_thumb($id);
echo $clips;
?>

</div>

</div>
  
  <div id="participant_content">
<iframe name="participantcontent" id="participantcontent" src="participant_content.php" seamless="seamless" height="100%" width="100%" scrolling="no"></iframe>
</div>


</div>
</body>
</html>

