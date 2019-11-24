<?php

$CONNECTION;

function connectDatabase() {
    $servername = "127.0.0.1:8889";
    $username = "root";
    $password = "root";
    global $CONNECTION;

    try {
            $CONNECTION = new PDO("mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;dbname=dhbw_blog;", $username, $password);
            // set the PDO error mode to exception
            $CONNECTION->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true; 
        }
    catch(PDOException $e)
        {
            var_dump($e);
            return false;
        }
    }

?>