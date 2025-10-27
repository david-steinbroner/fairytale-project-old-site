<?php
class BlogPost  
{  
    public $id;  
    public $title;  
    public $post;  
    public $datePosted;  
    public $tags;  
	function __construct($inId=null, $inActive=null, $inTitle=null, $inPost=null, $inDatePosted=null, $inTags=null)  
{  
	if (!empty($inId))  
    {  
		$this->id = $inId; 
		}
	if (!empty($inActive))  
    {  
		$this->active = $inActive; 
		}
	if (!empty($inTitle))  
    {  
    	$this->title = $inTitle;  
    	}
	if (!empty($inPost))  
    {  
   	   $this->post = $inPost; 
    	}
	if (!empty($inDatePosted))  
    {  
    $splitDate = explode("-", $inDatePosted);  
	$this->date_posted = $splitDate[1] . "/" . $splitDate[2] . "/" . $splitDate[0];  
		}
	if (!empty($inTags))  
    {  
	$this->tags = $inTags;
		}
}  
}

// Displays Blog Posts //

function get_blog_posts($inId=null, $inTagId=null)  {  
 if (!empty($inId))  {  
   $query = mysql_query("SELECT * FROM blog_posts WHERE id = " . $inId . " ORDER BY id DESC"); 
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




// Displays Blog Media 

function get_blog_media($id) {  // display media thumbs
global $connection;
  $query="SELECT media FROM blog_posts
		WHERE id = ".$id;
  $result=mysql_query($query, $connection);
  confirm_query($result);
//  echo $result;
while($row = mysql_fetch_array($result)) { 
$pics = $row["media"];
 $explodedpics = explode(",", $pics);
// print_r($explodedpics);
 foreach ($explodedpics as $pic=>&$picid) {
	 $query2 = "SELECT source, id, type, caption FROM directus_media WHERE id = '". $picid ."'";
		$picquery = mysql_query($query2, $connection);
		confirm_query($picquery);
		$row = mysql_fetch_array($picquery);
		$pic = $row['source'];
		$type = $row['type'];
		if (!empty($pic)){
			if ($type == 'audio'){
			$url = "<audio controls='controls'><source src='http://data.fairytaleproject.net/mediafiles/files/". $row['source'] ."'>  Your browser does not support the audio element.</audio>";
			echo $url;
			}
			if ($type == 'video'){
			$url = "<video controls='controls'><source src='http://data.fairytaleproject.net/mediafiles/files/". $row['source'] ."'>  Your browser does not support the video element.</video>";
			echo $url;
			}
			
			if ($type == 'application'){
			$url = "<iframe src='http://docs.google.com/gview?url=http://data.fairytaleproject.net/mediafiles/files/". $row['source'] ."&embedded=true' frameborder='0'></iframe>";
			echo $url;
			}
			
			else {
		$url = "<img src='http://data.fairytaleproject.net/mediafiles/files/". $row['source'] ."' alt='".	$row['caption'] ."'>";
		echo $url;
		}
		echo "<div id='caption'>".$row['caption'] ."</div>";
		}
}
}
};






?>



