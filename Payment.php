<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

/*Example of Connection mo, ganito kasi connection ko

$UserFullName = $_POST["UserFullName"];
$UserEmail = $_POST["UserEmail"];
$UserPassword = $_POST["UserPassword"];
*/

try{
    //Links to Connection.php
    require_once "Connection1.php";

    /*Example ng quesry mo sa database mo, ganito example sakin, depende if ano gagamitin mo either (insert,select,delete,update)

    $query = "INSERT INTO user_account(UserFullName, UserEmail, UserPassword) values
    (:UserFullName, :UserEmail, :UserPassword);";
*/
    $stmt = $conn->prepare($query);

    $option = [
        'cost' => 12
    ];

/*    Example ng pag bind ng attribute(yung may : symbol) galing sa database() to variable(yung may $ symbol) na ginawa mo sa php

    $hashPassword = password_hash($UserPassword, PASSWORD_BCRYPT, $option);
    $stmt->bindParam(":UserFullName", $UserFullName);
    $stmt->bindParam(":UserEmail", $UserEmail);
    $stmt->bindParam(":UserPassword", $UserPassword);

    Naman is apra ma execute yung query & code

    $stmt->execute();

    $conn = null;
    $stmt = null;
    header("Location: http://127.0.0.1/CasaHermanasPrincess/index.html");
    die();
    */
}
//Error handling naman to incase na di gumana yung sa try catch block
catch(PDOException $e){
    die("Query Failed: " . $e->getMessage());
}

}else{
    header("Location: .../login-signup.php");
}