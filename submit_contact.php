<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contactdb";

$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    // Set parameters and execute
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    if ($stmt->execute()) {
        $successMessage = "Thank you for contacting us. Your message has been received.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contact Form Submission</title>
</head>
<body>
    <?php if ($successMessage): ?>
        <p style="color: green;"><?php echo htmlspecialchars($successMessage); ?></p>
        <p><a href="contactform.html">Back to Contact Form</a></p>
    <?php else: ?>
        <p>There was an error processing your request.</p>
        <p><a href="contactform.html">Back to Contact Form</a></p>
    <?php endif; ?>
</body>
</html>
