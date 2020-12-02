<p align="center"><img src="images/favicon.ico"></p>

# News Aggregator

## Description
This is a simple News Aggregator which is built to crawl news from RSS Feeds of **CNN, YAHOO, BBC, INFOWORLD**. This aggregator gets latest news from mentioned sites and show you the title, summary, date and link to the original article.

Apart from the main functionality that is crawling and getting news, it also have a live search feature (can be seen in video linked below). The complete list of features is given below.

## Video Showing All Pages And Functionalities
**Link**: https://youtu.be/91s_3lOZfVQ 

## Pages
1. Home Page
2. News Page
3. Login Page
4. Register Page
5. Contact Page
6. About Page
7. Simple Admin Dashboard
8. Add Users Page (For admins)

## Features
1. Login & Register
2. Admin and user login partition
3. Working contact page (Built using phpmailer)
4. News (RSS Feed) Crawler
5. Live search on the crawled news
6. Addition and deletion of users (Accessible for admins only)

## Accessibility

### For Visitors
Visitors can see **home, contact, about, login and register** pages only

### For Users
Users can visit all the visitor pages and also the **news page** where they can read all news at one place and even do a live search on it.

### For Admins
Admins can visit all the user pages and additionally they have access to **dashboard** and **add users** page, wherein they can add and delete users.

## Instructions (To download and use)

1. Clone the repository `git clone https://github.com/saiteja13427/News-Aggregator.git`
2. Edit **env.php** and add your **db password (for database connection), sender email, sender email password, admin email(reciever email), admin name**.
3. The program will automatically create required database and tables.
4. The program will by default create 1 admin and 1 user account
    `Admin Credentials:
        Username: admin
        Password: admin
    User Credentials:
        Username: user
        Password: user`
5. If you want to add more RSS Feeds to the project, edit **php/getnews.php** and add source name and urls in **rss_urls**
6. The project will be ready for use.
7. Run it on a server and navigate to **views/home.php** to start
8. Once you login and go to **views/news.php**, it will automatically fetch news from rss feed and store it in one of the created table and will display the same as well.

