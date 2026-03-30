<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $conn->query("INSERT INTO posts (title, content) VALUES ('$title', '$content')");
    echo "Post Added!";
}
?>

<form method="POST">
    <h2>Add Post</h2>
    Title: <input type="text" name="title" required><br><br>
    Content: <textarea name="content" required></textarea><br><br>
    <button name="add">Add</button>
</form>

<br>
<a href="dashboard.php">Back</a>