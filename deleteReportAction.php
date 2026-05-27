<?php
//get the id of the user in SESSION, and the current report
$reportUserID = $row['user_id'];
$sessionUserID =  $_SESSION['user_id'] ?? null; //in case dashboard is used by guest

//gets role of user
$sessionUserRole = $_SESSION['role'] ?? 'user';

$isAdmin = (strtolower($sessionUserRole) === 'admin');

$isOwner = ($sessionUserID !== null && $reportUserID == $sessionUserID);

//ADDED ELEMENTS DYNAMIC TO ROLE
//can delete if perm is sufficient
if ($isOwner || $isAdmin) {
    echo '<form action="deleteReport.php" method="POST" style="display:inline;">
    <input 
        type="hidden" 
        name="report_id" 
        value="'. htmlspecialchars($row["report_id"]) .'"
    >
    <button type="submit" onclick="return confirm(\'are you sure you want to delete this?\')">
        Delete
    </button>
</form>';
} else {
    echo '<button type="button" disabled title="You cannot delete this report" style="cursor: not-allowed; opacity: 0.6;">
        Delete
    </button>';
}
?>


<!-- //if they are the same, return a button element
//since the user can only delete his own reports
// if ($reportUserID === $sessionUserID){
//     echo '<form action="deleteReport.php" method="POST">
//     <input 
//         type="hidden" 
//         name="report_id" 
//         value='. $row["report_id"] .'
//     >
//     <button type="submit" onclick="return confirm(\'are you sure you want to delete this?\')">
//         Delete
//     </button>
// </form>';
// } else {
//     echo "<p>can't delete this report</p>";
// }
//onclick="return confirm(\"are you sure you want to delete this?\")"

?> -->