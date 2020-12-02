<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Users</title>
    <meta name="News Aggregator" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="icon" type="image/png" href="../images/favicon.ico">
    <script src="../js/jquery-3.5.1.min.js"></script>


</head>

<body>
    <?php
        include('../php/functions.php');
    ?>

    <!-- Nav Bar -->
    <?php
        include('header.php')
    ?> 
    <!-- Nav Bar -->

    <!-- User Addition Form -->
    <div><?php echo $message;?></div>
    <div class="container center_div">

        <form style="margin:50px;" action="register.php" method="post">
            <div class="form-row">
                <label for="username">Username</label>
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="username4" name="username" required="required">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="email" required="required">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" name="password" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address" required="required">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity" name="city" required="required">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <input type="text" id="inputState" class="form-control" name="state" required="required">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip" name="zip" required="required">
                </div>
            </div>
           
            <input type="submit" class="btn btn-primary" value="Add User" name='addUsers'>
        </form>
    </div>
    <!-- User Addition Form -->

    <!-- Footer -->
    <?php
        include "footer.php";
    ?>
    <!-- Footer -->

    <script src="../js/bootstrap.js" async defer></script>
</body>
</html>