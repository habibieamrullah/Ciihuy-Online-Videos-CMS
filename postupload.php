<?php
include("config.php");
if(isset($_POST["newposttitle"])){
	$newposttitle = mysqli_real_escape_string($connection, $_POST["newposttitle"]);
	$newpostcontent = mysqli_real_escape_string($connection, $_POST["newpostcontent"]);
	$catid = mysqli_real_escape_string($connection, $_POST["catid"]);
	$currenttime = round(microtime(true) * 1000);
	if($newposttitle != "" && $newpostcontent != ""){
		
		$newpicture = "";
		$newvideo = "";
		
		mysqli_query($connection, "INSERT INTO $tableposts (catid, title, content, picture, video, time) VALUES ($catid, '$newposttitle', '$newpostcontent', '$newpicture', '$newvideo', '$currenttime')");
		
		?>
		<h3>Congratulation!</h3>
		<p>New post has been published. Click <a class="textlink" href="#">here</a> to view it.</p>
		<?php
	}else{
		?>
		<h3>Oh no...</h3>
		<p>You did not submit your post correctly. Click <a class="textlink" href="?newpost">here</a> to try again.</p>
		<script>$("#upploadprogresstitle").hide()</script>
		<?php
	}
}