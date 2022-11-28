<?php 
session_start();

include('../env.php');
$username = $DB_USERNAME;
$password = $DB_PASSWORD;
$host = $DB_HOST;
// connect to database
$conn = new mysqli($host, $username, $password);

if($conn->connect_error){
	die("Database connection failed: ".$conn->connect_error );
}
//Table creation if table is not there
$sql = "USE chatbox;";
$conn->query($sql);

if($conn->errno == "1049"){
	$sql = "CREATE DATABASE chatbox;";
	$conn->query($sql);
	$conn->select_db("chatbox");
}elseif($conn->errno == "0"){
	//echo "Database already exists \n";
}else{
	die("Database creation failed: ".$conn->error);
}

/*TABLE CREATION */
//Creating User Table
$sql = 'SELECT username FROM users;';

if($conn->query($sql) == NULL){
	$sql = "CREATE TABLE `users`(
			`ID` INT(9) NOT NULL AUTO_INCREMENT,
			`username` VARCHAR(100) NOT NULL UNIQUE,
            `email` VARCHAR(100) NOT NULL,
			`password` CHAR(40) NOT NULL,
			`address` VARCHAR(255) NOT NULL,
            `city` VARCHAR(255) NOT NULL,
            `state` VARCHAR(100) NOT NULL,
            `zip` VARCHAR(6) NOT NULL,
            `user_type` VARCHAR(20),
			PRIMARY KEY(ID)
			);";
	$conn->query($sql);	
	//echo "Table created successfully";	
}elseif($conn->errno == "0"){
	//echo "Table exists already\n";
}else {
	die("Table creation failed: ".$conn->error);
}

//Creating News Table
$sql = "SELECT title FROM chatbox;";

if($conn->query($sql) == NULL){
	$sql = "CREATE TABLE `chatbox`(
                `title` VARCHAR(255) NOT NULL,
				`source` VARCHAR(50) NOT NULL,
                `link` TINYTEXT UNIQUE,
                `summary` TINYTEXT,
                `publishedtime` TIMESTAMP
            );";   
	$conn->query($sql);	
	//echo "Table created successfully";	
}elseif($conn->errno == "0"){
	//echo "Table exists already\n";
}else {
	die("Table creation failed: ".$conn->error);

	/* --CREATING MESSAGES TABLE-- */
	$sql = 'SELECT FromUser FROM messages;';

if($conn->query($sql) == NULL){
	$sql = "CREATE TABLE `messages`(
			`Id` INT NOT NULL AUTO_INCREMENT,
			`FromUser` INT(100) NOT NULL,
            `ToUser` INT(100) NOT NULL,
			`Message` VARCHAR(1000),
			
			PRIMARY KEY(Id)
			);";
	$conn->query($sql);	
	//echo "Table created successfully";	
}elseif($conn->errno == "0"){
	//echo "Table exists already\n";
}else {
	die("Table creation failed: ".$conn->error);
}
}
/*END OF TABLE CREATION*/


/*ADMIN AND USER LOGS CREATION*/
$query = "SELECT * FROM users WHERE user_type='admin'";
$results = mysqli_query($conn, $query);
$password = md5('admin');
if (mysqli_num_rows($results) == 0) {
$sql = "INSERT INTO users (username, email, password, address, city, state, zip, user_type) VALUES ('admin', 'admin@gmail.com', '$password', 'California', 'California', 'California State', '800037', 'admin')";
			$result = mysqli_query($conn,$sql);
}	

$query = "SELECT * FROM users WHERE username='user'";
$results = mysqli_query($conn, $query);
$password = md5('user');
if (mysqli_num_rows($results) == 0) {
	$sql = "INSERT INTO users (username, email, password, address, city, state, zip, user_type) VALUES ('user', 'user@gmail.com', '$password', 'California', 'California', 'California State', '800037', 'user')";
				$result = mysqli_query($conn,$sql);
}


$query = "SELECT * FROM users WHERE username='demo'";
$results = mysqli_query($conn, $query);
$password = md5('demo');
if (mysqli_num_rows($results) == 0) {
	$sql = "INSERT INTO users (username, email, password, address, city, state, zip, user_type) VALUES ('demo', 'demo@gmail.com', '$password', 'California', 'California', 'California State', '800037', 'user')";
				$result = mysqli_query($conn,$sql);
}
/* ADMIN AND USER LOGS CREATION*/


// Variable declaration
$username = "";
$email    = "";
$errors   = array(); 
$message = "";

// Calling register function if register button is clicked
if (isset($_POST['Register'])){
	register();
}

