<?php
session_start();
include 'db.php';

// check login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

// search
$search = isset($_GET['search']) ? $_GET['search'] : "";

// pagination
$limit = 3;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// fetch posts
$sql = "SELECT * FROM posts 
        WHERE title LIKE '%$search%' 
        OR content LIKE '%$search%' 
        LIMIT $start, $limit";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial;
            background: #f5f5f5;
            text-align: center;
        }
        .post {
            background: white;
            padding: 15px;
            margin: 10px auto;
            width: 50%;
            border-radius: 10px;
        }
        input, button {
            padding: 10px;
            margin: 5px;
        }
        a {
            margin: 5px;
        }
    </style>
</head>
<body>

<h2>Welcome <?php echo $_SESSION['user']; ?></h2>
echo "Role: " . $_SESSION['role'];

<a href="add_post.php">Add Post</a> | 
<a href="logout.php">Logout</a>

<br><br>

<!-- SEARCH -->
<form method="GET">
    <input type="text" name="search" placeholder="Search posts">
    <button type="submit">Search</button>
</form>

<!-- POSTS -->
<?php while ($row = $result->fetch_assoc()) { ?>
    <div class="post">
        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo $row['content']; ?></p>
        <a href="delete_post.php?id=<?php echo $row['id']; ?>">Delete</a>
    </div>
<?php } ?>

<!-- PAGINATION -->
<?php
$result_total = $conn->query("SELECT COUNT(*) as total FROM posts");
$total = $result_total->fetch_assoc()['total'];
$pages = ceil($total / $limit);

for ($i = 1; $i <= $pages; $i++) {
    echo "<a href='?page=$i'>$i</a> ";
}
?>

</body>
</html>
