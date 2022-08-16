<?PHP

require_once("magdelig.php"); // inlog gegevens altijd privé (proberen te) houden !!!!!

echo "<HR>Database connection test<HR>";

try {
  $conn = new PDO($connection, $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  echo "Connected successfully";
  
  $conn = null;
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

echo "<HR>";
?>