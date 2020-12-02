<!-- Getting news from the database -->
<?php
    include_once('../php/functions.php');

    // The condition to see if user has searched something
    if(isset($_GET['search'])){
        $searchterm = $_GET['search'];
        $query = "SELECT * FROM news WHERE title LIKE '%$searchterm%' OR summary LIKE '%$searchterm%' OR source LIKE '%$searchterm%' ORDER BY publishedtime DESC;";
        $results = $conn->query($query);
    }else{
        $query = "SELECT * FROM news ORDER BY publishedtime DESC;";
        $results = $conn->query($query);
    }

    // Getting the news from database
    if($results){
        if($results->num_rows > 0){
            while ($row = $results->fetch_assoc()) {
                $title = $row['title'];
                $text = $row['summary'];
                $source = $row['source'];
                $link = $row['link'];
                $time = $row['publishedtime'];

                print <<<END
                <div class="col mb-4">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><a href="$link" target="_blank">$title </a>| <strong>$source</strong></h5>
                    <p class="card-text">$text</p>
                    <p class="card-text ">$time</p>
                </div>
                </div>
                </div>
                END;}
        }else{
            // If there is no matching news term
            print <<<END
                    <div class="col mb-4">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">No Search Related News Found</h5>
                    </div>
                    </div>
                    </div>
                END;
        }
        
    } else {
        //If there is no news
        print <<<END
                    <div class="col mb-4">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">No News Found</h5>
                    </div>
                    </div>
                    </div>
                END;
    }

?>    