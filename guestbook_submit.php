<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guestbook_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and sanitize input
if (isset($_POST['name']) && isset($_POST['message'])) {
    $name = trim($_POST['name']);
    $message = trim($_POST['message']);

    if ($name === '' || $message === '') {
        die("Name and message cannot be empty.");
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO guestbook_entries (name, message) VALUES (?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ss", $name, $message);

    // Execute statement
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $stmt->close();
} else {
    die("Invalid form submission.");
}

$conn->close();

// Redirect back to the guestbook page
header("Location: guestbook application.html");
exit();
?>
