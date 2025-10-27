<div id="headercontainer" class="draggable">
<div id="navbox" class="home">
<div id="header">
<h1>童话项目 / Fairytale Project / Fairytale-Projekt</h1>
</div>



<div id="view">
<h3>1. 选择视图 / Select View / Ansicht auswählen:<br /></h3>
<!--View Grid or Map-->
<form> 
<select name="view" class="filter" onChange="document.location = this.value">
<option value="index.php" <?php if($_SERVER['PHP_SELF'] == '/index.php') echo 'selected'; ?>>肖像 / Grid / Raster</option>
<option value="map.php" <?php if($_SERVER['PHP_SELF'] == '/map.php') echo 'selected'; ?>>地图 / Map / Karte</option>
</select>
</form>
</div>

  

<div id="filters">
<h3>2. 选择过滤器 / Select Filters / Filter auswählen:<br /></h3>
<!-- Language -->
<form method="post" class="language"> 
<select id="language" name="participant_lang" class="filter language" >
<option value="0">语言 / Languages / Sprachen</option>
<?php
	echo "<option value='Chinese'";
	if ((!empty($_SESSION["language"])) && ($_SESSION["language"] == "Chinese" )) {
  	echo " selected='selected'";
  	}
  	echo ">中文</option>";
  	
  		echo "<option value='Chinese + English'";
	if ((!empty($_SESSION["language"])) && ($_SESSION["language"] == "Chinese + English" )) {
  	echo " selected='selected'";
  	}
  	echo ">中文 + English</option>";
  	
  		echo "<option value='Chinese + German'";
	if ((!empty($_SESSION["language"])) && ($_SESSION["language"] == "Chinese + German" )) {
  	echo " selected='selected'";
  	}
  	echo ">中文 + Deutsch</option>";
  	
  		echo "<option value='Chinese + English + German'";
	if ((!empty($_SESSION["language"])) && ($_SESSION["language"] == "Chinese + English + German" )) {
  	echo " selected='selected'";
  	}
  	echo ">中文 + English + Deutsch</option>";
?>


</select>
</form>

<!-- Gender -->
<form method="post"> 
<select id="gender" name="gender" class="filter">
<option value="0">性别 / Gender / Geschlecht</option>


<?php 

	echo "<option value='Male'";
	if ((!empty($_SESSION["gender"])) && ($_SESSION["gender"] == "Male" )) {
  	echo " selected='selected'";
  	}
  	echo ">男 / Male / Männlich</option>";
  	
  		echo "<option value='Female'";
	if ((!empty($_SESSION["gender"])) && ($_SESSION["gender"] == "Female" )) {
  	echo " selected='selected'";
  	}
  	echo ">女 / Female / Weiblich</option>";
?>
</select>
</form>
  
<!-- Province -->
<form method="post"> 
<select id="region" name="province" class="filter">
<option value="0">地区 / Region / Region</option>

<?php 
$province = select_participants_filter_region('region');
echo $province;
?>
</select>
</form>

<!-- Generation -->
<form method="post"> 
<select id="generation" name="generation" class="filter">
<option value="0">出生年代 / Generation / Generation</option>
<?php
echo "<option value='2009'";
	if ((!empty($_SESSION["year"])) && ($_SESSION["year"] >= 2000) && ($_SESSION["year"] <= 2009 )) {
  	echo " selected='selected'";
  	}
  	echo ">2000-2009</option>";
  	
	echo "<option value='1999'";
	if ((!empty($_SESSION["year"])) && ($_SESSION["year"] >= 1990) && ($_SESSION["year"] <= 1999 )) {
  	echo " selected='selected'";
  	}
  	echo ">1990-1999</option>";
  	
  		echo "<option value='1989'";
	if ((!empty($_SESSION["year"])) && ($_SESSION["year"] >= 1980) && ($_SESSION["year"] <= 1989 )) {
  	echo " selected='selected'";
  	}
  	echo ">1980-1989</option>";
  	
  		echo "<option value='1979'";
	if ((!empty($_SESSION["year"])) && ($_SESSION["year"] >= 1970) && ($_SESSION["year"] <= 1979 )) {
  	echo " selected='selected'";
  	}
  	echo ">1970-1979</option>";
  	
  	  		echo "<option value='1969'";
	if ((!empty($_SESSION["year"])) && ($_SESSION["year"] >= 1960) && ($_SESSION["year"] <= 1969 )) {
  	echo " selected='selected'";
  	}
  	echo ">1960-1969</option>";
  	
  	  		echo "<option value='1959'";
	if ((!empty($_SESSION["year"])) && ($_SESSION["year"] >= 1950) && ($_SESSION["year"] <= 1959 )) {
  	echo " selected='selected'";
  	}
  	echo ">1950-1959</option>";
  	
  	  		echo "<option value='1949'";
	if ((!empty($_SESSION["year"])) && ($_SESSION["year"] >= 1940) && ($_SESSION["year"] <= 1949 )) {
  	echo " selected='selected'";
  	}
  	echo ">1940-1949</option>";
  	
  	  		echo "<option value='1939'";
	if ((!empty($_SESSION["year"])) && ($_SESSION["year"] >= 1930) && ($_SESSION["year"] <= 1939 )) {
  	echo " selected='selected'";
  	}
  	echo ">1930-1939</option>";
  	
  	  		echo "<option value='1929'";
	if ((!empty($_SESSION["year"])) && ($_SESSION["year"] >= 1920) && ($_SESSION["year"] <= 1929 )) {
  	echo " selected='selected'";
  	}
  	echo ">1920-1929</option>";
  	
  	
  	
  	?>

</select>
</form>

<!-- Themes -->
<form method="post"> 
<select id="themes" name="themes" class="filter">
<option value="0">主题 / Themes / Themen</option>

<?php 

 $tags = select_participants_filter_themes('tag');
echo $tags;

?>

</select>
</form>
<p><a href="?filter=reset">重设过滤器 / Reset Filters / Filter zurücksetzen</a></p>

</div>

<div class="header_links">
<a href="project.php" class="fancybox fancybox.iframe">项目简介 / Project Overview / Projekt-Überblick</a> <br />
<a href="blog.php" class="fancybox fancybox.iframe">博客 / Blog / Blog</a> <br />
<a href="call.php" class="fancybox fancybox.iframe">参与者召唤 / Call to Participants / An die Teilnehmenden</a> <br />
<div id="social">
<a href="http://www.facebook.com/sharer/sharer.php?u=http://www.fairytaleproject.net" target="_blank" class="facebook">Facebook</a>
<a href="http://clicktotweet.com/0RVj3" target="_blank" class="twitter">Twitter</a>
<a href="https://plusone.google.com/_/+1/confirm?hl=en&url=http://www.fairytaleproject.net" target="_blank" class="googleplus">Google Plus</a>
<a href="http://www.tumblr.com/share/link?url=http://www.fairytaleproject.net&name=The%20Fairytale%20Project" target="_blank" class="tumblr">Tumblr</a>
<a href="http://share.renren.com/share/buttonshare.do?link=http://www.fairytaleproject.net&title=The%20Fairytale%20Project" target="_blank" class="renren">RenRen</a>
<a href="http://service.weibo.com/share/share.php?url=http://www.fairytaleproject.net&appkey=&title=The%20Fairytale%20Project&pic=&ralateUid=&language=zh_cn" class="weibo" target="_blank" >Weibo</a>
</div>

</div>


</div>


<div id="zoom">
<a href="#" id="plus"><i class="icon-plus-2"></i></a>
<a href="#" id="minus"><i class="icon-minus-2"></i></a>
</div>

</div>