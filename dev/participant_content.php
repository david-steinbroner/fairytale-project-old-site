<?php require_once("includes/connection.php") ?>
<?php require_once("includes/functions.php") ?>
<?php 
session_start();
?>
	
 <?php
$id = $_SESSION['id'];
?>


<!DOCTYPE html>
<html>
<head>
<title>Participant - The Fairytale Project</title>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css">
</head>
<body>

<div id="participant_content_container">

<?php if(empty($_POST["content"])){ 

  	if(!empty($_POST["language"])) {
		if(($_POST["language"]) == "english") {
		?>
 
  <?
  $info_en = get_participant_info($id, english);
 while($row = mysql_fetch_array($info_en))
  {
  echo "<p>Gender: ";
  echo $row['participant_gender']."</p>";
  echo "<p>Region: ";
  $region = get_region($id, English);
  echo "<p>Generation: ".substr($row['participant_year'], 0, 3)."0s</p>";
  if (!empty($row['bio'])){
  echo "<p>Occupation: ".$row['bio']."</p>";
  }
    if (!empty($row['themes'])){
  echo "<p>Themes: ";
  $themes = get_theme($id, English);
  echo substr($themes, 0, -1);
  echo "</p>"; }
  echo "<br/>";

  echo "<p>".$row['application_quote']."</p>  <br /> <br />";
  echo "<p>".$row['interview_quote']."  </p><br/><br/>";
  echo "<p>".$row['notes_public_commentary']."</p>";
  }
  }
  ?>
  
 
  <? if(($_POST["language"]) == "german") {
		?>

  
  <?
   $info_de = get_participant_info($id, german);
 while($row = mysql_fetch_array($info_de))
  {
    echo "<p>Geschlecht: ";
  echo $row['participant_gender']."</p>";
  echo "<p>Region: ";
  $region = get_region($id, German);
  echo "<p>Generation: ".substr($row['participant_year'], 0, 3)."0er</p>";
  if (!empty($row['bio'])){
  echo "<p>Okkupation: ".$row['bio']."</p>";
  }
      if (!empty($row['themes'])){
  echo "<p>Themes: ";
  $themes = get_theme($id, German);
  echo substr($themes, 0, -1);
  echo "</p>";}
  echo "<br/>";
  echo $row['application_quote']." </p> <br /> <br/>";
  echo $row['interview_quote']."  </p>";
  }
  }
?>

  
  <? if(($_POST["language"]) == "chinese") {
		?>
 
  <?
  $info_ch = get_participant_info($id, chinese);
 while($row = mysql_fetch_array($info_ch))
  {
  echo "<p>性别: ";
  if (($row['participant_gender']) == "Male") { echo "男</p>";}
  else if (($row['participant_gender']) == "Female") { echo "女</p>";}
  echo "<p>地区: ";
  $region = get_region($id, Chinese);
  echo "<p>出生年代: ".substr($row['participant_year'], -2, 1)."0年代</p>";
  if (!empty($row['bio'])){
  echo "<p>职业: ".$row['bio']."</p>";
  }
      if (!empty($row['themes'])){
  echo "主题: ";
  $themes = get_theme($id, Chinese);
  echo substr($themes, 0, -1);
  echo "</p>";}
  echo "<br/>";

  echo $row['application_quote']."</p>  <br /> <br/>";
  echo $row['interview_quote']."  </p>";
  }
  }
  } else {
	  ?>
	 
<?php 
  $info_ch = get_participant_info($id, chinese);
 while($row = mysql_fetch_array($info_ch))
  {
  echo "<p>性别: ";
  if (($row['participant_gender']) == "Male") { echo "男</p>";}
  else if (($row['participant_gender']) == "Female") { echo "女</p>";}
  echo "<p>地区: ";
  $region = get_region($id, Chinese);
  echo "<p>出生年代: ".substr($row['participant_year'], -2, 1)."0年代</p>";
  if (!empty($row['bio'])){
  echo "<p>职业: ".$row['bio']."</p>";
  }
      if (!empty($row['themes'])){
  echo "主题: ";
  $themes = get_theme($id, Chinese);
  echo substr($themes, 0, -1);
  echo "</p>";}
  echo "<br/>";
  echo $row['application_quote']."  </p><br /> <br />";
   echo $row['interview_quote']."  </p>";
  }	  
	  
  }
  
  
  
  }
  ?>

  





