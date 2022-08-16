<?PHP
/*
** Script voor gegevens database
**
** SVP Aanpassen aan je specifieke omgeving
**
*/

$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "birdw8cht";

// voorbeeld "mysql:host=$servername;dbname=myDB"
$connection = "mysql:host=".$servername.";dbname=".$database;

$cookie_name = "user";
if(isset($_COOKIE[$cookie_name])) {
	$owner = $_COOKIE[$cookie_name];
}
else {
	$owner = "";
}
?>