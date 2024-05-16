<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Username = htmlspecialchars($_POST["name"]);
    $Useremail = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $Usercheckin_date_time = $_POST["checkin"];
    $Usercheckout_date_time = $_POST["checkout"];
    $Useradults = intval($_POST["Adult"]);
    $Userchildren = intval($_POST["Child"]);
    $Userselected_room = htmlspecialchars($_POST["Room"]);
    $Userspecial_request = htmlspecialchars($_POST["message"]);

    // Validate email
    if (!filter_var($Useremail, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Convert and validate dates
    try {
        $checkinDateTime = new DateTime($Usercheckin_date_time);
        $checkoutDateTime = new DateTime($Usercheckout_date_time);
        $Usercheckin_date_time = $checkinDateTime->format('Y-m-d H:i:s');
        $Usercheckout_date_time = $checkoutDateTime->format('Y-m-d H:i:s');
    } catch (Exception $e) {
        die("Invalid date format: " . $e->getMessage());
    }

    try {
        // Links to Connection.php
        require_once "Connection2.php";

        $query = "INSERT INTO booking (name, email, checkin_date_time, checkout_date_time, adults, children, selected_room, special_request) 
                  VALUES (:Name, :Email, :CheckIn, :CheckOut, :Adult, :Child, :Room, :Message);";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":Name", $Username);
        $stmt->bindParam(":Email", $Useremail);
        $stmt->bindParam(":CheckIn", $Usercheckin_date_time);
        $stmt->bindParam(":CheckOut", $Usercheckout_date_time);
        $stmt->bindParam(":Adult", $Useradults);
        $stmt->bindParam(":Child", $Userchildren);
        $stmt->bindParam(":Room", $Userselected_room);
        $stmt->bindParam(":Message", $Userspecial_request);

        $stmt->execute();

        header("Location: /CasaHermanasPrincess/index.html");
        exit();
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    } finally {
        $conn = null;
        $stmt = null;
    }

} else {
    header("Location: /login-signup.php");
    exit();
}
?>
