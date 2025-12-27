<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "transfers_db";

// Δημιουργία σύνδεσης
$conn = new mysqli($servername, $username, $password, $dbname);

// Έλεγχος αν πέτυχε η σύνδεση
if ($conn->connect_error) {
  die("Η σύνδεση απέτυχε: " . $conn->connect_error);
}
?>