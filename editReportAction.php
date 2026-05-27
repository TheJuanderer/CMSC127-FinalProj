<?php
/*this just returns a button or not basically for updating report */

//get the id of the user, and the current report
$reportUserID = $row['user_id'];
$sessionUserID =  $_SESSION['user_id'] ?? null; //in case dashboard is used by guest

//gets role of user
$sessionUserRole = $_SESSION['role'] ?? 'user';

$isAdmin = ($sessionUserRole == 'admin');
$isOwner = ($sessionUserID !== null && $reportUserID === $sessionUserID);

//if permissions sufficient
if ($isOwner || $isAdmin) {
    echo '<form action="updateReportPage.php" method="POST" style="display:inline;">
    <input 
    type="hidden" 
    name="report_id" 
    value="'. htmlspecialchars($row["report_id"]) .'"
    >
    <button type="submit">
        Edit
    </button>
</form>';
} else {
    // Displayed text if the user does not have authorization
     echo '<button type="button" disabled title="You cannot edit this report" style="cursor: not-allowed; opacity: 0.6; margin-right: 2px;">
        Edit
    </button>';
}
?>

<!-- // //if they are the same, return a button element
// //since the user can only edit his own reports
// if ($reportUserID === $sessionUserID){
//     echo '<form action="updateReportPage.php" method="POST">
//     <input 
//     type="hidden" 
//     name="report_id" 
//     value='. $row["report_id"] .'
//     >
//     <button type="submit">
//         Edit
//     </button>
// </form>';
// } else {
//     echo "<p>can't edit this report</p>";
// }

// ?> -->