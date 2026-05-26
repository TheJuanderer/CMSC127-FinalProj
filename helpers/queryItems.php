<?php
include 'DBConnector.php';

function getItemName ($conn, $id){
     $sql = "
        SELECT i.item_name
        FROM reports r
        JOIN items i ON r.item_id = i.item_id
        WHERE r.report_id = $id
    ";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['item_name'];
    }

    return null;
}

?>