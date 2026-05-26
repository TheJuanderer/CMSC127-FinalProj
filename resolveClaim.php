<?php
include 'DBCommector.php';
include 'checkProtectedPage.php';

$user_id = $_SESSION['user_id'];
$report_id = $_POST['report_id'] ?? null;

if (!$report_id) {
    die("No report specified.");
}

// check that the current user owns this report
$res = $conn->query("SELECT user_id FROM reports WHERE report_id = $report_id");
$report = $res->fetch_assoc();

if (!$report) {
    die("Report not found.");
}

if ($report['user_id'] != $user_id) {
    die("Only the report owner can resolve this.");
}

// close the report
$conn->query("UPDATE reports SET report_status = 'CLOSED' WHERE report_id = $report_id");

header("Location: viewReport.php");
exit();

?>