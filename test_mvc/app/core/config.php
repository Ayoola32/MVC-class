<?php


if ($_SERVER['SERVER_NAME'] == "localhost") {

    // Databse config
    define("DBNAME", 'myFirstDataBase');
    define("DBHOST", 'localhost');
    define("DBUSER", 'root');
    define("DBPASS", '');

    define("ROOT", 'http://localhost/MVC-class/public');
}else {

    // ONLINE Databse config
    define("DBNAME", 'oop_crud_db');
    define("DBHOST", 'localhost');
    define("DBUSER", 'root');
    define("DBPASS", '');
    
    define("ROOT", 'https://www.mywebsite.com');
}

define('APP_NAME', "My Webiste");
define('APP_DESC', "MVC class");

// Show errors
define('DEBUG', true);