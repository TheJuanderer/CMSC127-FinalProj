<?php
include 'DBConnector.php';

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $select = '';
        if ($row['category_id'] === $report['category_id']) {
            $select = 'selected';
        }
        echo "<option value='".$row['category_id']."'". $select . ">". $row['category_name']."</option>";
    }
}
else {
    echo "0 results";
}

$conn->close();

?>