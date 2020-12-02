<?php
include('../php/autoload.php');
// $username = env('DB_USERNAME');
// $password = env('DB_PASSWORD');
// $host = env('DB_HOST');

$username = 'root';
$password = 'S1a2i3p4@';
$host = 'localhost';

// Create connection
$conn = new mysqli($host, $username, $password);


if($conn->connect_error){
	;
	die("Database connection failed: ".$conn->connect_error );
}


$sql = "USE news;";
$conn->query($sql);

if($conn->errno == "1049"){
	$sql = "CREATE DATABASE news;";
	$conn->query($sql);
	//echo "Database don't exist created successfully \n";
	$conn->select_db("news");
}elseif($conn->errno == "0"){
	//echo "Database already exists \n";
}else{
	die("Database creation failed: ".$conn->error);
}


$sql = "DESCRIBE TABLE users;";
$conn->query($sql);

if($conn->errno == "1146"){
	$sql = "CREATE TABLE users(
			username VARCHAR(100) NOT NULL UNIQUE,
            email VARCHAR(100) NOT NULL,
			password CHAR(40) NOT NULL,
			address VARCHAR(255) NOT NULL,
            city VARCHAR(255) NOT NULL,
            state VARCHAR(100) NOT NULL,
            zip VARCHAR(6) NOT NULL
			)";
	$conn->query($sql);	
	//echo "Table created successfully";	
}elseif($conn->errno == "0"){
	//echo "Table exists already\n";
}else {
	die("Table creation failed: ".$conn->error);
}

$sql = "DESCRIBE TABLE news;";
$conn->query($sql);

if($conn->errno == "1146"){
	$sql = "CREATE TABLE news(
                title VARCHAR(255) NOT NULL,
                link VARCHAR(255) NOT NULL,
                summary TEXT NULL,
                publishedtime DATETIME NULL DEFAULT NULL
            )";   
	$conn->query($sql);	
	//echo "Table created successfully";	
}elseif($conn->errno == "0"){
	//echo "Table exists already\n";
}else {
	die("Table creation failed: ".$conn->error);
}

?>