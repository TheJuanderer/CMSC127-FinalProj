<?php
session_start();
$conn = new mysqli("localhost", "root", "", "lf_db");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $password = $_POST['password'];

    $passwordHash = hash('sha512', $password);

    $sql = "SELECT * FROM users WHERE name = '$name' AND password_hash = '$passwordHash'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();
        //if there is an account in the database
        // store session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['name'] = $user['name'];

        header("Location: dashboard.php");
        exit();

    } else {
        echo "Invalid login!";
    }
}
?>

<h2>Login</h2>

<form method="POST">
    <input name="name" placeholder="Name">
    <input name="password" type="password" placeholder="Password">
    <button type="submit">Login</button>
</form>

<br>

<a href="registerView.php">
    <button>Register</button>
</a>