<? 
if (!empty($_POST)){


	if(!empty($_POST["content"])) {
		if(($_POST["content"]) == "application") {
		?>
		
	
		<?
		
// CHINESE (APPLICATION)  ----------------------------------------
	if(!empty($_POST["language"])) {
		if(($_POST["language"]) == "chinese") {
		echo "<h2>申请问卷 </h2>";
		$info_ch = get_participant_info($id, chinese);
		while($row = mysql_fetch_array($info_ch)) {
			if ($row['application'] == '') {
				echo  "<p class='inactive'>如果您愿意帮助我们翻译这些文件，<a href='mailto:info@fairytaleproject.net'>请联系我们</a>。</p>";
			}
		
			else if ($row['application_active'] == 'yes') {
  				echo "<p class='application'>" .$row['application']." </p> <br /><br />";
  			} else {
  				echo "<p class='inactive'>这个文件还在整理中，我们会尽快上传。</p>";
  			}
  		}		
	}
}

// ENGLISH (APPLICATION) ----------------------------------------


	if(!empty($_POST["language"])) {
		if(($_POST["language"]) == "english") {
		echo "<h2>Application</h2>";
		$info_en = get_participant_info($id, english);
		while($row = mysql_fetch_array($info_en)) {
			if ($row['application'] == '') {
				echo  "<p class='inactive'>This application is not yet translated. If you would like to help translate this or other documents, please <a href='mailto:info@fairytaleproject.net'>contact us</a>.</p>";
			}
			else if ($row['application_active'] == 'yes') {
  				echo "<p class='application'>" .$row['application']." </p> <br /><br />";
  				if (!empty($row['credits_for_application'])) {
  				$translators = get_translator($id, 'app');
  				echo "Translation: " .$translators;
  				echo "</p><br/><br/><br />";
  				}
  			} else {
  				echo "<p class='inactive'>This application is being reviewed and will be released shortly.</p>";
  			}
  		}		
	}
}

// GERMAN (APPLICATION) ----------------------------------------


	if(!empty($_POST["language"])) {
		if(($_POST["language"]) == "german") {
		echo "<h2>Applikation</h2>";
		$info_de = get_participant_info($id, german);
		while($row = mysql_fetch_array($info_de)) {
			if ($row['application'] == '') {
				echo  "<p class='inactive'>Wenn Sie uns helfen wollen, dieses oder andere Dokumente zu übersetzen, <a href='mailto:info@fairytaleproject.net'>nehmen Sie gern Kontakt mit uns auf</a>.</p>";
			}
			else if ($row['application_active'] == 'yes') {
  				echo "<p class='application'>" .$row['application']." </p> <br /><br />";
  				if (!empty($row['credits_for_application'])) {
  				$translators = get_translator($id, 'int');
  				echo "<p>Übersetzung: ".$translators."</p><br/><br/><br />";
  				}
  			} else {
  				echo "<p class='inactive'>Dieses Dokument wird momentan untersucht und wird in Kürze zur Verfügung stehen.</p>";
  			}
  		}		
	}
}
?>
		
		<?
		}
	}

	if(!empty($_POST["content"])) {
		if(($_POST["content"]) == "interview") {
		?>

		<?
	if(!empty($_POST["language"])) {
		if(($_POST["language"]) == "chinese") {
			echo "<h2>访谈</h2>";
		$info_ch = get_participant_info($id, chinese);
		while($row = mysql_fetch_array($info_ch)) {
		if ($row['interview'] == '') {
				echo  "<p class='inactive'>如果您愿意帮助我们翻译这些文件，<a href='mailto:info@fairytaleproject.net'>请联系我们</a>。</p>";
			}

			else if ($row['interview_active'] == 'yes') {
  				echo "<p class='interview'>" .$row['interview']." </p> <br /><br />";
  			} else {
  				echo "<p class='application'>这个文件还在整理中，我们会尽快上传。</p>";
  			}
  		}		
	}
}

	if(!empty($_POST["language"])) {
		if(($_POST["language"]) == "english") {
		echo "<h2>Interview</h2>";
		$info_en = get_participant_info($id, english);
		while($row = mysql_fetch_array($info_en)) {
				if ($row['interview'] == '') {
				echo  "<p class='inactive'>This interview is not yet translated. If you would like to help translate this or other documents, please <a href='mailto:info@fairytaleproject.net'>contact us</a>.</p>";
			}
			else if ($row['interview_active'] == 'yes') {
  				echo "<p class='application'>" .$row['interview']." </p> <br /><br />";
  				if (!empty($row['credits_for_interview'])) {
  				$translators = get_translator($id, 'int');
  				echo "<p>Translation: ".$translators."</p><br/><br/><br />";
  				}
  			} else {
  				echo "<p class='inactive'>This interview is being reviewed and will be released shortly.</p>";
  			}
  		}		
	}
}

	if(!empty($_POST["language"])) {
		if(($_POST["language"]) == "german") {
		echo "<h2>Gespräch</h2>";
		$info_de = get_participant_info($id, german);
		while($row = mysql_fetch_array($info_de)) {
					if ($row['interview'] == '') {
				echo  "<p class='inactive'>Wenn Sie uns helfen wollen, dieses oder andere Dokumente zu übersetzen, <a href='mailto:info@fairytaleproject.net'>nehmen Sie gern Kontakt mit uns auf</a>.</p>";
			}
			else if ($row['interview_active'] == 'yes') {
  				echo "<p class='application'>" .$row['interview']." </p> <br /><br />";
  				if (!empty($row['credits_for_interview'])) {
  				$translators = get_translator($id, 'app');
  				echo "<p>Übersetzung: ".$translators."</p><br/><br/><br />";
  				}
  			} else {
  				echo "<p class='inactive'>Dieses Dokument wird momentan untersucht und wird in Kürze zur Verfügung stehen.</p>";
  			}
  		}		
	}
}
?>

</p>
		<?
		}
	}

	if(!empty($_POST["content"])) {
		if(($_POST["content"]) == "followup") {
		?>

		<?
	if(!empty($_POST["language"])) {
		if(($_POST["language"]) == "chinese") {
		echo "<h2>后续访谈 </h2>";
		$info_ch = get_participant_info($id, chinese);
		while($row = mysql_fetch_array($info_ch)) {
			if ($row['interview_2'] == '') {
				echo  "<p class='inactive'>如果您愿意帮助我们翻译这些文件，<a href='mailto:info@fairytaleproject.net'>请联系我们</a>。</p>";
			}

			else if ($row['interview_2_active'] == 'yes') {
  				echo "<p class='application'>" .$row['interview_2']." </p> <br /><br />";
  	
  			} else {
  				echo "<p class='inactive'>这个文件还在整理中，我们会尽快上传。</p>";
  			}
  		}		
	}
}

	if(!empty($_POST["language"])) {
		if(($_POST["language"]) == "english") {
		echo "<h2>Follow-up interview</h2>";
		$info_en = get_participant_info($id, english);
		while($row = mysql_fetch_array($info_en)) {
			if ($row['interview_2'] == '') {
				echo  "<p class='inactive'>This interview is not yet translated. If you would like to help translate this or other documents, please <a href='mailto:info@fairytaleproject.net'>contact us</a>.</p>";
			}

			else if ($row['interview_2_active'] == 'yes') {
  				echo "<p class='application'>" .$row['interview_2']." </p> <br /><br />";
  				if (!empty($row['credits_for_follow-up'])) {
  				$translators = get_translator($id, 'int2');
  				echo "<p>Translation: ".$translators."</p><br/><br/><br />";
  				}
  			} else {
  				echo "<p class='inactive'>This interview is being reviewed and will be released shortly.</p>";
  			}
  		}	
	}
}

	if(!empty($_POST["language"])) {
		if(($_POST["language"]) == "german") {
		echo "<h2>Nach gespräch</h2>";
		$info_de = get_participant_info($id, german);
		while($row = mysql_fetch_array($info_de)) {
			if ($row['interview_2'] == '') {
				echo  "<p class='inactive'>Wenn Sie uns helfen wollen, dieses oder andere Dokumente zu übersetzen, <a href='mailto:info@fairytaleproject.net'>nehmen Sie gern Kontakt mit uns auf</a>.</p>";
			}

			else if ($row['interview_2_active'] == 'yes') {
  				echo "<p class='application'>" .$row['interview_2']." </p> <br /><br />";
  				if (!empty($row['credits_for_follow-up'])) {
  				$translators = get_translator($id, 'int2');
  				echo "<p>Übersetzung: ".$translators."</p><br/><br/><br />";
  				}
  			} else {
  				echo "<p class='inactive'>Dieses Dokument wird momentan untersucht und wird in Kürze zur Verfügung stehen.</p>";
  			}
  		}	
	}
}
?>

</p>
		<?
		}
	}
}


?>
</div>
</body>
</html>