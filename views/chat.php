<?php
    session_start();
    include("DBConnection.php");
    include("links.php");
    include("header.php");
	
	// Hide Errors
    error_reporting(0);
ini_set('display_errors', 0);

    $reply_text = '';
    $conversation_id = "";
    $userID = "1";
	
    
    if (isset($_GET['conversation_id'])) {
        // main heading must  be ticket information
        
    
        $sql = "SELECT * FROM replies WHERE conversation_id='$conversation_id'";
    
        $result = mysqli_query($connect, $sql);
    
        $replies = mysqli_fetch_all($result, MYSQLI_ASSOC);

		$conversation_id = $_GET['conversation_id'];
    
        // $sql = "SELECT username FROM users INNER JOIN users ON users.ID=replies.user_id WHERE conversation_id='$conversation_id'";
    
        // $result = mysqli_query($conn, $sql);
    
        // $collections = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
        // $collection_id = $collections['0']['collection_id'];
    } elseif (isset($_POST['conversation_id'])) {
        $conversation_id = $_GET['conversation_id'];
    
        $sql = "SELECT * FROM replies WHERE conversation_id='$conversation_id'";
    
        $result = mysqli_query($connect, $sql);
    
        $replies = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    if (isset($_POST['submit'])) {
        //Assign given input data into 
        $reply_text = $_POST['reply_text'];
        $conversation_id = $_POST['conversation_id'];
    
        $reply_text = mysqli_real_escape_string($connect, $_POST['reply_text']);
    
        //query to insert data into database
        $query = "INSERT INTO replies(reply_text,conversation_id,user_id) VALUES('$reply_text',$conversation_id,$userID)";
        mysqli_query($connect, $query);
    
        $sql = "SELECT * FROM replies WHERE conversation_id='$conversation_id'";
        // $sql = "SELECT reply_id,reply_text,conversation_id,user_id,collectors.collector_id,collectors.name,date FROM replies JOIN collectors ON replies.collector_id=collectors.collector_id WHERE conversation_id='$conversation_id'";
    
        $result = mysqli_query($connect, $sql);
    
        $replies = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>

<style>
	.bg-primary {
		background-color: #282D46 !important;
	}

	.card-text,
	.card-title,
	.card-header {
		color: #fff !important;
	}

	.card {
		background-color: #EDC676;
		color: #fff;
	}

	.bg-success {
		background-color: #67BF75 !important;
	}

	.imessage {
		display: flex;
		flex-direction: column;
	}

	.imessage div {
		position: relative;
	}

	.from-me {
		align-self: flex-end !important;
	}

	.from-them {
		align-self: flex-start !important;
	}

	@media screen and (max-width: 800px) {
		body {
			margin: 0 0.5rem;
		}

		.container {
			padding: 0.5rem;
		}

		.imessage {
			margin: 0 auto 1rem;
			max-width: 600px;
		}

		.imessage p {
			margin: 0.5rem 0;
			position: relative;
		}
	}
</style>
<br>

<div style="width: 80%; margin:0 auto">
	<div class="imessage">
		<?php foreach ($replies as $reply) { ?>
			<?php if ($reply['user_id'] == $userID) { ?>
				<div class="card text-white bg-primary mb-3 from-me" style="max-width: 70%;">
					<div class="card-body">
						<h5 class="card-title"><?php echo $reply['reply_text']; ?></h5>
					</div>
				</div>
			<?php } elseif ($reply['user_id'] != $userID) { ?>
				<div class="card text-white bg-success mb-3 from-them" style="max-width: 70%;">
					<div class="card-body">
						<h5 class="card-title"><?php echo $reply['reply_text']; ?></h5>
					</div>
				</div>
			<?php } ?>

		<?php } ?>
	</div>
	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
		<div class="col-md-12 col-sm-12" style="padding: 0;">
			<div class="form-group">
				<input type="text" name="conversation_id" value="1" hidden>
				<textarea class="form-control" rows="5" id="reply_text" name="reply_text" placeholder="Enter your Message..." required></textarea>
			</div>
		</div>
        <div class="col-md-12 col-sm-12" style="padding: 0;">
			<div class="form-group">
				<input type="submit" name="submit" id="submit" class="btn btn-success btn-lg" value="Send" />
				</div>
		</div>
	</form>
</div>
