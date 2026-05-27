<?php
include 'DBConnector.php';
session_start();

$reportID = $_POST['report_id'];
$sessionUserID = $_SESSION['user_id'];

// IMPORTANT: still enforce rule on server side (not just UI)
$sql = "
    UPDATE reports
    SET report_status = 'CLOSED'
    WHERE report_id = ?
";

$res = $conn->query($sql);


header("Location: dashboard.php");
exit;
?>