<?php
session_start();
if(isset($_SESSION['name'])){
	$text = $_POST['text'];
	
	//Clear file
	$fp = fopen("log.html", 'w');
	fclose($fp);
	
	$fp = fopen("log.html", 'a');	
	fwrite($fp, "<div class='msgln' id=" . time() .">(".date("G:i").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
	fclose($fp);
}
?>
