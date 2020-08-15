<?php

//Database connection
$host = "localhost";
$databaseprefix = "ikmaltv_";

$databasename = "admin_ikdb";

//$dbuser = "admin_ikuser";
//$dbpassword = "ikmaltv*123#yahaidar";

$dbuser = "root";
$dbpassword = "";

$connection = mysqli_connect($host, $dbuser, $dbpassword, $databasename);
$connection->set_charset("utf8");

//Database table names
$tableconfig = $databaseprefix . "config";
$tableposts = $databaseprefix . "posts";
$tablecategories = $databaseprefix . "categories";

//Creating tables - config
mysqli_query($connection, "CREATE TABLE IF NOT EXISTS $tableconfig (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
config VARCHAR(150) NOT NULL,
value VARCHAR(1500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
)");

//Creating tables - posts
mysqli_query($connection, "CREATE TABLE IF NOT EXISTS $tableposts (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
catid INT(6) NOT NULL,
postid VARCHAR(70) NOT NULL,
title VARCHAR(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
picture VARCHAR(150) NOT NULL,
video VARCHAR(150) NOT NULL,
time VARCHAR(150) NOT NULL,
views INT(6),
lastviewer VARCHAR(15) NOT NULL,
content VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
)");

//Creating tables - categories
mysqli_query($connection, "CREATE TABLE IF NOT EXISTS $tablecategories (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
category VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
)");

//Default website config values
$websitetitle = "Ciihuy Online Videos";
$maincolor = "#ffae00";
$secondcolor = "#ffc446";
$about = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
$baseurl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$baseurl = str_replace("index.php", "", $baseurl);

//Generating default website config
$sql = "SELECT * FROM $tableconfig";
$result = mysqli_query($connection, $sql);

//Check if its blank
if(mysqli_num_rows($result) == 0){
	//Then generate default values
	$sql = "INSERT INTO $tableconfig (config, value) VALUES ('websitetitle', '$websitetitle');";
	$sql .= "INSERT INTO $tableconfig (config, value) VALUES ('maincolor', '$maincolor');";
	$sql .= "INSERT INTO $tableconfig (config, value) VALUES ('secondcolor', '$secondcolor');";
	$sql .= "INSERT INTO $tableconfig (config, value) VALUES ('about', '$about');";
	$sql .= "INSERT INTO $tableconfig (config, value) VALUES ('baseurl', '$baseurl');";
	
	mysqli_multi_query($connection, $sql);
}else{
	//Then load the website configurations
	while($row = mysqli_fetch_assoc($result)){
		switch($row["config"]){
			case "websitetitle" :
				$websitetitle = $row["value"];
				break;
			case "maincolor" :
				$maincolor = $row["value"];
				break;
			case "secondcolor" :
				$secondcolor = $row["value"];
				break;
			case "about" :
				$about = $row["value"];
				break;
			case "baseurl" :
				$baseurl = $row["value"];
				break;
		}
	}
}



//Creating videos folder
if(!file_exists("videos"))
	mkdir("videos");
//Creating pictures folder
if(!file_exists("pictures"))
	mkdir("pictures");
?>