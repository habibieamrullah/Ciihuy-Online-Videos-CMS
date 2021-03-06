<?php
include("config.php");
include("thumbnailgenerator.php");
include("uilang.php");

if(isset($_POST["newposttitle"])){
	$newposttitle = mysqli_real_escape_string($connection, $_POST["newposttitle"]);
	$newpostcontent = mysqli_real_escape_string($connection, $_POST["newpostcontent"]);
	$catid = mysqli_real_escape_string($connection, $_POST["catid"]);
	$currenttime = round(microtime(true) * 1000);
	if($newposttitle != "" && $newpostcontent != ""){
		
		$postid = substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 5)), 0, 10);
		$newpicture = "";
		$newvideo = "";
		
		
		//Picture upload
		if(isset($_FILES["newpicture"])){
			$maxsize = 524288;
			if($_FILES["newpicture"]["size"] == 0){
				//
			}else{
				if($_FILES['newpicture']['error'] > 0) { echo "<div class='alert'>" .uilang("Error during uploading. Try again"). "</div>"; }
				$extsAllowed = array( 'jpg', 'jpeg', 'png' );
				$uploadedfile = $_FILES["newpicture"]["name"];
				$extension = pathinfo($uploadedfile, PATHINFO_EXTENSION);
				if (in_array($extension, $extsAllowed) ) { 
					$newpicture = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 10);
					$name = "pictures/" . $newpicture .".". $extension;
					
					if(($_FILES['newpicture']['size'] >= $maxsize)){
						createThumbnail($_FILES['newpicture']['tmp_name'], "pictures/" . $newpicture .".". $extension, 512);
					}else{
						$result = move_uploaded_file($_FILES['newpicture']['tmp_name'], $name);
					}
					?>
					<div class="alert"><?php echo uilang("Picture upload is OK") ?>.</div>
					<?php
					$newpicture = $newpicture .".". $extension;
					
				} else { echo "<div class='alert'>".uilang("File is not valid. Please try again").".</div>"; }
			}
		}
		
		
		//Video upload
		if(isset($_FILES["newvideo"])){
			if($_FILES["newvideo"]["size"] == 0){
				//
			}else{
				if($_FILES['newvideo']['error'] > 0) { echo "<div class='alert'>" .uilang("Error during uploading. Try again"). "</div>"; }
				$extsAllowed = array( 'mp4' );
				$uploadedfile = $_FILES["newvideo"]["name"];
				$extension = pathinfo($uploadedfile, PATHINFO_EXTENSION);
				if (in_array($extension, $extsAllowed) ) { 
					$newvideo = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 10);
					$name = "videos/" . $newvideo .".". $extension;
					$result = move_uploaded_file($_FILES['newvideo']['tmp_name'], $name);
					?>
					<div class="alert"><?php echo uilang("Video upload is OK") ?>.</div>
					<?php
					$newvideo = $newvideo .".". $extension;
					
				} else { echo "<div class='alert'>".uilang("File is not valid. Please try again").".</div>"; }
			}
		}
			
		mysqli_query($connection, "INSERT INTO $tableposts (postid, catid, title, content, picture, video, time, views) VALUES ('$postid', $catid, '$newposttitle', '$newpostcontent', '$newpicture', '$newvideo', '$currenttime', 0)");
		
		?>
		<h3><?php echo uilang("Congratulation!") ?></h3>
		<p><?php echo uilang("New post has been published. Click") ?> <a class="textlink" href="index.php?post=<?php echo $postid ?>" target="_blank"><?php echo uilang("here") ?></a> <?php echo uilang("to view it") ?>.</p>
		<?php
	}else{
		?>
		<h3><?php echo uilang("Oh no...") ?></h3>
		<p><?php echo uilang("You did not submit your post correctly. Click") ?> <a class="textlink" href="?newpost"><?php echo uilang("here") ?></a> <?php echo uilang("to try again") ?>.</p>
		<script>$("#upploadprogresstitle").hide()</script>
		<?php
	}
}