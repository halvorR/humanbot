<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<img src="humanBot.png">
<title>HumanBot</title>
<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<?php
session_start();

	echo'
	<div id="loginform">
	<form action="admin.php" method="post">
		<p>Skriv inn et navn for å BLI HumanBot!:</p>
		<input type="checkbox" name="botknapp1" id="bottknapp1"/>
		<label for="name">Roger:</label>
		<input type="text" name="name1" id="name1" />
		<input type="submit" name="enter1" id="enter1" value="Sett botnavn" />
	</form>
	</div>
	';

if(isset($_POST['enter1'])){
	if($_POST['name1'] != ""){
		$_SESSION['name1'] = stripslashes(htmlspecialchars($_POST['name1']));
		
		//Clear file
		$fp = fopen("adminlog.html", 'w');
		fclose($fp);

		// Skriver hvem som er bot til fil
		if (isset($_POST['botknapp1'])) {
			$fp = fopen("botfasit.php", 'w');
			fwrite($fp, '<?php $rogerbot =  1; ?>');
			fclose($fp);
		}
		
		$fp = fopen("adminlog.html", 'a');
		fwrite($fp, "<div class='adminlog' id=" . time() ."><i>". $_SESSION['name1'] ." er chattebot 1!</i><br></div>");
		fclose($fp);
	}
	else{
		echo '<span class="error">Skriv inn et navn!</span>';
	}
}
?>
<?php
	echo'
	<div id="loginform">
	<form action="admin.php" method="post">
		<p>Skriv inn et navn for å BLI HumanBot!:</p>
		<input type="checkbox" name="botknapp2" id="bottknapp2"/>
		<label for="name">Halvor:</label>
		<input type="text" name="name2" id="name2" />
		<input type="submit" name="enter2" id="enter2" value="Sett botnavn" />
	</form>
	</div>
	';

if(isset($_POST['enter2'])){
	if($_POST['name2'] != ""){
		$_SESSION['name2'] = stripslashes(htmlspecialchars($_POST['name2']));
		
		//Clear file
		$fp = fopen("adminlog2.html", 'w');
		fclose($fp);

		// Skriver hvem som er bot til fil
		if (isset($_POST['botknapp2'])) {
			$fp = fopen("botfasit.php", 'w');
			fwrite($fp, '<?php $rogerbot = 0; ?>');
			fclose($fp);
		}
		
		$fp = fopen("adminlog2.html", 'a');
		fwrite($fp, "<div class='adminlog2' id=" . time() ."><i>". $_SESSION['name2'] ." er chattebot 2!</i><br></div>");
		fclose($fp);
	}
	else{
		echo '<span class="error">Skriv inn et navn!</span>';
	}
}
?>
</body>
</html>