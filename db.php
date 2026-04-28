<?php
$conn = new mysqli("localhost", "root", "", "inventory_2");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>