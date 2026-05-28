<?php
/*this script returns a button if the conditions for creating claims in a report is met */

//get the id of the user in SESSION, and the current report
$sessionUserID = $_SESSION['user_id'] ?? null;

//gGet the rest of the report row details
$reportUserID = $row['user_id'];
$reportType = $row['report_type'];
$reportStat = $row['report_status'];
$reportID = $row['report_id'];

// GUEST CHECK
if ($sessionUserID === null) {
    echo '<button type="button" disabled title="Please log in to claim reports" style="cursor: not-allowed; opacity: 0.6;">
        claim
    </button>';
    return; //
}

//check if your claim exists in this report
$check = $conn->query("
    SELECT claim_id 
    FROM claims 
    WHERE user_id = $sessionUserID 
    AND report_id = $reportID
");



//if they are the same OR the report is a Lost report, do not return a button
//you cant claim a lost report (how would it work fuiyohhh)
//since the user can only claim other users reports, and that report must be a Found report 
//and an OPEN report
if ($reportUserID === $sessionUserID || $reportType === "Lost" || $reportStat === "CLOSED"){
    echo '<button type="submit" disabled title = "can\'t claim this report" style="cursor: not-allowed; opacity: 0.6;" onclick="return confirm(\'are you sure you want to claim this?\')">
        claim
    </button>';
    
} else if ($check->num_rows > 0) {
    echo '<button type="button" disabled title="you have a claim in this report" style="cursor: not-allowed; opacity: 0.6;">
        claim
    </button>';

} else {
    echo '<form action="createClaim.php" method="POST">
    <input 
        type="hidden" 
        name="report_id" 
        value='. $row["report_id"] .'
    >
    <button type="submit" onclick="return confirm(\'are you sure you want to claim this?\')">
        claim
    </button>
</form>';
}
//onclick="return confirm(\"are you sure you want to delete this?\")"

?>