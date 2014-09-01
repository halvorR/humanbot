<?php session_start(); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<img src="humanBot.png">
<title>HumanBot</title>
<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
	<p>Valget ditt er registrert!</p>
	<?php 
		if($_GET['bot']) {
			echo "<p>Du valgte ".$_GET['bot']."</p>";

			// Skriver til svar.html
			$f = fopen("svar.html", "a");
			$skriv = "Bruker: ". $_SESSION['name']." = ". $_GET['bot'] . "\n";
			fwrite($f, $skriv);
			fclose($f);

		} 
	?>
</body>
</html>