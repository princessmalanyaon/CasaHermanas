<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
$UserFullName = $_POST["UserFullName"];
$UserEmail = $_POST["UserEmail"];
$UserPassword = $_POST["UserPassword"];


    // Check if any of the form fields are empty
    if(empty($UserFullName) || empty($UserEmail) || empty($UserPassword)) {
        echo '<script>alert("Fill all fields");</script>';
        echo '<script>window.history.back();</script>';
        exit(); // Stop further execution of the code
    }

try{
    //Links to Connection.php
    require_once "Connection1.php";
    $query = "INSERT INTO user_account(UserFullName, UserEmail, UserPassword) values
    (:UserFullName, :UserEmail, :UserPassword);";

    $stmt = $conn->prepare($query);

    $option = [
        'cost' => 12
    ];

    $hashPassword = password_hash($UserPassword, PASSWORD_BCRYPT, $option);

    $stmt->bindParam(":UserFullName", $UserFullName);
    $stmt->bindParam(":UserEmail", $UserEmail);
    $stmt->bindParam(":UserPassword", $UserPassword);

    $stmt->execute();

    $conn = null;
    $stmt = null;
    header("Location: http://127.0.0.1/CasaHermanasPrincess/index.html");
    die();
}

catch(PDOException $e){
    die("Query Failed: " . $e->getMessage());
}

}else{
    header("Location: .../login-signup.php");
}