<?php require_once("functions.php") ?>
<?php require_once("connection.php") ?>
<?php
if (!empty($_POST["participant_lang"])){
$language=mysql_real_escape_string($_POST["participant_lang"]);
}
if (!empty($_POST["gender"])){
$gender=mysql_real_escape_string($_POST["gender"]);
}
if (!empty($_POST["province"])){
$region=mysql_real_escape_string($_POST["province"]);
}
if (!empty($_POST["generation"])){
$year=mysql_real_escape_string($_POST["generation"]);
}
if (!empty($_POST["themes"])){
$tag=mysql_real_escape_string($_POST["themes"]);
}


if (($_POST['participant_lang']) == "0"){
$_SESSION["language"] = "";
} else if (empty($_SESSION["language"])){
$_SESSION["language"] = $language;
} else if (!empty($_POST["participant_lang"])) {
$_SESSION["language"] = $language;
}

if (($_POST['gender']) == "0"){
$_SESSION["gender"] = "";
} else if (empty($_SESSION["gender"])){
$_SESSION["gender"] = $gender;
} else if (!empty($_POST["gender"])) {
$_SESSION["gender"] = $gender;
}

if (($_POST['province']) == "0"){
$_SESSION["region"] = "";
} else if (empty($_SESSION["region"])){
$_SESSION["region"] = $region;
} else if (!empty($_POST["province"])) {
$_SESSION["region"] = $region;
}

if (($_POST['generation']) == "0"){
$_SESSION["year"] = "";
} else if (empty($_SESSION["year"])){
$_SESSION["year"] = $year;
} else if (!empty($_POST["generation"])) {
$_SESSION["year"] = $year;
}

if (($_POST['themes']) == "0"){
$_SESSION["tag"] = "";
} else if (empty($_SESSION["tag"])){
$_SESSION["tag"] = $tag;
 } else if (!empty($_POST["themes"])) {
$_SESSION["tag"] = $tag;
}


 if (($_GET["filter"]) == "reset"){
session_unset();
}
?>
