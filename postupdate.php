<?php
include("config.php");
include("thumbnailgenerator.php");
include("uilang.php");

if(isset($_POST["editposttitle"]) && isset($_POST["id"])){
	$id = mysqli_real_escape_string($connection, $_POST["id"]);
	$posttitle = mysqli_real_escape_string($connection, $_POST["editposttitle"]);
	$catid = mysqli_real_escape_string($connection, $_POST["editcatid"]);
	$content = mysqli_real_escape_string($connection, $_POST["editpostcontent"]);
	$customvideo = mysqli_real_escape_string($connection, $_POST["editvideofilename"]);
	
	if($posttitle != "" && $content != ""){
		
		$sql = "SELECT * FROM $tableposts WHERE id = $id";
		$result = mysqli_query($connection, $sql);
		if(mysqli_num_rows($result) > 0){
			
			$row = mysqli_fetch_assoc($result);
			
			$oldpicture = $row["picture"];
			$oldvideo = $customvideo;
			
			if($row["video"] != $customvideo){
				if($row["video"] != ""){
					if(file_exists("videos/" . $row["video"])){
						unlink("videos/" . $row["video"]);
					}
				}
			}
			
			//Picture upload
			if(isset($_FILES["newpicture"])){
				$maxsize = 524288;
				if($_FILES["newpicture"]["size"] == 0){
					$newpicture = $oldpicture;
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
						
						//delete previous media
						if($oldpicture != ""){
						if(file_exists("pictures/" . $oldpicture))
							unlink("pictures/" . $oldpicture);
						}
					} else { 
						echo "<div class='alert'>".uilang("File is not valid. Please try again").".</div>";
						$newpicture = $oldpicture;
					}
				}
			}else{
				$newpicture = $oldpicture;
			}
			
			
			//Video upload
			if(isset($_FILES["newvideo"])){
				if($_FILES["newvideo"]["size"] == 0){
					$newvideo = $oldvideo;
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
						
						//delete previous media
						if($oldvideo != ""){
						if(file_exists("videos/" . $oldvideo))
							unlink("videos/" . $oldvideo);
						}
						
					} else { 
					
						echo "<div class='alert'>".uilang("File is not valid. Please try again").".</div>";
						$newvideo = $oldvideo;
						
					}
				}
			}else{
				$newvideo = $oldvideo;
			}
			
			mysqli_query($connection, "UPDATE $tableposts SET title = '$posttitle', catid = $catid, content = '$content', picture = '$newpicture', video = '$newvideo' WHERE id = $id");
			echo "<div class='alert'>" . uilang("Post successfully updated.") . "</div>";
		
		}
	}	
}