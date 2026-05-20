<?php
include 'DBConnector.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        echo "<pre/>";
        print_r($row);

        echo "UserID: " . $row["user_id"].
            "<br>".
            " - Name: ". $row["name"].
            " - Password: ". $row["password_hash"].
            " - Contact: ". $row["contact_no"].
            " - Role: ". $row["role"].
            "<br/><br/>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>;