<?php 
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>HumanBot</title>
<meta charset="utf-8">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>
<body>
<img src="humanBot.png" alt="Bilde">

<div id="loginform">
	<?php
	echo "<p>Du logger nå inn som <h1>".$_SESSION['name']."</h1></p>";
	echo "<form action='index.php' form='post' id='videre'>";
	echo "<input type='submit' name='videre' value='Flott! Gå til chatterom!'>";
	echo '</form>';

		if(isset($_POST['videre'])){
		//Clear file
		$fp = fopen("log.html", 'w');
		fclose($fp);
	
		$fp = fopen("log.html", 'a');
		fwrite($fp, "<div class='msgln' id=" . time() ."><i>". $_SESSION['name'] ." har logget på!</i><br></div>");
		fclose($fp);
	}
	?>
</div>

</body>
</html>
