<?php
// Database connection details
$servername = "127.0.0.1";
$username = "root";
$password = "Banzuela@bicoluni";
$dbname = "CasaHermanas";

// Attempt database connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Connection successful
} catch(PDOException $e) {
    // Connection failed
    echo "Connection failed: " . $e->getMessage();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if email and password are set and not empty
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        // Sanitize user input to prevent SQL injection
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        // Prepare SQL statement to retrieve user from database
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);

        // Execute the query
        $stmt->execute();

        // Check if a row is returned
        if ($stmt->rowCount() > 0) {
            // User exists, login successful
            echo "Login successful!";
            // Redirect to dashboard or some other page
            // header("Location: dashboard.php");
            // exit();
        } else {
            // User does not exist or credentials are incorrect
            echo "Invalid email or password.";
        }
    } else {
        // Email or password not provided
        echo "Please enter both email and password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form class="login-inputbox" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="email" placeholder="  EMAIL" />
        <input type="password" name="password" placeholder="  PASSWORD" />
        <button type="submit">LOG IN</button>
    </form>
</body>
</html>
