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
	<form id="login" action="" method="post">
		<p>Skriv inn et navn for å chatte med HumanBot!:</p>
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
