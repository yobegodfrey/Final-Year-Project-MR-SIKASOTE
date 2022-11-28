<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>About</title>
        <meta name="News Aggregator" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="icon" type="image/png" href="../images/favicon.ico">
        <script src="../js/jquery-3.5.1.min.js"></script>


    </head>
    <body>
        <!-- Starting session and Adding NavBar -->
        <?php 
            session_start();
            include("header.php");
        ?>
        <!-- Nav -->

        <!-- About Block -->
        <div class="jumbotron container center_div">
            <h1>About This Project</h1>
            <hr class="my-4">
            <p>This project was built as a data collection tool for different Zambian local languages, which will enable the building of different models or systems</p>
            <p class="lead"> Built By: <b>GODFREY MKANDAWIRE</b> <br> Supervisor: <b>CLAYTONE SIKASOTE</b></p>
            <a class="btn btn-primary" href="news.php" role="button">Read News</a>
        </div>
        <!-- About Block -->
        
        <!-- Footer -->
        <?php
            include "footer.php";
        ?>
        <!-- Footer -->

        <script src="../js/bootstrap.js" async defer></script>
        <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6317dac037898912e967a7a3/1gcait0s2';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

    </body>
</html>