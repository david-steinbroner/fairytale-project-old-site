<?php require_once("includes/functions.php") ?>
<?php require_once("includes/connection.php") ?>
<?php include 'includes/blogpost.php'; 


if ($_GET['id']) {
$id = $_GET['id'];
}



    
function get_blog_posts_id($id)  {  
 if (!empty($id))  {  
   $query = mysql_query("SELECT * FROM blog_posts WHERE id = " . $id . " ORDER BY id DESC"); 
   }  
 else  {  
  $query = mysql_query("SELECT * FROM blog_posts ORDER BY id DESC"); 
	}  
$postArray = array();  
while ($row = mysql_fetch_assoc($query))  {  
    $myPost = new BlogPost($row["id"], $row['active'], $row['title'], $row['post'], $row['date_posted'], $row['tags']);  
    array_push($postArray, $myPost);  
	}  
return $postArray; 
}


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
<p>
<a href="blog_content.php">← Back to Blog</a>
</p>
<br/>
<?php
$blogPosts = get_blog_posts_id($id); 

foreach ($blogPosts as $post)  
{  
$tags = substr( $post->tags, 1 );
    echo "<br/><div class='post'>"; 
    echo "<a href='?id=".$post->id."'><h3>" . $post->title . "</h3></a><br/>"; 
	$date = strtotime($post->date_posted);
    echo "<h4>" . date("F j, Y", $date) . "</h4>"; 
    echo "<div class='postcontent'>";
     $blogMedia = get_blog_media($post->id);
    echo $blogMedia;
    echo $post->post. "</div>";  
    echo "<br/><span class='postfooter'><em>Tags:  &nbsp;</em> ";
    $explodedtags= explode(",", $tags);
    foreach ($explodedtags as $tag){
    echo "<a href='blog_content_tag.php?tag=".$tag."'>".$tag."</a> &nbsp; &nbsp;";
    } 
    echo "</span></div>";  
}  

?>
<br/>
<p>
<a href="blog_content.php">← Back to Blog</a>
</p>
<br/><br/><br/>
<br/><br/><br/>
</div>
</body></html>