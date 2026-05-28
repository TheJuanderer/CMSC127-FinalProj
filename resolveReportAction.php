<?php
/*this script returns a button if the conditions for resolving a report is met */

//get values to be used
$sessionUserID = $_SESSION['user_id'] ?? null;
$sessionUserRole = $_SESSION['role'] ?? 'user';
//guest check


$reportUserID = $row['user_id'];
$reportID = $row['report_id'];
$reportStatus = $row['report_status'];
$reportType = $row['report_type'];

//exit early if not logged in
if ($sessionUserID === null) {
    echo '<button type="button" disabled title="Please log in to resolve reports" style="cursor: not-allowed; opacity: 0.6; margin-right: 2px;">
        resolve claim
    </button>';
    return; 
}


// only owner can resolve
if ($sessionUserID === $reportUserID && $reportStatus !== "CLOSED" && $reportType === "Found") {
    echo '
    <form action="resolveReportPage.php" method="POST">
        <input type="hidden" name="report_id" value=" '. $reportID .' ">
        <button type="submit">
            resolve claim
        </button>
    </form>
    ';
} else {
    // Displayed text if the user does not have authorization
    echo '<button type="button" disabled title="cannot resolve others reports" style="cursor: not-allowed; opacity: 0.6; margin-right: 2px;">
        resolve claim
    </button>';
}
?>