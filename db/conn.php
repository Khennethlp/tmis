<?php

// $servername = "localhost";
// $database = "test";
// $username = "root";
// $password = "";

// try {
//     // Create connection
//     $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    
//     // Set PDO error mode to exception
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
//     echo "Connected successfully";
// } catch(PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }

date_default_timezone_set('Asia/Manila');
$servername = 'localhost'; $username = 'root'; $password = '';

try {
    $conn = new PDO ("mysql:host=$servername;dbname=web_template",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'NO CONNECTION'.$e->getMessage();
}


?>