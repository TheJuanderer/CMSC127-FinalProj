<?php
session_start();
include 'DBConnector.php';

if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

$reportID = $_POST['report_id'];

/*
    1. Get item_id first (needed for final delete)
*/
$itemID = null;

$getItemSQL = "
    SELECT item_id
    FROM reports
    WHERE report_id = $reportID
";

$result = $conn->query($getItemSQL);

if ($result && $row = $result->fetch_assoc()) {
    $itemID = $row['item_id'];
}

/*
    2. Delete claims first (FK dependency)
*/
$deleteClaims = "
    DELETE FROM claims
    WHERE report_id = $reportID
";
$conn->query($deleteClaims);

/*
    3. Delete report
*/
$deleteReport = "
    DELETE FROM reports
    WHERE report_id = $reportID
";
$conn->query($deleteReport);

/*
    4. Delete item (only if it exists)
*/
if ($itemID !== null) {
    $deleteItem = "
        DELETE FROM items
        WHERE item_id = $itemID
    ";
    $conn->query($deleteItem);
}


header("Location: adminPanel.php");
?>