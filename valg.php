<?php session_start(); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<img src="humanBot.png">
<title>HumanBot</title>
<meta charset="utf-8">
<meta http-equiv="refresh" content="10;URL=login.php">
<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
	<p>Valget ditt er registrert!</p>
	<?php 
	include 'botfasit.php';
	if(isset($_GET['bot1'])) {	
		if($rogerbot > 0) {
			echo "<p>Du valgte ".$_GET['bot1'].". DET VAR RIKTIG!</p>";

			// Skriver til svar.html
			$f = fopen("svar.html", "a");
			$skriv = "<p>Bruker: ". $_SESSION['name']." = ". $_GET['bot1'] . " | RIKTIG</p>\n";
			fwrite($f, $skriv);
			fclose($f);

			session_destroy();
		} else {
			echo "<p>Du valgte ".$_GET['bot1'].". DET VAR FEIL</p>";

			// Skriver til svar.html
			$f = fopen("svar.html", "a");
			$skriv = "<p>Bruker: ". $_SESSION['name']." = ". $_GET['bot1'] . " | FEIL</p>\n";
			fwrite($f, $skriv);
			fclose($f);

			session_destroy();
		}
	}	

	if(isset($_GET['bot2'])) {
			if($rogerbot > 0) {
			echo "<p>Du valgte ".$_GET['bot2'].". DET VAR FEIL!</p>";

			// Skriver til svar.html
			$f = fopen("svar.html", "a");
			$skriv = "<p>Bruker: ". $_SESSION['name']." = ". $_GET['bot2'] . " | FEIL</p>\n";
			fwrite($f, $skriv);
			fclose($f);

			session_destroy();
		} else {
			echo "<p>Du valgte ".$_GET['bot2'].". DET VAR RIKTIG</p>";

			// Skriver til svar.html
			$f = fopen("svar.html", "a");
			$skriv = "<p>Bruker: ". $_SESSION['name']." = ". $_GET['bot2'] . " | RIKTIG</p>\n";
			fwrite($f, $skriv);
			fclose($f);

			session_destroy();
		}
	}
	?>
</body>
</html>