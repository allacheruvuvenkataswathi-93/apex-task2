<?php
$conn = new mysqli("localhost", "root", "swathi@93", "blog");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>