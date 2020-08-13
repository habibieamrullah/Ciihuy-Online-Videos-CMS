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
		
		<?php include("style.php"); ?>
		<style>
			body{
				padding: 0px;
				margin: 0px;
				color: white;
			}
			.adminleftbaritem{
				padding: 10px;
				border-bottom: 1px solid gray;
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
						<div style="display: table-cell; width: 200px; background-color: black; height:">
							<div class="stickythingy">
								<div style="padding: 40px;">
									<a href="admin.php"><img src="images/logo.png" style="display: border-box; width: 100%;"></a>
								</div>
								<a href="admin.php"><div class="adminleftbaritem"><i class="fa fa-home"></i> Home</div></a>
								<div class="adminleftbaritem"><i class="fa fa-home"></i> Add Videos</div>
								<a href="?settings"><div class="adminleftbaritem"><i class="fa fa-cogs"></i> Settings</div></a>
								<a href="?logout"><div class="adminleftbaritem"><i class="fa fa-sign-out"></i> Logout</div></a>
							</div>
						</div>
						<div style="display: table-cell; padding: 25px; vertical-align: top;">
							<?php
							if(isset($_GET["settings"])){
								?>
								<h1>Settings</h1>
								<?php
								if(isset($_POST["websitetitle"])){
									$websitetitle = mysqli_real_escape_string($connection, $_POST["websitetitle"]);
									$maincolor = mysqli_real_escape_string($connection, $_POST["maincolor"]);
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$websitetitle' WHERE config = 'websitetitle'");
									mysqli_query($connection, "UPDATE $tableconfig SET value = '$maincolor' WHERE config = 'maincolor'");
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
											<label>Website Title</label>
											<input placeholder="Website Title" name="websitetitle" value="<?php echo $row["value"] ?>">
											<?php
											break;
										case "maincolor" :
											?>
											<label>Main Color</label>
											<input placeholder="Main Color" name="maincolor" value="<?php echo $row["value"] ?>">
											<?php
											break;
									}
								}
								?>
								<input type="submit" value="Save">
								</form>
								<?php
							}else{
								?>
								<h1>Home</h1>
								<p>Welcome, Administrator! Click <a class="textlink" href="?logout">here</a> to logout.</p>
								<?php
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
						<input type="submit" value="Login">
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
	</body>
</html>