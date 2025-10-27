<?PHP
$db_server = "internal-db.s147970.gridserver.com";
$db_username = "db147970";
$db_password = "translation2011";		
$db_database = "db147970_fairytale";
$db_prefix = "";

$directus_path = "http://fairytaleproject.net/directus/";

$cms_debug = false;

session_name("DIRECTUS_RTNX");
session_start();
header("Content-Type: text/html; charset=utf-8");

try{
$dbh = new PDO("mysql:host=$db_server;dbname=$db_database;charset=UTF8", $db_username, $db_password);
$dbh->exec("SET CHARACTER SET utf8");
$dbh->query("SET NAMES utf8");

if($cms_debug){
	$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );	// Dev
} else {
	$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );	// Live
}

// Tell other files we have connected
$server_success = true;

} catch(PDOException $e) {
// Log the error
file_put_contents(substr(realpath(dirname(__FILE__)), 0, -3) . "inc/directus_log.txt", date("Y-m-d H:i:s", time()-date("Z",time())) . " - " . $e->getMessage() . "\n", FILE_APPEND);
}

?>