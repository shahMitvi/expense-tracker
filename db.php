<?php
$host = 'localhost';
$user = 'root';
$password = 'mitvi111';
$dbname = 'expense_tracker';

// Create a connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
