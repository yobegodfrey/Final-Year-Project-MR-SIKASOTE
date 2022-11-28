<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>News</title>
        <meta name="News Aggregator" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="icon" type="image/png" href="../images/favicon.ico">
        <script src="../js/functions.js"></script>
        <script src="../js/jquery-3.5.1.min.js"></script>


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

        <!-- Nav -->
        <?php
            include('header.php')
        ?> 
        <!-- Nav -->

        <!-- News -->  
        <!-- Div to show the news using ajax -->
        <div id="show">
        <!-- Loder -->
        <div class="d-flex justify-content-center text-center">
        <div class="spinner-border text-primary" style="width: 4rem; height: 4rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        </div>
        <!-- Loader -->

        <!-- Ajax function to crawl news, store it and display it -->
        <script>
            getNews();
            showNews();
        </script>
        <!-- Ajax function to crawl news, store it and display it -->
        </div>


        <!-- Footer -->
        <?php
            include "footer.php";
        ?>
        <!-- Footer -->
        
        <script src="../js/bootstrap.js" async defer></script>
        
    </body>
</html>
