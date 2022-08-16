<?PHP
require("magdelig.php"); // inlog gegevens altijd privé (proberen te) houden !!!!!

if (isset($_POST["logout"])) {
	setcookie($cookie_name, "", time() - 3600, "/"); // in het verleden

	unset($_COOKIE[$cookie_name]);
	unset($_POST["logout"]);
}

if (isset($_POST["login"])) {
	try {
		$conn = new PDO($connection, $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT wachtwoord FROM leden WHERE gebruiker = \"".$_POST["username"]."\"  LIMIT 1";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	
		$cookie_value = "";
		foreach($stmt->fetchAll() as $row) {
			if ($row["wachtwoord"] == $_POST["password"]) {
				$cookie_value = $_POST["username"];
			}
		}

	} catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
	$conn = null;

	if ($cookie_value == "") {
		echo "<P>Aanmelden met ".$_POST["username"]." is mislukt.";
	}
	else {
		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

		header("Refresh:0");
	}		
	
	unset($_POST["login"]);
}
else {
	if(isset($_COOKIE[$cookie_name])) {
		echo "<P>Welkom ".$_COOKIE[$cookie_name]."</P>";
		echo "<FORM class=\"login\" method=\"POST\" action=\"index.php\">";
		echo "<P>";
		echo "	<input type=\"submit\" name=\"logout\" value=\"Afmelden\">";
		echo "</P>";
		echo "</FORM>";
	}
	else {
		echo "<FORM class=\"login\" method=\"POST\" action=\"index.php\">";
		echo "<P>";
		echo "	<label for=\"username\" class=\"sr-only\">Gebruiker</label>";
		echo "	<input type=\"text\" name=\"username\" class=\"form-control\" placeholder=\"Username\" required>";
		echo "<P>";
		echo "<P>";
		echo "	<label for=\"inputPassword\" class=\"sr-only\">Wachtwoord</label>";
		echo "	<input type=\"password\" name=\"password\" id=\"inputPassword\" class=\"form-control\" placeholder=\"Passwordc\" required>";
		echo "</P>";
		echo "<P>";
		echo "	<input type=\"submit\" name=\"login\" value=\"Aanmelden\">";
		echo "</P>";
		echo "</FORM>";
	}
}

?>