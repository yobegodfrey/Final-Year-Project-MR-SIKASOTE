<?php
    session_start();
    include("DBConnection.php");
    include("links.php");
    include("header.php");

    if(isset($_GET["userId"])) {
        $_SESSION["userId"] = $_GET["userId"];
        header("location: chatbox.php");
    }

    // Hide Errors
    error_reporting(0);
ini_set('display_errors', 0);
    


    $users = mysqli_query($connect, "SELECT * FROM users WHERE ID = '".$_SESSION["userId"]."' ")
            or die("Failed to query database");
            $user = mysqli_fetch_assoc($users);
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
        <title>My Conversation</title>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <p>Hellx`o, <?php echo $user["username"]; ?></p>
                    <input type="text" ID="fromUser" value=<?php echo $user["ID"]; ?> hidden />
                    <p>Send message to:</p>
                    <ul>
                        <?php
                            $messages = mysqli_query($connect, "SELECT * FROM users")
                            or die("Failed to query database");
                            while($message = mysqli_fetch_assoc($messages)) {
                                echo '<li><a href="?toUser='.$message["ID"].'">'.$message["username"].'</a></li>';
                            }
                        ?>
                    </ul>
                    <a href="index.php">Return</a>
                </div>
                <div class="col-md-4">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>
                                    <?php
                                        if(isset($_GET["toUser"])) {
                                            $userName = mysqli_query($connect, "SELECT * FROM users WHERE Id = '".$_GET["toUser"]."'")
                                            or die("Failed to query database");
                                            $uName = mysqli_fetch_assoc($userName);
                                            echo '<input type="text" value='.$_GET["toUser"].' ID="toUser" hidden />';
                                            echo $uName["username"];
                                        } else {
                                            $userName = mysqli_query($connect, "SELECT * FROM users")
                                            or die("Failed to query database");
                                            $uName = mysqli_fetch_assoc($userName);
                                            $_SESSION["toUser"] = $uName["ID"];
                                            echo '<input type="text" value='.$_SESSION["toUser"].' ID="toUser" hidden />';
                                            echo $uName["username"];
                                        }
                                    ?>
                                </h4>
                        </div>
                        <div class="modal-body" ID="msgBody" style="height:400px; overflow-y:scroll; overflow-x:hidden;">
                            <?php
                                if(isset($_GET["toUser"])) {
                                    $chats = mysqli_query($connect, "SELECT * FROM messages where (fromUser = '".$_SESSION["userId"]."' AND toUser = '".$_GET["toUser"]."') OR (fromUser = '".$_GET["toUser"]."' AND toUser = '".$_SESSION["userId"]."')")
                                    or die("Failed to query database");
                                    $chat = mysqli_fetch_assoc($chats);
                                } else {
                                    $chats = mysqli_query($connect, "SELECT * FROM messages where (fromUser = '".$_SESSION["userId"]."' AND toUser = '".$_SESSION["toUser"]."') OR (fromUser = '".$_SESSION["toUser"]."' AND toUser = '".$_SESSION["userId"]."')")
                                    or die("Failed to query database");
                                    while($chat = mysqli_fetch_assoc($chats)) {
                                        if($chat["FromUser"] == $_SESSION["userId"]) {
                                            echo "<div style='text-align: right;'>
                                                <p style='background-color:lightblue; word-wrap:break-word; display:inline-block;
                                                    padding:5px; border-radius:10px; max-width:70%;'>
                                                    ".$chat["Message"]."
                                                </p>
                                            </div>";
                                        } else {
                                            echo "<div style='text-align:left;'>
                                                <p style='background-color:yellow; word-wrap:break-word; display:inline-block;
                                                    padding:5px; border-radius:10px; max-width:70%;'>
                                                    ".$chat["Message"]."
                                                </p>
                                            </div>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <textarea ID="message" class="form-control" style="height:70px;"></textarea>
                            <button ID="send" class="btn btn-primary" style="height:70%;">Send</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                </div>
        </div>
    </body>
    <script type="text/javascript">
        $(document).ready(() => {
            $("#send").on("click", () => {
                $.ajax({
                    url: "insertMessage.php",
                    method: "POST",
                    data: {
                        fromUser: $("#fromUser").val(),
                        toUser: $("#toUser").val(),
                        message: $("#message").val(),
                    },
                    dateType: "text",
                    success: (data) => {
                        $("#message").val();
                    }
                });
            });
            setInterval(() => {
                $.ajax({
                    url: "realTimeChat.php",
                    method: "POST",
                    data: {
                        fromUser: $("#fromUser").val(),
                        toUser: $("#toUser").val(),
                    },
                    dataType: 'text',
                    success: (data) => {
                        $("msgBody").html(data);
                    } 
                })
            }, 700);
        });
    </script>
</html>