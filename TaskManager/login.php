<?php
// Change these variables with your actual database credentials
$hostname = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

// Create connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredUsername = $_POST['username'];
    $enteredPassword = $_POST['password'];

    // Fetch user data from the database
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $enteredUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($enteredPassword, $row['password'])) {
            header("Location: task_manager.html");
            exit();
        } else {
            $error = "Incorrect password";
        }
    } else {
        $error = "User not found";
    }

    $stmt->close();
}

$conn->close();
?>