// Function to register user
function register(){
	// Call these variables with the global keyword to make them available in function
	global $username, $email, $conn, $message;

	//Getting all the inputs from registration form
	$username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $zip = trim($_POST['zip']);
	
	// Register user if there are no errors in the form

	$password = md5($password); //Password encryption using md5 encryption	
	if(!(getUserByEmail($email)) and !(getUserByUsername($username)) ){	
		$sql = "INSERT INTO users (username, email, password, address, city, state, zip, user_type) VALUES ('$username', '$email', '$password', '$address', '$city', '$state', '$zip', 'user')";
		
		$result = mysqli_query($conn,$sql);
		if($result){
			$message =  "<div class='alert alert-success' role='alert'>
			Registration Successful
			</div>";
		}else{
			$message =  "<div class='alert alert-danger' role='alert'>
			Registration Failed ".mysqli_error($conn) ."
			</div>";
		}
	}else{
		$message =  "<div class='alert alert-danger' role='alert'>
			Registration Failed! Email/Username Already In Use".mysqli_error($conn) ."
			</div>";
        }				
    
}

// Calling login function if login button is clicked
if (isset($_POST['Login'])) {
	login();
}

// Function to login user
function login(){
	global $conn, $username, $errors, $message;

	// grap form values
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	// attempt login if no errors on form
	$password = md5($password);

	$query = "SELECT * FROM users WHERE username='$username' AND password='$password';";
	$result = $conn->query($query);

	if ($result->num_rows == 1) { // user found
		// check if user is admin or user
		$logged_in_user = $result -> fetch_assoc();;
		if ($logged_in_user['user_type'] == 'admin') {

			$_SESSION['user'] = $logged_in_user;
			$_SESSION['admin'] = $logged_in_user;
			$_SESSION['success']  = "You are now logged in";
			header('location: dashboard.php');		  
		}else{
			$_SESSION['user'] = $logged_in_user;
			$_SESSION['success']  = "You are now logged in";

			header('location: home.php');
		}
	}else {
		$message =  "<div class='alert alert-danger' role='alert'>
			Wrong username/password combination
			</div>";
	}
}

// Return user array using their email
function getUserByEmail($email){
	global $conn;
	$query = "SELECT * FROM users WHERE email='$email';";
	$result = $conn->query($query);

	$user = $result -> fetch_assoc();
	return $user;
}
// Return user array using their username
function getUserByUsername($username){
	global $conn;
	$query = "SELECT * FROM users WHERE username='$username';";
	$result = $conn->query($query);

	$user = $result->fetch_assoc();
	return $user;
}

// Function to check if a user is logged in
function isLoggedIn(){
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// Function to check if a user is admin
function isAdmin(){
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// Function to log out a user
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	unset($_SESSION['admin']);
	header("location: login.php");
}

// Calling removeUser function if delete user button is clicked
if(isset($_GET['user'])){
	removeUser($_GET['user']);
}

// Function to remove users
function removeUser($username){
	global $conn, $errors, $message;
	$query = "DELETE FROM users WHERE username='$username';";
	$result = $conn->query($query);
	if($result){
		$message = "<div class='alert alert-success' role='alert'>
					Successfull deleted user  with Username = ".$username." 
                	</div>";
	}else{
		$message = "<div class='alert alert-danger' role='alert'>
					Oops some error while deleting user! Couldn't delete user!!
                	</div>";
	}
}

// Calling addUser function if Add User button is clicked
if (isset($_POST['addUsers'])){
	addUsers();
}

// Function to add users from admin dashboard
function addUsers(){
	global $username, $email, $conn, $message;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $address = trim($_POST['address']);
    $city = trim($_POST['city']);
    $state = trim($_POST['state']);
    $zip = trim($_POST['zip']);
	
	// register user if there are no errors in the form
	
	$password = md5($password);//encrypt the password before saving in the database	
	if(!(getUserByEmail($email)) and !(getUserByUsername($username)) ){	
		$sql = "INSERT INTO users (username, email, password, address, city, state, zip, user_type) VALUES ('$username', '$email', '$password', '$address', '$city', '$state', '$zip', 'user')";
		
		$result = mysqli_query($conn,$sql);
		if($result){
			$message =  "<div class='alert alert-success' role='alert'>
			User Added Successfully
			</div>";
		}else{
			$message =  "<div class='alert alert-danger' role='alert'>
			User Addition Failed ".mysqli_error($conn) ."
			</div>";
		}
	}else{
		$message =  "<div class='alert alert-danger' role='alert'>
			User Addition Failed! Username Already In Use".mysqli_error($conn) ."
			</div>";
	}				
}
?>