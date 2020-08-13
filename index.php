<?php
//Developed by https://webappdev.my.id/

include("config.php");
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
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl ?>/assets/css/font-awesome.css">
		
		<?php include("style.php"); ?>
	</head>
	<body>
		<p>Hello world! Main color is <?php echo $maincolor ?>.</p>
	</body>
</html>