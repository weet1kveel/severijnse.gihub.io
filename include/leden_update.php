<?php
/*
** Script voor aanpassen van leden.
**
** AANROEP: ExecuteQueryAndShowTable(<tabel>, <array met velden uit tabel>, <crud functie>);
**
*/

require_once("read.php"); // basis read functionality

ExecuteQueryAndShowTable("leden", array("id", "naam", "gebruiker", "wachtwoord", "adres", "nieuwsbrief"), "update");
?>