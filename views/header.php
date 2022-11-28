<!-- Functions to find the active navigation menu item -->
<?php
function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);  
  if($currect_page == $url){
      echo 'active'; //class name in css 
  } 
}

function disabled($currect_page){
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);  
    if($currect_page == $url){
        echo 'disabled'; //class name in css 
    } 
  }
?>
<!-- Functions to find the active navigation menu item -->

<!-- Main Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Brand (Logo and brand name) -->
    <img src="../images/favicon.ico" alt="logo">
    <a class="navbar-brand" href="home.php"><b>News</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Brand (Logo and brand name) -->

    <!-- Navigation menu items -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item <?php active('home.php');?>">
            <a class="nav-link" href="home.php">Home</a>
        </li>
        <li class="nav-item <?php active('news.php');?>">
            <a class="nav-link" href="news.php">News</a>
        </li>
        <li class="nav-item <?php active('contact.php');?>">
            <a class="nav-link" href="contact.php">Contact</a>
        </li>
        </li>
        <li class="nav-item <?php active('about.php');?>">
            <a class="nav-link" href="about.php">About</a>
        </li> 
            <a class="nav-link" href="index.php">Chat</a>
        <?php
            if (isset($_SESSION['admin'])) {
                echo
                '<li class="nav-item active">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                </li>
                <li class="nav-item active">
                        <a class="nav-link" href="addUsers.php">Add Users</a>
                </li>
                <li class"nav-item active">
                <a href="exportData.php" class="btn btn-success"><i class="dwn"></i> Export</a>
                </li>'
                ;
            }
        ?>
        </ul>
        <!-- Navigation menu items -->

        <?php
            // Login, Register and Logout
            if (!isset($_SESSION['user'])) {
                echo "
                <ul class='nav nav-pills justify-content-end'>
                    <li class='nav-item'>
                        <a class='nav-link' href='login.php'>Login</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link <?php disabled(`register.php`);?>' href='register.php'>Register</a>
                    </li>
                </ul>";
            }else{
                echo "
                <ul class='nav nav-pills justify-content-end'>
                    <li class='nav-item'>
                        <a class='nav-link' href='login.php?logout'>Logout</a>
                    </li>
                </ul>";
            }
            // Login, Register and Logout Functionality

            // Live search bar
            $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
            $url = end($url_array);
            if($url=='news.php'){
                echo '<form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" onkeyup="searchNews(this.value)">
               
                </form>';
            }
            // Live search bar
        ?>
        
    </div>
</nav>
<!-- Main Navigation Bar -->
