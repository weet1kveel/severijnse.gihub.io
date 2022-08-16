<?php
/*
** Script voor tonen van leden.
**
** AANROEP: ExecuteQueryAndShowTable(<tabel>, <array met velden uit tabel>, <crud functie>);
**
*/
require_once("read.php"); // basis read functionality

ExecuteQueryAndShowTable("leden", array("id", "naam", "adres", "nieuwsbrief"), "read");
?>