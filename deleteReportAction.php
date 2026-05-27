<?php
//get the id of the user in SESSION, and the current report
$reportUserID = $row['user_id'];
$sessionUserID =  $_SESSION['user_id'];

//if they are the same, return a button element
//since the user can only delete his own reports
if ($reportUserID === $sessionUserID){
    echo '<form action="deleteReport.php" method="POST">
    <input 
        type="hidden" 
        name="report_id" 
        value='. $row["report_id"] .'
    >
    <button type="submit" onclick="return confirm(\'are you sure you want to delete this?\')">
        Delete
    </button>
</form>';
} else {
    echo "<p>can't delete this report</p>";
}
//onclick="return confirm(\"are you sure you want to delete this?\")"

?>