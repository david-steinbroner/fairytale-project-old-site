<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title> The Fairytale Project</title>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css">
<script type="text/javascript" src="javascript/csspopup.js"></script>

 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <link rel="stylesheet" href="javascript/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
        <script type="text/javascript" src="javascript/fancybox/source/jquery.fancybox.pack.js"></script>
<link rel="stylesheet" href="javascript/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2" type="text/css" media="screen" />
<script type="text/javascript" src="javascript/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2"></script>
<script type="text/javascript" src="javascript/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.0"></script>

<link rel="stylesheet" href="/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=2.0.6" type="text/css" media="screen" />
<script type="text/javascript" src="/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=2.0.6"></script>

</head> 


<div id="main">
<div id="navbox">
<div id="header">
<h1>Fairytale Project</h1>
</div>


<form action="filter.php" method="post"> 


<div id="view">
1. Select View: <br />
<!--View Grid or Map-->
<select name="view" class="filter">
<option value="grid">Grid</option>
<option value="map">Map</option>
</select>
</div>

  



<div id="filters">
2. Select Filters: <br />
<!-- Language -->
<select name="language" class="filter">
<option value="">Languages</option>
<?php 
$language = select_participants_filter('participant_lang');
echo $language;
?>
</select>


<!-- Gender -->
<select name="gender" class="filter">
<option value="0">Gender</option>
<?php 
$gender = select_participants_filter('participant_gender');
echo $gender;
?>
</select>
  
  
<!-- Province -->
<select name="province" class="filter">
<option value="0">Province</option>
<?php 
$province = select_participants_filter('participant_region');
echo $province;
?>
</select>

<!-- Generation -->
<select name="generation" class="filter">
<option value="">Generation</option>
<?php 
$generation = select_participants_filter('participant_year');
echo $generation;
?>
</select>
<!-- Themes -->

<select name="themes" class="filter">
<option value="">Themes</option>
<option value="dreams">Dreams</option>
<option value='ecology'>Ecology</option>
<option value='love'>Love</option>
<option value='art'>Art</option>
<option value='identity'>Identity</option>
<option value='education'>Education</option>
<option value='travel'>Travel</option>
<option value='philosophy'>Philosophy</option>
<option value='faith'>Faith</option>
<option value='future'>Future</option>
</select>
</div>
</form>
<p>
<a href="project.php" class="fancybox fancybox.iframe">Project Overview</a> <br />
<a href="blog.php" class="fancybox fancybox.iframe">Blog</a> <br />
<a href="call.php" class="fancybox fancybox.iframe">Call to Participants</a> <br />
<br />
<img src="images/socials.png">
</div>

