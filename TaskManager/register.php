<?php
// Change these variables with your actual database credentials
$hostname = "localhost";
$username = "lesscaio";
$password = "2004";
$database = "";

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST['username'];
    $enteredPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Insert user data into the database
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $enteredUsername, $enteredPassword);

    if ($stmt->execute()) {
        // Registration successful, redirect to login.html
        header("Location: login.html");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
