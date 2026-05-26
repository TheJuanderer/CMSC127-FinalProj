<?php
include 'DBConnector.php';
include 'checkProtectedPage.php';

$user_id = $_SESSION['user_id'];
$report_id = $_POST['report_id'] ?? null;

if (!$report_id) {
    die("No report specified.");
}

// check if the report exists and get its owner

$res = $conn->query("SELECT user_id FROM reports WHERE report_id = report_id");
$report = $res->fetch_assoc();

if (!$report) {
    die("Report not found");
}
// Can't claim your own report
if ($report['user_id'] == $user_id) {
    die("You can't claim your own report.");

}

// insert the claim
$conn->query("INSERT INTO claims (user_id, report_id) VALUES ($user_id, $report_id");

header("Location: viewReport.php");
exit();

?>