

<?php

$sessionUserID = (int)$_SESSION['user_id'];
$reportUserID = (int)$row['user_id'];
$reportID = (int)$row['report_id'];
$reportStatus = $row['report_status'];
$reportType = $row['report_type'];

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