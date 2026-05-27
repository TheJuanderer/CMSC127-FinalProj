<?php
//get the id of the user in SESSION, and the current report
$reportUserID = $row['user_id'];
$reportType = $row['report_type'];
$reportStat = $row['report_status'];
$reportID = $row['report_id'];
$sessionUserID =  $_SESSION['user_id'];



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
    echo "<p>can't claim this report</p>";
    
} else if ($check->num_rows > 0) {
    echo "<p>you have a claim in this report</p>";
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