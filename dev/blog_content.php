<?php require_once("includes/functions.php") ?>
<?php require_once("includes/connection.php") ?>
<?php include 'includes/blogpost.php'; 


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css">
</head>
<body>
<div id="blogposts">
<?php
$blogPosts = get_blog_posts(); 

foreach ($blogPosts as $post)  
{  
if ($post->active == 1) {
$tags = substr( $post->tags, 1 );
    echo "<br/><div class='post'>";  
    echo "<a href='blog_content_single.php?id=".$post->id."'><h3>" . $post->title . "</h3></a><br/>";
    $date = strtotime($post->date_posted);
    echo "<h4>" . date("F j, Y", $date) . "</h4>"; 
    echo "<div class='postcontentsnippet'>";
    $blogMedia = get_blog_media($post->id);
    echo $blogMedia;
    echo substr($post->post, 0, 800) . "... ";  
    echo "<a href='blog_content_single.php?id=".$post->id."' class='readmore'>(Read More...)</a></div>";
    echo "<br/><span class='postfooter'><em>Tags:  &nbsp;</em> ";
    $explodedtags= explode(",", $tags);
    foreach ($explodedtags as $tag){
    echo "<a href='blog_content_tag.php?tag=".$tag."'>".$tag."</a> &nbsp; &nbsp;";
    } 
    echo "</span></div>";  
}  
}
?>

<br/><br/><br/>
</div>
</body></html>