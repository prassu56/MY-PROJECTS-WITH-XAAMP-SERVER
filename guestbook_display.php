<?php
// Connect to MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "guestbook_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, message, created_at FROM guestbook_entries ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li><strong>" . htmlspecialchars($row["name"]) . "</strong> (" . $row["created_at"] . "):<br />" . nl2br(htmlspecialchars($row["message"])) . "</li><br />";
    }
    echo "</ul>";
} else {
    echo "No entries yet.";
}

$conn->close();
?>
