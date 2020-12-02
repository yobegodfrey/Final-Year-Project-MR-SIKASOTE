<?php
    include_once('functions.php');
    function crawl_rss(&$feed, $url, $source_name) {
        // Not able to get data
        if (!$xml = @simplexml_load_file($url)) return false;
        
        foreach($xml->channel->xpath('//item') as $xml_item){ 
            // Fetch all <item> tags from the XML in the RSS feeds
            $news = false;
            $news['title']		  = strip_tags(trim($xml_item->title));
            $news['description']  = strip_tags(trim($xml_item->description));
            $news['link']		  = strip_tags(trim($xml_item->link));
            $news['date']		  = strtotime($xml_item->pubDate);
            $news['source']	      = $source_name;
            
            $feed[] = $news;
        }
        return $feed;
    }
    
    // URLs to the rss feeds from which we want to get the news
    $rss_urls = array(
        'CNN' => 'http://rss.cnn.com/rss/edition.rss',
        'BBC' => 'http://feeds.bbci.co.uk/news/world/us_and_canada/rss.xml',
        'YAHOO' => 'https://news.yahoo.com/rss/topstories',
        'INFOWORLD' => 'https://www.infoworld.com/news/index.rss'   
    );
    
    //Handling the case if there are no urls
    if (!is_array($rss_urls)) 
        die('The URLs to RSS feed(s) is not provided');

    //Array to store data crawled from RSS feeds  
    $feed = false; 
    foreach ($rss_urls as $name => $url)
        crawl_rss($feed, $url, $name);
    
    if (!$feed) 
        die('No data to display');
    
    
    //Sorting based on date
    usort($feed, function($a, $b) { // sorting an array using date
        return $b['date'] - $a['date']; // comparing dates of 2 items
    });
    
    
    foreach ($feed as $feed_item => $item) {
        //Using 24 hours date format so that we can easily store it in MYSQL    
        $time = date('Y-m-d G:i:s', $item['date']);

        //Getting required fields from every crawled data and storing it into the database
        $title = $item['title'];
        $text = $item['description'];
        $source = $item['source'];
        $link = $item['link'];
        
        //Sql query and storing news into MYSQL
        $query = "INSERT INTO news (title, source, link, summary, publishedtime) VALUES ('$title', '$source', '$link', '$text', '$time')";
        $result = $conn->query($query);
    }
?>    