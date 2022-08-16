<?PHP
/*
** Script voor tonen tabel en eventuele functionel buttons.
**
** Deze toont de tabel. Hooeft nooit aangepast te worden zodner begeleiding van Daniël
**
*/

class TableRows extends RecursiveIteratorIterator {
	private $_page = "read";
	
  function __construct($it, $page = "read") {
	  $this->_page = $page;
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
	  $field = "<input type=\"hidden\" name=\"".parent::key()."\" value=\"".parent::current()."\">";
    return "<td style='width:150px;border:1px solid black;'>".parent::current(). $field. "</td>";
  }

  function beginChildren() {
    echo "<tr>";
	echo "<FORM action=\"leden.php?pagina=crud\" method=\"post\">";
  }
	
  function endChildren() {
		switch ($this->_page) {
			case "update":
				echo "<TD>";
				echo "<input type=\"submit\" name=\"edit\" value=\"Wijzigen\">";
				echo "</FORM>";
				echo "</TD";
			break;

			case "delete":
				echo "<TD>";
				echo "<input type=\"submit\" name=\"delete\" value=\"Afmelden\">";
				echo "</FORM>";
				echo "</TD";
			break;
		
		default:
		break;
	  }

	echo "</tr>" . "\n";
  }
}

function ExecuteQueryAndShowTable($table, $fields, $page) {

require("magdelig.php"); // inlog gegevens altijd privé (proberen te) houden !!!!!
	
try {
  $conn = new PDO($connection, $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "SELECT ".implode(", ", $fields)." FROM ".$table." WHERE eigenaar = \"".$owner."\";";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
  echo "<table style='border: solid 1px black;'>";
  //echo "<TR><TH colspan=".count($fields).">".$sql."</TH></TR>";
  echo "<TR>";
  foreach($fields as $column) {
	  echo "<TH>".$column."</TH>";
  }
  echo "</TR>";
	
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll()), $page) as $k=>$v) {
    echo $v;
  }
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
}

?>