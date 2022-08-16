<?PHP
/*
** HTML en script voor leden.
**
** AANROEP: ExecuteQueryAndShowTable(<tabel>, <array met velden uit tabel>, <crud functie>);
**
*/
?>
<!DOCTYPE HTML>

<HTML lang=nl>
	<HEAD>
		<meta charset=utf8>
		<meta name=descreption="Stramien stylesheet">
		<meta name=keywords="css,html">
		
		<TITLE>Birdw8 PEITO20EITA - leden</TITLE>

		<LINK rel="stylesheet" href="css/website.css">
		<link rel="icon" type="image/png" href="img/bird_angrybirds_cartoon_2870.png">
	</HEAD>

<BODY>
	<HEADER class="blok">
		<DIV class="logo">
			<img class="logo" src="img/bird_angrybirds_cartoon_2870.png" alt="Birdwacht">
		</DIV>
		
		<DIV class="logo">
			<P class="logotekst">Birdw8 Demo applicatie</P>
		</DIV>
		
		<DIV class=" logo login">
			<?PHP require_once("include/login.php"); // Inloggen mogelijk maken ?>
		</DIV>
	</HEADER>


		<NAV class="blok">
			<P class="keuzetekst">Hoofdmenu</P>
			<UL>
				<LI class="keuzetekst"><A class="keuzetekst" href="index.php">Start</A></LI>
			</UL>
			<P class="keuzetekst">Lidmaatschap</P>
			<UL>
				<LI class="keuzetekst"><A class="keuzetekst" href="leden.php?pagina=read">Informatie</A></LI>
				<LI class="keuzetekst"><A class="keuzetekst" href="leden.php?pagina=create">Aanmelden</A></LI>
				<LI class="keuzetekst"><A class="keuzetekst" href="leden.php?pagina=update">Wijzigen</A></LI>
				<LI class="keuzetekst"><A class="keuzetekst" href="leden.php?pagina=delete">Afmelden</A></LI>
			</UL>

			<P class="keuzetekst">Aanmelden voor (leden)</P>
			<UL>
				<LI class="keuzetekst"><A class="keuzetekst" href="#">Excursies</A></LI>
				<LI class="keuzetekst"><A class="keuzetekst" href="#">Werkgroepen</A></LI>
			</UL>

			<P class="keuzetekst">Overig</P>
			<UL>
				<LI class="keuzetekst"><A class="keuzetekst" href="#">Social media</A></LI>
				<LI class="keuzetekst"><A class="keuzetekst" href="#">Doneren</A></LI>
				<LI class="keuzetekst"><A class="keuzetekst" href="#">Over ons</A></LI>
			</UL>
		</NAV>

		<MAIN class="blok">
			<H1>Ledenlijst</H1>

			<?PHP
				if (isset($_GET["pagina"]))
					$pagina = $_GET["pagina"];
				else
					$pagina = "read";

				require_once("include/leden_".$pagina.".php"); // Testen of we een connectie kunnen maken
			?>
		</MAIN>


	<FOOTER class="blok">
		<P>De vereniging heet leden en donateurs van harte welkom. Momenteel telt de vereniging circa 485 leden en ongeveer 200 donateurs. Een lid ontvangt dit blad viermaal per jaar en is welkom op alle activiteiten.
		De contributie bedraagt vanaf 2020 minimaal € 25,-. Geef je de voorkeur aan het donateurschap dan kost dat vanaf 2015 minimaal € 8,-- per jaar.</P>
		<P>&copy; 2022 Firma List & Bedrog, subholding van <A href="https://gerritdejager.nl/opdrachten/biereco-bouwmaat/" target="_blank">Biereco</A>.</P>
		<P>INBAN: NL20KNAB0903039184, BTW: NL728597123B61, KVK 123499, Adres: 5103BN, 98, Telefoon: 0555-23-456</P>
	</FOOTER>

</BODY>
</HTML>