<?php 
    //Start Session
    session_start();

    //Create Constants to Store Non Repeating Values
    define('SITEURL', 'https://unhatched-fuel.000webhostapp.com/');
    $servername = "localhost";
    $username = "id18036114_arnab987";
    $password = "BY&(}bo5DUtp$)vf";
    $database = "id18036114_onlinefoodorder";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    $db_select = mysqli_select_db($conn, $database) or die(mysqli_error()); //SElecting Database

?>