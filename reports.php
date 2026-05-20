<?php
include 'DBConnector.php';

$sql = "SELECT * FROM reports WHERE status='OPEN'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
        echo "<tr>".
            "<td align='center'>".$row["report_id"]."</td>".
            "<td align='center'>".$row["category_id"]."</td>".
            "<td align='center'>".$row["user_id"]."</td>".
            "<td align='center'>".$row["item_name"]."</td>".
            "<td align='center'>".$row["description"]."</td>".
            "<td align='center'>".$row["type"]."</td>".
            "<td align='center'>".$row["status"]."</td>".
            "<td align='center'><img src='".$row["image_url"] . "' width='200' alt='Item Photo'> </td>".
            "<td align='center'>".$row["last_seen_date"]."</td>".
            "<td align='center'>".$row["last_seen_location"]."</td>".
            "<td align='center'>".$row["when_made"]."</td>".
        "</tr>";
    }
} else {
    echo "No results";
}


?>