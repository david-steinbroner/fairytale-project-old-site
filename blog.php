<?php require_once("includes/functions.php") ?>
<?php require_once("includes/connection.php") ?>
<?php include 'includes/blogpost.php'; 
?>

<html>
<head>
<title>Blog - The Fairytale Project</title>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css">

</head>
<body>
<div id="blog_wrapper">
<a href="blog.php"><h2>博客 / Blog / Blog</h2></a>
<div id="blog_sidebar">
<h4>Tags </h4>
<br />
<?
function select_blog_tags() {
global $connection;
  $query="SELECT tags FROM blog_posts";
  $result=mysql_query($query, $connection);
  $taglinks="";
  confirm_query($result);
  $tags = array(); 
	while($row = mysql_fetch_assoc($result)) { 
   $tagarray = $row["tags"]; 
   $explodedtags= explode(",", $tagarray);
   foreach ($explodedtags as $tag) {
   $tags[] = $tag;
   }
	} 
  $indiv_results = array_unique($tags);
  
  foreach ($indiv_results as $tag) {	
  	$taglinks.= "<li><a href='blog_content_tag.php?tag=".$tag."' target='blogcontent'>";	
   	$taglinks.= $tag."</a></li>";}

    	return $taglinks;
};

$taglinks = select_blog_tags();
echo "<ul>";
echo $taglinks;
echo "</ul>";

?>

</div>
<div id="blog_posts"> 
<iframe name="blogcontent" id="blogcontent" src="blog_content.php" seamless="seamless" height="100%" width="100%" scrolling="no"></iframe>

</div>

</div>
</body>