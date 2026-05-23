<?php
include 'DBConnector.php';

$name = $_POST["name"];
$itemdesc = $_POST["itemdesc"];
$category_id = $_POST["category"]; 
$reportType = $_POST["reportType"];
$last_seen_date = $_POST["last-seen-date"];
$last_seen_loc = $_POST["last-seen-loc"];


$user_id = 2; //hard coded for now
$report_status = 'OPEN'; //auto
$report_date_made = date('Y-m-d');


$item_sql = "INSERT INTO items (item_name) VALUES ('$name')"; //for the item table (note: how does it know a report reports the same id though? admin?)
$conn->query($item_sql);
$item_id = $conn->insert_id;

//image path
$image_url = "";
if (isset($_FILES['image'])) {
    $upload_dir = 'uploads/';
    $target_file = $upload_dir . basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $image_url = $target_file;
    }
}


$sql = "INSERT INTO `reports` (`category_id`, `user_id`, `item_id`, `item_desc`, `report_type`, `report_status`, `image_url`, `last_seen_date`, `last_seen_location`, `report_date_made`)
        VALUES ($category_id, $user_id, $item_id, '$itemdesc', '$reportType', '$report_status', '$image_url', '$last_seen_date', '$last_seen_loc', '$report_date_made')";


        if ($conn->query($sql) === TRUE) {
            header("Location: dashboardView.php"); //redirect back to home
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
$conn->close();
?>
    
?>