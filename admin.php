<?php
//Developed by https://webappdev.my.id/

session_start();
include("config.php");

$username = "313ikmaltv2020";
$password = "%0WJoM@9s$";


?>


<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $websitetitle ?> - Administrator</title>
		<meta charset="utf-8">
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<script
          src="https://code.jquery.com/jquery-3.4.1.min.js"
          integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
          crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">
		
		<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
		
		<script src="tinymce/tinymce.min.js"></script>
		<script>
			tinymce.init({ selector : 'textarea' , plugins : 'directionality, code', toolbar : 'ltr rtl, code', relative_urls: false, remove_script_host : false, });
		</script>
		<script src="jquery.form.js"></script>
		<?php include("style.php"); ?>
		<style>
			body{
				padding: 0px;
				margin: 0px;
				color: white;
			}
			.adminleftbaritem{
				padding: 10px;
				border-bottom: 1px solid #2e2e2e;
				cursor: pointer;
			}
			.adminleftbaritem:hover{
				background-color: white;
				color: black;
				transition: background-color .5s;
			}
			.stickythingy{
				position: -webkit-sticky; /* Safari */
				position: sticky;
				top: 0;
			}
			.bar{
				background-color: <?php echo $maincolor ?>; 
				display: block;
				height: 3px;
				border-radius: 10px;
				width: 0;
			}
		</style>
	</head>
	<body>
		<?php
		//if admin logged in
		if(isset($_SESSION["adminusername"]) && isset($_SESSION["adminpassword"])){
			if($username == $_SESSION["adminusername"] && $password == $_SESSION["adminpassword"]){
				?>
				
				<div style="display: table; position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; height: 100%;">
					<div style="display: table-row; height: 100%;">
						<div style="display: table-cell; width: 140px; background-color: black; height:">
							<div class="stickythingy">
								<div style="padding: 40px;">
									<a href="admin.php"><img src="images/logo.png" style="display: border-box; width: 100%;"></a>
								</div>
								<a href="admin.php"><div class="adminleftbaritem"><i class="fa fa-home" style="width: 30px;"></i> Home</div></a>
								<a href="?newpost"><div class="adminleftbaritem"><i class="fa fa-plus" style="width: 30px;"></i> New Post</div></a>
								<a href="?categories"><div class="adminleftbaritem"><i class="fa fa-tag" style="width: 30px;"></i> Categories</div></a>
								<a href="?settings"><div class="adminleftbaritem"><i class="fa fa-cogs" style="width: 30px;"></i> Settings</div></a>
								<a href="?logout"><div class="adminleftbaritem"><i class="fa fa-sign-out" style="width: 30px;"></i> Logout</div></a>
								
								<!--<div style="text-align: center; padding: 30px; font-size: 8px;">CMS Developed by <a target="_blank" class="textlink" href="https://webappdev.my.id/">https://webappdev.my.id/</a></div>-->
							</div>
						</div>
						<div style="display: table-cell; padding: 25px; vertical-align: top;">
							<?php
							//newpost
							if(isset($_GET["newpost"])){
								?>
								<div class="postform">
									<h1>New Post</h1>
									<form action="postupload.php" method="post" enctype="multipart/form-data">
										<label><i class="fa fa-edit"></i> Title</label>
										<input name="newposttitle" placeholder="Title">
										<label><i class="fa fa-tag"></i> Category</label>
										<select name="catid">
											<?php
											$catsql = "SELECT * FROM $tablecategories ORDER BY category ASC";
											$catresult = mysqli_query($connection, $catsql);
											if(mysqli_num_rows($catresult) > 0){
												while($catrow = mysqli_fetch_assoc($catresult)){
													?>
													<option value="<?php echo $catrow["id"] ?>"><?php echo $catrow["category"] ?></option>
													<?php
												}
											}
											?>
											<option value="0" selected="selected">Uncategorized</option>
										</select>
										<label><i class="fa fa-file"></i> Content</label>
										<textarea name="newpostcontent" style="height: 250px;"></textarea>
										<br><br>
										<label><i class="fa fa-image"></i> Image File</label>
										<input class="fileinput" name="newpicture" type="file" accept="image/jpeg, image/png">
										<label><i class="fa fa-film"></i> Video File</label>
										<input class="fileinput" name="newvideo" type="file" accept="video/mp4">
										<br>
										<input type="submit" value="Submit" class="submitbutton">
									</form>
								</div>
								<div class="progress" style="display: none">
									<div id="upploadprogresstitle">
										<h1>Upload progress <span class="percent">0%</span></h1>
										<div class="bar"></div>
									</div>
									<div id="status" style="margin-top: 30px;"></div>
								</div>
								
								<script>
									$(function() {

										var bar = $('.bar');
										var percent = $('.percent');
										var status = $('#status');

										$('form').ajaxForm({
											beforeSend: function() {
												status.empty();
												var percentVal = '0%';
												bar.width(percentVal);
												percent.html(percentVal);
												$(".progress").slideDown();
												$(".postform").slideUp();
											},
											uploadProgress: function(event, position, total, percentComplete) {
												var percentVal = percentComplete + '%';
												bar.width(percentVal);
												percent.html(percentVal);
											},
											complete: function(xhr) {
												status.html(xhr.responseText);
											}
										});
									}); 
								</script>
								<?php
							
							}
							//categories
							else if(isset($_GET["categories"])){
								?>
								<h1>Categories</h1>
								<?php
								if(isset($_POST["newcategory"])){
									$newcategory = mysqli_real_escape_string($connection, $_POST["newcategory"]);
									if($newcategory != ""){
										mysqli_query($connection, "INSERT INTO $tablecategories (category) VALUES ('$newcategory')");
										echo "<div class='alert'>New category has been added.</div>";
									}
								}
								
								if(isset($_GET["deletecategory"])){
									$id = mysqli_real_escape_string($connection, $_GET["deletecategory"]);
									mysqli_query($connection, "DELETE FROM $tablecategories WHERE id = $id");
									echo "<div class='alert'>One category removed.</div>";
								}
								
								if(isset($_GET["updatecategory"])){
									?>
									<h3><a href="?categories"><i class="fa fa-arrow-left"></i> Back</a></h3>
									<?php
									$id = mysqli_real_escape_string($connection, $_GET["updatecategory"]);
									
									if(isset($_POST["newcategoryupdate"])){
										$newcatname = mysqli_real_escape_string($connection, $_POST["newcategoryupdate"]);
										if($newcatname != ""){
											mysqli_query($connection, "UPDATE $tablecategories SET category = '$newcatname' WHERE id = $id");
											echo "<div class='alert'>Category updated.</div>";
										}
									}
									
									$sql = "SELECT * FROM $tablecategories WHERE id = $id";
									$row = mysqli_fetch_assoc(mysqli_query($connection, $sql));
									?>
									<form method="post">
										<label>Enter new name for category: <?php echo $row["category"] ?></label>
										<input type="text" placeholder="New category name" name="newcategoryupdate" value="<?php echo $row["category"] ?>">
										<input type="submit" value="Update" class="submitbutton">
									</form>
									<?php
								}else{
									$sql = "SELECT * FROM $tablecategories";
									$result = mysqli_query($connection, $sql);
									if(mysqli_num_rows($result) > 0){
										while($row = mysqli_fetch_assoc($result)){
											?>
											<div class="categoryblock"><i class="fa fa-tag"></i> <?php echo $row["category"] ?> <span style="margin-left: 20px; font-size: 12px; color: #535353;"><a href="?categories&updatecategory=<?php echo $row["id"] ?>"><i class="fa fa-edit"></i> edit</a> | <a href="?categories&deletecategory=<?php echo $row["id"] ?>"><i class="fa fa-trash"></i> delete</a></span></div>
											<?php
										}
									}else{
										echo "<p>No category has been added.</p>";
									}
									?>
									<br><br>
									<form method="post">
										<label><i class="fa fa-tag"></i> New category</label>
										<input type="text" placeholder="New category" name="newcategory">
										<input type="submit" value="Add" class="submitbutton">
									</form>
									<?php
								}

							}
							//settings
							else if(isset($_GET["settings"])){
								?>
								<h1>Settings</h1>
								<?php
								if(isset($_POST["websitetitle"])){
									$websitetitle = mysqli_real_escape_string($connection, $_POST["websitetitle"]);
									$maincolor = mysqli_real_escape_string($connection, $_POST["maincolor"]);
									$secondcolor = mysqli_real_escape_string($connection, $_POST["secondcolor"]);
									$baseurl = mysqli_real_escape_string($connection, $_POST["baseurl"]);
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$websitetitle' WHERE config = 'websitetitle'");
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$maincolor' WHERE config = 'maincolor'");
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$secondcolor' WHERE config = 'secondcolor'");
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$baseurl' WHERE config = 'baseurl'");
									echo "<div class='alert'>Settings updated!</div>";
								}
								?>
								<form method="post">
								<?php
								$sql = "SELECT * FROM $tableconfig";
								$result = mysqli_query($connection, $sql);
								while($row = mysqli_fetch_assoc($result)){
									switch($row["config"]){
										case "websitetitle" :
											?>
											<label><i class="fa fa-globe"></i> Website Title</label>
											<input placeholder="Website Title" name="websitetitle" value="<?php echo $row["value"] ?>">
											<?php
											break;
										case "maincolor" :
											?>
											<label><i class="fa fa-paint-brush"></i> Main Color</label>
											<input placeholder="Main Color" name="maincolor" value="<?php echo $row["value"] ?>">
											<?php
											break;
										case "secondcolor" :
											?>
											<label><i class="fa fa-paint-brush"></i> Secondary Color</label>
											<input placeholder="Secondary Color" name="secondcolor" value="<?php echo $row["value"] ?>">
											<?php
											break;
										case "baseurl" :
											?>
											<label><i class="fa fa-link"></i> Base URL</label>
											<input placeholder="Base URL" name="baseurl" value="<?php echo $row["value"] ?>">
											<?php
											break;
									}
								}
								?>
								<input class="submitbutton" type="submit" value="Save">
								</form>
								<?php
							}
							//edit post
							else if(isset($_GET["editpost"])){
								
								$id = mysqli_real_escape_string($connection, $_GET["editpost"]);
								
								if(isset($_POST["editposttitle"])){
									$posttitle = mysqli_real_escape_string($connection, $_POST["editposttitle"]);
									$catid = mysqli_real_escape_string($connection, $_POST["editcatid"]);
									$content = mysqli_real_escape_string($connection, $_POST["editpostcontent"]);
									
									if($posttitle != "" && $content != ""){
										mysqli_query($connection, "UPDATE $tableposts SET title = '$posttitle', catid = $catid, content = '$content' WHERE id = $id");
										echo "<div class='alert'>Post successfully updated.</div>";
									}
									
								}
								
								
								$sql = "SELECT * FROM $tableposts WHERE id = $id";
								$result = mysqli_query($connection, $sql);
								if(mysqli_num_rows($result) > 0){
									$row = mysqli_fetch_assoc($result);
									?>
									<h1>Edit post</h1>
									<form method="post">
										<label><i class="fa fa-edit"></i> Title</label>
										<input name="editposttitle" placeholder="Title" value="<?php echo $row["title"] ?>">
										<label><i class="fa fa-tag"></i> Category</label>
										
										<select name="editcatid">
											<?php
											$catsql = "SELECT * FROM $tablecategories ORDER BY category ASC";
											$catresult = mysqli_query($connection, $catsql);
											if(mysqli_num_rows($catresult) > 0){
												while($catrow = mysqli_fetch_assoc($catresult)){
													if($catrow["id"] == $row["catid"]){
														?>
														<option value="<?php echo $catrow["id"] ?>" selected="selected"><?php echo $catrow["category"] ?></option>
														<?php
													}else{
														?>
														<option value="<?php echo $catrow["id"] ?>"><?php echo $catrow["category"] ?></option>
														<?php
													}
												}
											}
											if($row["catid"] == 0){
												?>
												<option value="0" selected="selected">Uncategorized</option>
												<?php
											}
											?>
										</select>
										
										<label><i class="fa fa-file"></i> Content</label>
										<textarea name="editpostcontent" style="height: 250px;"><?php echo $row["content"] ?></textarea>
										<br><br>
										<input type="submit" value="Update" class="submitbutton">
									</form>
									<?php
								}
							}
							//home
							else{
								?>
								<h1>Home</h1>
								<p>Welcome, administrator! Click <a class="textlink" href="?logout">here</a> to logout.</p>
								<h3><i class="fa fa-file"></i> Published Posts</h3>
								<table style="width: 100%">
									<tr>
										<th style="width: 100px;">Date</th>
										<th>Title</th>
										<th style="width: 50px;">Edit</th>
										<th style="width: 50px;">Delete</th>
									</tr>
									<?php
									$nopost = "";
									$sql = "SELECT * FROM $tableposts ORDER BY id DESC";
									$result = mysqli_query($connection, $sql);
									if(mysqli_num_rows($result) == 0){
										$nopost = "<p>There is no post published.</p>";
									}else{
										while($row = mysqli_fetch_assoc($result)){
											$mil = $row["time"];
											$seconds = $mil / 1000;
											$postdate = date("d-m-Y", $seconds);
											?>
											<tr>
												<td><?php echo $postdate ?></td>
												<td><a href="#"><?php echo $row["title"] ?></a></td>
												<td><a href="?editpost=<?php echo $row["id"] ?>"><i class="fa fa-edit"></i> Edit</a></td>
												<td><a href="?deletepost=<?php echo $row["id"] ?>"><i class="fa fa-trash"></i> Delete</a></td>
											</tr>
											<?php
										}
									}
									?>
								</table>
								<?php
								echo $nopost;
							}
							?>
						</div>
					</div>
				</div>
				
				
				<?php
			}else{
				echo "<div class='alert'>Login error!</div>";
			}
		}
		//not logged in
		else{
			//check login info
			if(isset($_POST["username"]) && isset($_POST["password"])){
				if($username == $_POST["username"] && $password == $_POST["password"]){
					$_SESSION["adminusername"] = $_POST["username"];
					$_SESSION["adminpassword"] = $_POST["password"];
					echo "<div class='alert'>Login success!</div>";
					echo "<script>location.href='admin.php'</script>";
				}else{
					echo "<div class='alert'>Login error!</div>";
				}
			}
			//show login form
			else{
				?>
				<div style="padding: 100px; width: 400px; margin: 0 auto;">
					<h1>Login</h1>
					<form method="post">
						<input type="text" name="username" placeholder="Username">
						<input type="password" name="password" placeholder="Password">
						<input class="submitbutton" type="submit" value="Login">
					</form>
				</div>
				<?php
			}
			
			
		}
		
		//log out
		if(isset($_GET["logout"])){
			session_destroy();
			echo "Bye!";
			echo "<script>location.href='admin.php'</script>";
		}
		?>
		
		<script>
			setTimeout(function(){
				$(".alert").slideUp()
			}, 2000)
		</script>
	</body>
</html>