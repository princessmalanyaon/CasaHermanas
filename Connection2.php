<?php
$servername = "127.0.0.1";
$username = "root";
$password = "Banzuela@bicoluni";
$dbname = "CasaHermanas";

try {
    //Objects for Connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //echo "Connection Successo";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "Connection Failed: " . $e->getMessage();
    }