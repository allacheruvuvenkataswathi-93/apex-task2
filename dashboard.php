<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

echo "<h2>Welcome " . $_SESSION['user'] . "</h2>";
echo "<a href='add_post.php'>Add Post</a> | ";
echo "<a href='logout.php'>Logout</a><br><br>";

$result = $conn->query("SELECT * FROM posts");

while ($row = $result->fetch_assoc()) {
    echo "<b>" . $row['title'] . "</b><br>";
    echo $row['content'] . "<br>";
    echo "<a href='delete_post.php?id=".$row['id']."'>Delete</a>";
    echo "<hr>";
}
?>