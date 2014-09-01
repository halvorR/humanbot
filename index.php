<?php session_start(); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<img src="humanBot.png">
<title>HumanBot</title>
<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="style.css" />
</head>

<?php
if(!isset($_SESSION['name'])){
	header("location:login.php");
}
else{
if(isset($_GET['logout'])){	
	
	//Clear file
	$fp = fopen("log.html", 'w');
	fclose($fp);
	
	//Simple exit message
	$fp = fopen("log.html", 'a');
	fwrite($fp, "<div class='msgln'><i>". $_SESSION['name'] ." has left the chat session.</i><br></div>");
	fclose($fp);
	
	session_destroy();
	echo '<script>location.reload(true);</script>'; //Show login form again
}

?>
<div id="wrapper">
	<div id="hvemerdet">
	<?php
		include "botfasit.php";
		if ($rogerbot >0) {
			echo "Det er Roger som er bot";
		}
		$file = "adminlog.php";
		echo $file[1];
		?>
	</div>
	<div id = "bots">
		<?php
			if(file_exists("adminlog.html") && filesize("adminlog.html") > 0){
			$handle = fopen("adminlog.html", "r");
			$contents = fread($handle, filesize("adminlog.html"));
			fclose($handle);
			
			echo $contents;
		}
			if(file_exists("adminlog2.html") && filesize("adminlog2.html") > 0){
			$handle = fopen("adminlog2.html", "r");
			$contents = fread($handle, filesize("adminlog2.html"));
			fclose($handle);
			
			echo $contents;
		}
		?>
	</div>
	<div id="menu">
		<p class="welcome">Velkommen, <b><?php echo $_SESSION['name']; ?></b></p>
		<p class="logout"><a id="exit" href="#">Logg ut</a></p>
		<div style="clear:both"></div>
	</div>	
	<div id="chatbox"><?php
	if(file_exists("log.html") && filesize("log.html") > 0){
		$handle = fopen("log.html", "r");
		$contents = fread($handle, filesize("log.html"));
		fclose($handle);
		
		echo $contents;
	}
	?></div>
	
	<form name="message" method="post">
		<input name="usermsg" type="text" id="usermsg" size="63" />
		<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
	</form>

</div>
	<!-- For å velge bot -->
	<div id="velgBot">
		<form action="valg.php" action="get">
			<p>Hvem tror <span id="du">DU</span> er en bot?</p>
			<input type="radio" value="Bottelars" name="bot"> Bottelars
			<input type="radio" value="Larsebot" name="bot"> Larsebot
			<input type="submit" value="Registrer valg" name="registrer">
		</form>
	</div>
	<div class="clear"></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
	//If user submits the form (Enter key or submit)
	$("#usermsg").keydown(function(e){
		//Optional "user is typing" message (for small group chats)
		//$.post("post.php", {text: "user is typing"});
		
		if(e.keyCode == 13) {
			var clientmsg = $("#usermsg").val();
			$.post("post.php", {text: clientmsg});
			$("#usermsg").val("");
			return false;
		}
	});
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});				
		$("#usermsg").val("");
		return false;
	});
	
	$("#usermsg").focus();
	
	//Load the file containing the chat log
	function loadLog(){		
		var oldscrollHeight = $("#chatbox").prop("scrollHeight") - 20;	
		
		$.ajax({
			url: "log.html",
			cache: false,
			success: function(html){
				var scrolltop = $("#chatbox").scrollTop();//Get current vertical position of scroll bar
				
				
				//Id's used to load only new messages (timewise) into the #chatbox
				var prevmsgid = $("#chatbox div").last().attr('id');
				var newmsgid = $(html).attr('id');				
				if(prevmsgid != newmsgid){
					$("#chatbox").append(html);
				}
				
				//Autoscroll to new bottom of #chatbox if previously at bottom of #chatbox
				var newscrollHeight = $("#chatbox").prop("scrollHeight") - 20;
				if(scrolltop == (oldscrollHeight-270) && newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); 
				}				
		  	},
		});
	}
	
	
	setInterval (loadLog, 70);	//Reload file every 70ms
	
	//If user wants to end session
	$("#exit").click(function(){
		var exit = confirm("Sikker på at du ikke vil prate med HumanBot?");
		if(exit==true){window.location = 'index.php?logout=true';}		
	});
});
</script>
<?php
}
?>
</body>
</html>
