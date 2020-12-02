<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register</title>
    <meta name="News Aggregator" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="icon" type="image/png" href="../images/favicon.ico">
    <script src="../js/jquery-3.5.1.min.js"></script>

</head>

<body>
    <?php
        include("../php/functions.php");
    ?>


    <!-- Nav Bar -->
    <?php
        include('header.php')
    ?> 
    <!-- Nav Bar -->

    <!-- Printing out errors -->
    <div><?php echo $message;?></div>
    <!-- Printing out errors -->

    <!-- Registration Form -->
    <div class="container center_div">

        <form style="margin:50px;" action="register.php" method="post">
            <div class="form-row">
                <label for="username">Username</label>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="username4" name="username" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" name="password" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity" name="city" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <input type="text" id="inputState" class="form-control" name="state" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip" name="zip" required>
                </div>
            </div>
           
            <input type="submit" class="btn btn-primary" value="Register" name='Register'>
        </form>
    </div>
    <!-- Registration Form -->

    <!-- Footer -->
    <?php
        include "footer.php";
    ?>
    <!-- Footer -->
    <script src="../js/bootstrap.js" async defer></script>
</body>

</html>