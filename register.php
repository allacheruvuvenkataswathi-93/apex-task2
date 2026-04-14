<?php
include 'db.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // validation
    if (empty($username) || empty($password)) {
        echo "All fields are required!";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $role = "user";

        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $role);
        $stmt->execute();

        echo "Registered successfully!";
    }
}
?>

<form method="POST">
    <h2>Register</h2>
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name="password"><br><br>
    <button name="register">Register</button>
</form>
