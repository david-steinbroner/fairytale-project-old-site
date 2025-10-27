<?php require_once("includes/functions.php") ?>
<?php require_once("includes/connection.php") ?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css">
</head>
<body>
<div id="page_wrapper">
<?php
$page_content = get_page_content(2);
while($row = mysql_fetch_array($page_content))
  {
	echo "<h2>". $row['title'] . "</h2>";
	echo "<div id='page_content'><div id='content_ch'>" . $row['content_ch'] . "</div>";
	echo "<div id='content_en'>" . $row['content_en'] . "</div>";
	echo "<div id='content_de'>" . $row['content_de'] . "</div></div>";
}
?>

</div>
</body>