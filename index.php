<?php
//Developed by https://webappdev.my.id/

include("config.php");
include("functions.php");
include("uilang.php");

?>

<!DOCTYPE html>
<html>
	<head>
		
		<?php
		
		if(isset($_GET["post"])){
			$postid = mysqli_real_escape_string($connection, $_GET["post"]);
			$sql = "SELECT * FROM $tableposts WHERE postid = '$postid'";
			$result = mysqli_query($connection, $sql);
			if($result){
				$title = shorten_text(mysqli_fetch_assoc($result)["title"], 40, ' ...', false) . " - " . $websitetitle;
			}
			?>
			
			<?php
		}else if(isset($_GET["category"])){
			$title = urldecode($_GET["category"]) . " - " . $websitetitle;
		}else if(isset($_GET["search"])){
			$title = urldecode($_GET["search"]) . " - " . $websitetitle;
		}else{
			$title = $websitetitle;
		}
		
		?>
		
		<title><?php echo $title ?></title>
		
		<meta charset="utf-8">
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<script
          src="https://code.jquery.com/jquery-3.4.1.min.js"
          integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
          crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>assets/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>slick/slick-theme.css"/>
        <script type="text/javascript" src="<?php echo $baseurl ?>slick/slick.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>sharingbuttons.css"/>
		<?php include("style.php"); ?>
	</head>
	<body>
		<div id="header">
			<div class="inlinecenterblock" style="padding: 10px; padding-top: 15px; padding-left: 20px; padding-right: 0px;">
				<?php
				$currentlogo = "images/logo.png";
				if($logo != "")
					$currentlogo = "pictures/" . $logo;
				?>
				<a href="index.php"><img src="<?php echo $baseurl . $currentlogo ?>" style="height: 48px;"></a>
			</div>
			<div class="inlinecenterblock" style="color: <?php echo $maincolor ?>; font-weight: bold;">
				<h1 style="margin: 0px; font-size: 25px;"><a href="index.php"><?php echo $websitetitle ?></a></h1>
			</div>
			<div class="inlinecenterblock" style="float: right;" onclick="togglesearch()">
				<div class="searchbutton"><i class="fa fa-search"></i></div>
			</div>
		</div>
		
		<?php 
		//search
		if(isset($_GET["search"])){
			$q = mysqli_real_escape_string($connection, urldecode($_GET["search"]));
			if($q != ""){
				$sql = "SELECT * FROM $tableposts WHERE title LIKE '%$q%' OR content LIKE '%$q%' ORDER BY id DESC";
				$result = mysqli_query($connection, $sql);
				?>
				<div class="section">
					<div class="catseparator">
						<div style="display: inline-block;"><h1 style="font-size: 21px;"><i class="fa fa-search" style="color: <?php echo $maincolor ?>;"></i> <?php echo uilang("Search result for") ?> "<?php echo $q ?>"</h1></div>
					</div>
				</div>
				<?php
				if(mysqli_num_rows($result) > 0){
					//result found
					?>
					<div class="section gridcontainerunscrollable">
						<?php
						while($vidrow = mysqli_fetch_assoc($result)){
							$imagefile = $vidrow["picture"];
							if($imagefile == ""){
								$imagefile = "images/filmbg.jpg";
							}else{
								$imagefile = "pictures/" . $imagefile;
							}
							
							showfilmblock($vidrow, $baseurl, $imagefile, $maincolor);

						}
						?>
					</div>
					<?php
				}else{
					?>
					<div class="section gridcontainerunscrollable">
						<p><?php echo uilang("Nothing found") ?>.</p>
					</div>
					<?php
				}
			}
		}
		
		//category
		else if(isset($_GET["category"])){
			$category = urldecode(mysqli_real_escape_string($connection, $_GET["category"]));
			if($category != ""){
				$sql = "SELECT * FROM $tablecategories WHERE category = '$category'";
				$result = mysqli_query($connection, $sql);
				if(mysqli_num_rows($result) > 0){
					$row = mysqli_fetch_assoc($result);
					$catid = $row["id"];
					$vidsql = "SELECT * FROM $tableposts WHERE catid = '$catid' ORDER BY id DESC";
					$vidresult = mysqli_query($connection, $vidsql);
					if(mysqli_num_rows($vidresult) > 0){
						?>
						<div class="section">
							<div class="catseparator">
								<div style="display: inline-block;"><h1 style="font-size: 21px;"><i class="fa fa-tag" style="color: <?php echo $maincolor ?>;"></i> <?php echo $category ?></h1></div>
							</div>
						</div>
						<div class="section gridcontainerunscrollable">
							<?php
							while($vidrow = mysqli_fetch_assoc($vidresult)){
								$imagefile = $vidrow["picture"];
								if($imagefile == ""){
									$imagefile = "images/filmbg.jpg";
								}else{
									$imagefile = "pictures/" . $imagefile;
								}
								
								showfilmblock($vidrow, $baseurl, $imagefile, $maincolor);

							}
							?>
						</div>
						<?php
					}
				}
			}
		}
		//post
		else if(isset($_GET["post"])){
			?>
			<div class="section">
				<div class="posttableblock">
					<div class="postcontent">
						<?php
						$postid = mysqli_real_escape_string($connection, $_GET["post"]);
						if($postid != ""){
							$sql = "SELECT * FROM  $tableposts WHERE postid = '$postid'";
							$result = mysqli_query($connection, $sql);
							if(mysqli_num_rows($result) == 0){
								echo "<p>" .uilang("Nothing found"). "</p>";
							}else{
								$row = mysqli_fetch_assoc($result);
								
								$picture = $row["picture"];
								$video = $row["video"];
								
								if($picture != ""){
									$picture = $baseurl . "pictures/" . $picture;
								}
								
								if($video != ""){
									if(file_exists("videos/" . $video)){
										$video = $baseurl . "videos/" . $video
										?>
										<video id="webvideo" poster="<?php echo $picture ?>" controls controlsList="nodownload">
											<source src="<?php echo $video ?>" type="video/mp4">
											Your browser does not support the video tag.
										</video>
										<img src="images/cinemaseat.png" style="width: 100%">
										<?php
									}
								}
								
								$mil = $row["time"];
								$seconds = $mil / 1000;
								$postdate = date("d-m-Y", $seconds);
								?>
								
								<h1><?php echo $row["title"] ?></h1>
								<h5 style="color: <?php echo $maincolor ?>"><i class="fa fa-calendar" style="width: 15px;"></i> <?php echo $postdate ?> <i class="fa fa-eye" style="margin-left: 15px; width: 15px;"></i> <?php echo $row["views"] ?> <a href="?category=<?php echo urlencode(showcatname($row["catid"])) ?>"><i class="fa fa-tag" style="margin-left: 15px; width: 15px;"></i> <?php echo showCatName($row["catid"]) ?></a></h5>
								<div>
									<?php echo $row["content"] ?>
								</div>
								<div style="font-size: 12px;">
								<?php
								showSharer($baseurl . "?post/" . $row["postid"], $websitetitle);
								?>
								</div>
								<br><br>
								
								<div style="width: 100%; box-sizing: border-box; background-color: white; border-radius: 20px; padding: 14px;">
									<div id="fb-root"></div>
									<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&amp;version=v5.0&amp;appId=569420283509636&amp;autoLogAppEvents=1"></script>
									 
									<div class="fb-comments" data-href="<?php echo $baseurl ?>?post/<?php echo $row["postid"] ?>" data-width="100%"  data-numposts="14"></div>
								</div>
								
								
								<script>
									function viewedThis(postid){
										$.post("<?php echo $baseurl ?>viewcounter.php", {
											postid : postid
										}, function(data){
											console.log(data)
										})
									}
									viewedThis("<?php echo $postid ?>")
								</script>
								<?php
							}
						}
						?>
					</div>
					<div class="randomvids">
						<div class="randomvidblock"><?php echo uilang("You may like:") ?></div>
						<?php
						$sql = "SELECT * FROM $tableposts ORDER BY RAND() LIMIT 10";
						$result = mysqli_query($connection, $sql);
						if(mysqli_num_rows($result) > 0){
							while($row = mysqli_fetch_assoc($result)){
								?>
								<a href="?post=<?php echo $row["postid"] ?>">
									<div class="randomvidblock">
										<?php
										$imagefile = $row["picture"];
										if($imagefile == ""){
											$imagefile = "images/filmbg.jpg";
										}else{
											$imagefile = "pictures/" . $imagefile;
										}
										?>
										<div class="lilimage" style="background: url(<?php echo $baseurl . $imagefile ?>) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"></div>
										<div class="lildescr">
											<div class="shorttext" style="font-size: 18px; font-weight: bold;">
												<?php echo $row["title"] ?>
											</div>
											<div style="padding-left: 14px;">
												<p><?php echo shorten_text(strip_tags($row["content"]), 75, ' ...', false) ?></p>
											</div>
											<div style="padding-left: 14px;">
												<p style="color: <?php echo $maincolor ?>; font-size: 12px; font-weight: bold;"><i class="fa fa-eye" style="margin-left: 5px; width: 10px;"></i> <?php echo $row["views"] ?> <i class="fa fa-tag" style="margin-left: 5px; width: 10px;"></i> <?php echo showCatName($row["catid"]) ?></p>
											</div>
											
										</div>
									</div>
								</a>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}
		//home
		else{
			?>
		
			<div class="firstthreecontainer">
				<div id="firstthree">
					<?php
					$sql = "SELECT * FROM $tableposts ORDER BY id DESC LIMIT 14";
					$result = mysqli_query($connection, $sql);
					if($result){
						if(mysqli_num_rows($result) == 0){
							echo "<p>" .uilang("There is no post published"). ".</p>";
						}else{
							while($row = mysqli_fetch_assoc($result)){
								$imagefile = $row["picture"];
								if($imagefile == ""){
									$imagefile = "images/filmbg.jpg";
								}else{
									$imagefile = "pictures/" . $imagefile;
								}
								?>
								
								<div class="firstthreeblock" style="height: 250px; width: 100%; background: url(<?php echo $baseurl . $imagefile ?>) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
									<a href="?post=<?php echo $row["postid"] ?>">
										<div class="firstthreeblocktextholder">
											<div class="farbottom smallinmobile w75">
												<div class="paddingonmobile">
													<h2><?php echo shorten_text($row["title"], 40, ' ...', true) ?></h2>
													<p><?php echo shorten_text(strip_tags($row["content"]), 256, ' ...', false) ?></p>
												</div>
											</div>
											<div class="smallinmobile w25" style="vertical-align: middle; text-align: center;">
												<div class="morebutton"><?php echo uilang("WATCH") ?> <i class="fa fa-play-circle" style="width: 30px;"></i></div>
											</div>
										</div>
									</a>
								</div>
								<?php
							}
						}
					}
					
					?>
				</div>
				
			</div>
			
			<?php 
			$sql = "SELECT * FROM $tablecategories ORDER BY category ASC";
			$result = mysqli_query($connection, $sql);
			if($result){
				if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
						$catid = $row["id"];
						$category = $row["category"];
						$vidsql = "SELECT * FROM $tableposts WHERE catid = '$catid' ORDER BY id DESC LIMIT 40";
						$vidresult = mysqli_query($connection, $vidsql);
						if(mysqli_num_rows($vidresult) > 0){
							?>
							<div class="section">
								<div class="catseparator">
									<div style="display: inline-block;"><h1 style="font-size: 21px;"><i class="fa fa-tag" style="color: <?php echo $maincolor ?>;"></i> <?php echo $category ?></h1></div>
									<div style="display: inline-block; float: right; margin-top: 8px; color: <?php echo $maincolor ?>;"><a class="moreoncat" href="?category=<?php echo urlencode($category) ?>"><?php echo uilang("See More") . " " ?> <i class="fa fa-plus-circle"></i></a></div>
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
									
									showfilmblock($vidrow, $baseurl, $imagefile, $maincolor);
								}
								?>
							</div>
							<?php
						}
					}
				}
			}else{
				?>
				<script>
					alert("WELCOME!\nClick OK to start.\nIf this message appears again, please check that you have correct database connection.")
					location.reload()
				</script>
				<?php
			}
			
		}
		
		?>
		
		<!-- Footer -->
		
		
		<div class="section footerlink" style="padding-top: 75px;">
			<div class="flblock">
				<h2><?php echo uilang("Categories") ?></h2>
				<?php
				$sql = "SELECT * FROM $tablecategories ORDER BY category ASC";
				$result = mysqli_query($connection, $sql);
				if($result){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_assoc($result)){
							?>
							<div class="categoryblock"><a href="?category=<?php echo urlencode($row["category"]) ?>"><i class="fa fa-tag" style="width: 20px;"></i> <?php echo $row["category"] ?></a></div>
							<?php
						}
					}else{
						echo "<p>" . uilang("There is no category published.") . "</p>";
					}
				}
				
				?>
			</div>
		</div>
		
		<div class="section footerlink">
			<div class="flblock">
				<h2><?php echo uilang("Recently Published") ?></h2>
				<?php
				$sql = "SELECT * FROM $tableposts ORDER BY id DESC LIMIT 12";
				$result = mysqli_query($connection, $sql);
				if($result){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_assoc($result)){
							?>
							<div class="categoryblock"><a href="?post=<?php echo $row["postid"] ?>"><i class="fa fa-film" style="width: 20px;"></i> <?php echo $row["title"] ?></a></div>
							<?php
						}
					}else{
						echo "<p>" . uilang("There is no post published") . ".</p>";
					}
				}
				
				?>
			</div>
		</div>
		
		<div class="section footerlink">
			<div class="flblock">
				<h2><?php echo uilang("Top 10 Videos") ?></h2>
				<?php
				$sql = "SELECT * FROM $tableposts ORDER BY views DESC LIMIT 10";
				$result = mysqli_query($connection, $sql);
				if($result){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_assoc($result)){
							
							$imagefile = $row["picture"];
							if($imagefile == ""){
								$imagefile = "images/filmbg.jpg";
							}else{
								$imagefile = "pictures/" . $imagefile;
							}
							
							?>
							<a href="?post=<?php echo $row["postid"] ?>">
								<div style="display: inline-block; margin: 10px; text-align: center; width: 75px; vertical-align: top;">
									<div style="display: inline-block; border: 1px solid white; height: 96px; width: 64px; background: url(<?php echo $baseurl . $imagefile ?>) no-repeat center center; background-size: cover; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;"></div>
									<p style="margin: 10px; font-size: 10px;"><?php echo $row["title"] ?></p>
								</div>
							</a>
							
							<?php
						}
					}else{
						echo "<p>" . uilang("There is no post published") . ".</p>";
					}
				}
				
				?>
			</div>
		</div>
		
		<div class="section footerlink" style="padding-bottom: 75px;">
			<div class="flblock">
				<h2><?php echo uilang("About") . " " . $websitetitle ?></h2>
				<?php echo $about ?>
			</div>
		</div>
		
		<div class="section footercopyright">
			<span>© <?php echo date("Y"); ?> <?php echo $websitetitle; ?>. All rights reserved.</span>
		</div>
		
		<div>
			<img src="images/cinemaseat.png" style="width: 100%;">
		</div>
		
		<div id="searchui">
			<div class="sinputcontainer">
				<h3><i class="fa fa-search"></i> <?php echo uilang("Search") ?></h3>
				<input type="text" id="searchinput" placeholder="<?php echo uilang("Type something...") ?>" onkeyup="startsearch()">
			</div>
		</div>
		
		<script>
			$(document).ready(function(){
                $('#firstthree').slick({
                    autoplaySpeed: 3000,
                    autoplay : true,
                    infinite: true,
					arrows : false,
                });
            })
			
			function togglesearch(){
				$("#searchui").fadeToggle()
				$("#searchinput").focus()
			}
			
			var searchtimeout
			function startsearch(){
				clearTimeout(searchtimeout)
				searchtimeout = setTimeout(function(){
					location.href = "?search=" + encodeURI($("#searchinput").val())
				}, 2000)
			}
			
			//check does it match baseurl
			var baseurl = "<?php echo $baseurl ?>"
			if(location.href.substring(0,10) != baseurl.substring(0,10))
				location.href = "<?php echo $baseurl ?>"
		</script>
	</body>
</html>