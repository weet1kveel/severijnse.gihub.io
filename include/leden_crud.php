<?php
/*
** Script voor CRUD operaties voor leden leden.
**
** AANROEP: ExecuteQueryAndShowTable(<tabel>, <array met velden uit tabel>, <crud functie>);
**
*/

require_once("magdelig.php"); // inlog gegevens altijd privé (proberen te) houden !!!!!
	
if (isset($_POST["submit"])) {
	$naam = $_POST["naam"];
	$adres = $_POST["adres"];

	try {
		$conn = new PDO($connection, $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if (isset($_POST["id"])) {
			$id = $_POST["id"];
			if (isset($_POST["gebruiker"])) {
				$gebruiker = $_POST["gebruiker"];
				$wachtwoord = $_POST["wachtwoord"];
			}
			else {
				$gebruiker = "";
				$wachtwoord = "";
			}
			if ($owner == $gebruiker) {
				$sql = "UPDATE leden SET naam = \"".$_POST["naam"]."\", adres = \"".$_POST["adres"]."\", gebruiker = \"".$_POST["gebruiker"]."\", wachtwoord = \"".$_POST["wachtwoord"]."\" WHERE leden.id = ".$_POST["id"].";";
			}
			else {
				$sql = "UPDATE leden SET naam = \"".$_POST["naam"]."\", adres = \"".$_POST["adres"]."\" WHERE leden.id = ".$_POST["id"].";";
			}
		}
		else {
			$gebruiker = $_POST["gebruiker"];
			$wachtwoord = $_POST["wachtwoord"];
			if ($owner == "") {
				$eigenaar = $_POST["gebruiker"];
				$sql = "INSERT INTO leden (naam, gebruiker, wachtwoord, adres, eigenaar)
						VALUES ('".$naam."', '".$gebruiker."', '".$wachtwoord."', '".$adres."', '".$eigenaar."')";
			}
			else {
				$eigenaar = $owner;
				$sql = "INSERT INTO leden (naam, adres, eigenaar)
						VALUES ('".$naam."', '".$adres."', '".$eigenaar."')";
			}
			
			setcookie($cookie_name, $eigenaar, time() + (86400 * 30), "/"); // 86400 = 1 day
			
		}
		$stmt = $conn->prepare($sql);
		// use exec() because no results are returned
		$conn->exec($sql);
		
		if (isset($_POST["id"])) {
			echo "<P>Lid <B>".$naam."</B>(".$id.") is aangepast.</P>";
		}
		else {
			echo "<P>Nieuw lid <U>".$naam."</U> is toegevoegd.</P>";
			//sleep(2);
			header("Refresh:0; url=leden.php?pagina=read");
		}
		
	} catch(PDOException $e) {
		echo $sql . "<br>" . $e->getMessage();
	}

	$conn = null;
	
	require_once("leden_read.php");
}
else {
	if (isset($_POST["delete"])) {
		$id = $_POST["id"];
		$naam = $_POST["naam"];
		
		try {
			$conn = new PDO($connection, $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM leden WHERE leden.id = ".$_POST["id"].";";
			$stmt = $conn->prepare($sql);
			// use exec() because no results are returned
			$conn->exec($sql);
			echo "<P>Lid <B>".$naam."</B>(".$id.") is verwijderd.</P>";
		} catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
		
		require_once("leden_read.php");
		
	}
	else {
	echo "<form action=\"leden.php?pagina=crud\" method=\"post\">";

	if (isset($_POST["edit"])) {
		$id = $_POST["id"];
		$naam = $_POST["naam"];
		$gebruiker = $_POST["gebruiker"];
		$wachtwoord = $_POST["wachtwoord"];
		$adres = $_POST["adres"];
		
		echo "<p>";
		echo "Id:";
		echo "<input type=\"text\" name=\"id\" value=\"".$id."\" readonly>";
		echo "</p>";
	}
	else {
		$naam = "";
		$adres = "";
		$gebruiker = "";
		$wachtwoord = "";
	}
	
	echo "<p>Naam:<input type=\"text\" name=\"naam\" value=\"".$naam."\"></p>";
	if ($owner == "" || $owner == $gebruiker) {
		echo "<p>Gebruiker:<input type=\"text\" name=\"gebruiker\" value=\"".$gebruiker."\" READONLY></p>";
		echo "<p>Wachtwoord:<input type=\"text\" name=\"wachtwoord\" value=\"".$wachtwoord."\"></p>";
	}
	echo "<p>Adres:<textarea name=\"adres\">".$adres."</textarea></p>";
	
	echo "<p>";

	if (isset($_POST["edit"])) {
		echo "<input type=\"submit\" name=\"submit\" value=\"Aanpassen\">";
	}
	else {
		echo "<input type=\"submit\" name=\"submit\" value=\"Maken\">";
	}
	echo "</p>";
	echo "</form>";
}
}
?>