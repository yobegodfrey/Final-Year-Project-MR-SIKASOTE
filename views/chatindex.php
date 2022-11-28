<?php 
include("../php/functions.php");
include("./header.php");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Home</title>
        <meta name="News Aggregator" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="icon" type="image/png" href="../images/favicon.ico">
        <script src="../js/jquery-3.5.1.min.js"></script>

    <title>Chat</title>
</head>
<body>
 <!-- Denying access if the user is not logged in -->
     <?php
            include_once('../php/functions.php');
            if (!isLoggedIn()) {
                $_SESSION['msg'] = "You must log in first";
                header('location: login.php');
            }
        ?>
        <!-- Denying access if the user is not logged in -->

       
    

    <?php
        include "footer.php";
        ?>
</body>
</html>