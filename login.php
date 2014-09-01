<?php 
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>HumanBot</title>
<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
<img src="humanBot.png" alt="Bilde">

	<div id="loginform">

		<h1>Touringtest</h1>
		<p>Her skal du forsøke å finne ut hvem av de to personene <br/>du mener er bot, og hvem du tror er menneske.</p>
		<p>Det eneste du trenger å gjøre er å velge deg et kallenavn,<br/> og dermed er det bare å spørre i vei!</p>

	<h3>Logg deg inn her!</h3>
	<form id="login" action="" method="post">
		<label for="name">Brukernavn:</label>
		<input type="text" name="name" id="name" />
		<input type="submit" name="enter" id="enter" value="Logg inn" />
	</form>

<?php

	if(isset($_POST['enter'])){
		if($_POST['name'] != ""){
			$_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));	
			header("location:auth.php");
		}
		else {
			echo '<span class="error">Skriv inn et navn!</span>';
		}
	}

?>
	</div>
</body>
</html>
