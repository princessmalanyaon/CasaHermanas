
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are provided
    if(empty($_POST["email"]) || empty($_POST["password"])) {
        // If either email or password is empty, redirect to Incorrect.html
        echo '<script> alert("Cannot have an Empty Fields");</script>';
        echo '<script>window.history.back();</script>';
        exit();
    }


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $UserEmail = trim($_POST["email"]); // Trim leading and trailing spaces
    $UserPassword = $_POST["password"];
}
    try {
        // Connect to the database
        require_once "Connection1.php";

        // Prepare SQL query to fetch user details based on email and password
        $query = "SELECT UserEmail, UserPassword FROM user_account WHERE UserEmail = :UserEmail AND UserPassword = :UserPassword";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":UserEmail", $UserEmail);
        $stmt->bindParam(":UserPassword", $UserPassword);
        $stmt->execute();

        // Fetch user's email and password from the database
        $storedData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($storedData && $storedData['UserEmail'] === $UserEmail && $storedData['UserPassword'] === $UserPassword) {
            // Email and password match, redirect to index.html
            header("Location: index.html");
            exit();
        } else {
            echo '<script> alert("Incorrect Input or Input does not Exist");</script>'; // Error handling for input not existing
            echo '<script>window.history.back();</script>';

    // Prepare SQL query to fetch user details based on email and password
    $query = "SELECT UserEmail, UserPassword FROM user_account WHERE UserEmail = :UserEmail AND UserPassword = :UserPassword";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":UserEmail", $UserEmail);
    $stmt->bindParam(":UserPassword", $UserPassword);
    $stmt->execute();

    // Fetch user's email and password from the database
    $storedData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($storedData && $storedData['UserEmail'] === $UserEmail && $storedData['UserPassword'] === $UserPassword) {
        // Email and password match, redirect to index.html
        header("Location: index.html");
        exit();
    }
        else {
            // Incorrect email or password, redirect to Incorrect.html
            header("Location: Incorrect.html");
            exit();
        }
    }
}
     catch (PDOException $e) {
        // Error handling
        die("Query Failed: " . $e->getMessage());
    }
} else {
    // Redirect if accessed directly
    header("Location: login-signup.php");
    exit();
}