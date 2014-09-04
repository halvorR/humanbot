<?php session_start(); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<img src="humanBot.png">
<title>HumanBot</title>
<meta charset="utf-8">
<link type="text/css" rel="stylesheet" href="style.css" />
<script type="text/javascript" src="timer.js"></script>
</head>
<body>

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
	<aside id="infobox">
	<div id="menu">
		<p class="welcome">HEI <b><?php echo $_SESSION['name']; ?></b></p>
		<p class="logout"><a id="exit" href="#">Logg ut</a></p>
	</div>	
		<div id = "bots">
			<?php
			}
			?>
		</div>
		<!-- For å velge bot -->
		<div id="velgBot">
			<form action="valg.php" action="get">
				<p>Hvem tror <span id="du">DU</span> er en bot?</p>
				<input type="submit" value="<?php $file = file("adminlog.html"); echo $file[1]; ?>" name="bot1" class="botGuess">
				<input type="submit" value="<?php $file = file("adminlog2.html"); echo $file[1]; ?>" name="bot2" class="botGuess">
		</div>
	</aside>
	<div id="insideWrapper">
	<div id="chatbox"><?php
	if(file_exists("log.html") && filesize("log.html") > 0){
		$handle = fopen("log.html", "r");
		$contents = fread($handle, filesize("log.html"));
		fclose($handle);
		
		echo $contents;
	}
	?></div>
	<div id="inputfelt">
	<form name="message" method="post">
		<textarea name="usermsg" type="text" id="usermsg" size="63" resize="none"></textarea>
		<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
	</form>
	</div>

</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">


function scrollToBottomChat() {
	var s = $('#chatbox');
    s.scrollTop(
        s[0].scrollHeight - s.height()
    );
}


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

		scrollToBottomChat();
		
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
</div>
</body>
</html>