
<?php
/*this just returns a button or not basically for updating report */


//get the id of the user, and the current report
$reportUserID = $row['user_id'];
$sessionUserID =  $_SESSION['user_id'];


//if they are the same, return a button element
//since the user can only edit his own reports
if ($reportUserID === $sessionUserID){
    echo '<form action="updateReportPage.php" method="POST">
    <input 
    type="hidden" 
    name="report_id" 
    value='. $row["report_id"] .'
    >
    <button type="submit">
        Edit
    </button>
</form>';
} else {
    echo "<p>can't edit this report</p>";
}

?>