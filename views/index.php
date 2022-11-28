<?php
    session_start();
    include("DBConnection.php");
    include("links.php");
    include("header.php");

    if(isset($_GET["userId"])) {
        $_SESSION["userId"] = $_GET["userId"];
        header("location: chatbox.php");
    }
?>

<?php 
//hide all errors
    error_reporting(0);
ini_set('display_errors', 0);
?>


 <!-- Denying access if the user is not logged in -->
 <?php
            include_once('../php/functions.php');
            if (!isLoggedIn()) {
                $_SESSION['msg'] = "You must log in first";
                header('location: login.php');
            }
        ?>
        <!-- Denying access if the user is not logged in -->

<!DOCTYPE html>
<html>
    <head>
        <title>Log In</title>
    </head>
    <body>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Choose Your Recipient</h4>
                </div>
                <div class="modal-body">
                    <ol>
                        <?php
                            $users = mysqli_query($connect, "SELECT * FROM users")
                            or die("Failed to query database");
                            while($user = mysqli_fetch_assoc($users)) {
                                echo '
                                    <li>
                                        <a href="chat.php?userId='.$user["ID"].'">' .$user["username"]. '</a>
                                    </li>
                                ';
                            }
                        ?>
                    </ol>
                    <a href="home.php" style="float: right;">Return Home</a>
                </div>
            </div>
        </div>
    </body>
</html>