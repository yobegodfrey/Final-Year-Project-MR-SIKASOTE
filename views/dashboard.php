<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <meta name="News Aggregator" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="icon" type="image/png" href="../images/favicon.ico">
    <script src="../js/jquery-3.5.1.min.js"></script>


</head>
<body>
    <?php
        include("../php/functions.php");
        if (!isAdmin()) {
            $_SESSION['msg'] = "Access Denied to this page";
            header('location: login.php');
        }
    ?>    
    <!-- Nav Bar -->
    <?php
        include("header.php");
    ?> 
    <!-- Nav Bar -->
    <!-- All Messages -->
    <?php echo $message?>
    <!-- All Messages -->

    <!-- Instruction -->
    <div class=" col mb-4">
        <div class="card">
            <div class="card-body">
                You cannot delete <strong>Admin</strong> and <strong>User</strong> users as they are created by default. You can delete all other users!!!
            </div>
        </div>
    </div>
    <!-- Instruction -->
    
    <!-- Getting all the users in the database with a delete option -->
    <?php 
        $query = "SELECT * FROM users";
        $results = $conn->query($query);
    
        if($results){
            while ($row = $results->fetch_assoc()) {
                // I used standard US date format and 12-hours time format, but you may set custom format, depending on location of visitor. See manual on PHP date() function.
                // You you prefer European and 24-hours format -- use 'd.m.Y G:i:s'.           
                $username = $row['username'];
                $email = $row['email'];
                $address = $row['address'];
                $city = $row['city'];
                $state = $row['state'];
                $zip = $row['zip'];
                $usertype = $row['user_type'];
    
                
                print <<<END
                <div class="col mb-4">
                <div class="card">
                END;
                if($usertype!='admin' and $username!='user'){
                    echo
                    '<div class="card-header">
                    <ul class="nav nav-pills card-header-pills justify-content-end">
                    <li class="nav-item">
                    <a class="nav-link active" href="dashboard.php?user='.$username.'">Delete User</a>                                
                    </li>
                    </form>
                    </div>';
                }
                print<<<END
                <div class="card-body">
                    <h5 class="card-title p-3 mb-2 bg-dark text-white"><strong>Username: $username </strong><span class="badge badge-primary"> $usertype</span></h5> 
                    <p class="card-subtitle p-3 mb-2 bg-warning text-dark">Email: $email</p>
                    <p class="card-text p-3 mb-2 bg-primary text-white">Address: $address<br>
                    City: $city<br>
                    State: $state<br>
                    Zip: $zip</p>
                </div>
                </div>
                </div>
                </div>
                END;
            } 
        } else {
            return NULL;
        }
    ?>
    <!-- Getting all the users in the database with a delete option -->

    <!-- Footer -->
        <?php
            include "footer.php";
        ?>
    <!-- Footer -->
    
    <script src="../js/bootstrap.js" async defer></script>

</body>
</html>
