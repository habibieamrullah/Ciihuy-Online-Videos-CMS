<?php
//Developed by https://webappdev.my.id/

include("config.php");
include("functions.php");

?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $websitetitle ?></title>
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
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>assets/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>slick/slick-theme.css"/>
        <script type="text/javascript" src="<?php echo $baseurl ?>slick/slick.min.js"></script>
		<?php include("style.php"); ?>
	</head>
	<body>
		<div id="header">
			<div class="inlinecenterblock" style="padding: 10px; padding-top: 15px; padding-left: 20px; padding-right: 0px;">
				<a href="index.php"><img src="<?php echo $baseurl ?>images/logo.png" style="width: 48px;"></a>
			</div>
			<div class="inlinecenterblock" style="color: <?php echo $maincolor ?>; font-weight: bold;">
				<h1 style="margin: 0px; font-size: 25px;"><a href="index.php"><?php echo $websitetitle ?></a></h1>
			</div>
			<div class="inlinecenterblock" style="float: right;">
				<div><i class="fa fa-search"></i></div>
			</div>
		</div>
		<div class="section firstthreecontainer">
			<div id="firstthree">
				<?php
				$sql = "SELECT * FROM $tableposts ORDER BY id DESC LIMIT 3";
				$result = mysqli_query($connection, $sql);
				if(mysqli_num_rows($result) == 0){
					echo "<p>No post has been published.</p>";
				}else{
					while($row = mysqli_fetch_assoc($result)){
						$imagefile = $row["picture"];
						if($imagefile == ""){
							$imagefile = "images/filmbg.jpg";
						}else{
							$imagefile = "pictures/" . $imagefile;
						}
						?>
						
						<div class="firstthreeblock" style="background: url(<?php echo $baseurl . $imagefile ?>) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
							<a href="?post=<?php echo $row["postid"] ?>">
								<div style="display: table; width: 100%; height: 100%; background-color: rgba(0,0,0,.5); padding: 40px; box-sizing: border-box; border-radius: 20px;">
									<div class="smallinmobile" style="display: table-cell; width: 75%;">
										<h2><?php echo shorten_text($row["title"], 20, ' ...', true) ?></h2>
										<p><?php echo shorten_text($row["content"], 75, ' ...', true) ?></p>
									</div>
									<div class="hiddeninmobile" style="vertical-align: middle; width: 25%; text-align: center;">
										<div class="morebutton">MORE <i class="fa fa-chevron-right" style="width: 30px;"></i></div>
									</div>
								</div>
							</a>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
		
		<?php 
		$sql = "SELECT * FROM $tablecategories ORDER BY category ASC";
		$result = mysqli_query($connection, $sql);
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				$catid = $row["id"];
				$category = $row["category"];
				$vidsql = "SELECT * FROM $tableposts WHERE catid = '$catid' ORDER BY id DESC LIMIT 10";
				$vidresult = mysqli_query($connection, $vidsql);
				if(mysqli_num_rows($vidresult) > 0){
					?>
					<div class="section">
						<div style="border-bottom: 1px solid #424242; padding-bottom: 20px;">
							<div style="display: inline-block;"><h1 style="font-size: 21px;"><i class="fa fa-tag" style="color: <?php echo $maincolor ?>;"></i> <?php echo $category ?></h1></div>
							<div style="display: inline-block; float: right; margin-top: 8px; color: <?php echo $maincolor ?>;"><a href="?category=<?php echo urlencode($category) ?>">More <i class="fa fa-plus-circle"></i></a></div>
						</div>
					</div>
					<div class="section gridcontainer">
						<?php
						while($vidrow = mysqli_fetch_assoc($vidresult)){
							$imagefile = $vidrow["picture"];
							if($imagefile == ""){
								$imagefile = "images/filmbg.jpg";
							}else{
								$imagefile = "pictures/" . $imagefile;
							}

							?>
							<a href="?post=<?php echo $vidrow["postid"] ?>">
								<div class="filmblock" style="background: url(<?php echo $baseurl . $imagefile ?>) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
									<div style="position: absolute; bottom: 0; left: 0; right: 0; text-align: center; background-color: rgba(0,0,0,.5); padding: 10px; border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
										<h2 style="font-size: 14px;"><?php echo shorten_text($vidrow["title"], 20, ' ...', true) ?></h2>
									</div>
								</div>
							</a>
							<?php

						}
						?>
					</div>
					<?php
				}
			}
		}
		?>
		
		<div class="section footerlink">
		
			<div class="flblock">
				<h3>About <?php echo $websitetitle ?></h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</div>
			
			<div class="flblock">
				<h3>Latest Posts</h3>
				<?php
				$sql = "SELECT * FROM $tableposts ORDER BY id DESC LIMIT 5";
				$result = mysqli_query($connection, $sql);
				if(mysqli_num_rows($result) > 0){
					echo "<ul>";
					while($row = mysqli_fetch_assoc($result)){
						?>
						<li><a href="?post=<?php echo $row["postid"] ?>"><i class="fa fa-circle" style="color: <?php echo $maincolor ?>; width: 20px;"></i> <?php echo $row["title"] ?></a></li>
						<?php
					}
					echo "</ul>";
				}else{
					echo "<p>There is no post published.</p>";
				}
				?>
			</div>
			
			<div class="flblock">
				<h3>Categories</h3>
				<?php
				$sql = "SELECT * FROM $tablecategories ORDER BY category ASC";
				$result = mysqli_query($connection, $sql);
				if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
						?>
						<div class="categoryblock"><a href="?category=<?php echo urlencode($row["category"]) ?>"><i class="fa fa-tag" style="width: 10px;"></i> <?php echo $row["category"] ?></a></div>
						<?php
					}
				}else{
					echo "<p>There is no category published.</p>";
				}
				?>
			</div>
			
	
			
		</div>
		
		<div class="section footercopyright">
			<span>© <?php echo date("Y"); ?> <?php echo $websitetitle; ?>. All rights reserved.</span>
		</div>
		
		
		<script>
			$(document).ready(function(){
                $('#firstthree').slick({
                    autoplaySpeed: 3000,
                    autoplay : true,
                    infinite: true,
                });
            })
		</script>
	</body>
</html>