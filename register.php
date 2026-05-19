/this is the register backend

<?php
// database connection
$conn = new mysqli("localhost", "root", "", "lf_db");

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// get form registerView
$name = $_POST['name'];
$contactNo = $_POST['contactNo'];
$password = $_POST['password'];

// hash the password using sha512
$passwordHash = hash('sha512', $password);

// 1. CHECK IF NAME EXISTS
$sql = "SELECT * FROM users WHERE name = '$name'";
$sqlRes = $conn->query($sql);

$result = $sqlRes->fetch_assoc();


if ($sqlRes->num_rows > 0) {
    // name already exists
    echo "<h2>Username already taken!</h2>";
} else {

    // 2. INSERT NEW USER
    $sql = "INSERT INTO users (name, password_hash, contact_no, role) 
    VALUES ('$name', '$passwordHash', '$contactNo', 'user')";
    $sqlRes = $conn->query($sql);

    if ($sqlRes) {
        echo "User created successfully!";
        header("Location: loginView.php");
    } else {
        echo "Error: " . $conn->error;
    }

}

$conn->close();
?>