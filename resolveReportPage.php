<?php
include 'DBConnector.php';
session_start();

$report_id = (int)$_POST['report_id'];

// get all claims + user info
$sql = "
SELECT 
    claims.claim_id,
    users.user_id,
    users.name,
    claims.claim_date
FROM claims
JOIN users ON users.user_id = claims.user_id
WHERE claims.report_id = $report_id
";

$result = $conn->query($sql);

echo "<h2>Claims for Report #$report_id</h2>";

echo "<table>";
echo "<tr><th>User</th><th>Date</th><th>Action</th></tr>";

//if there is no claims on the current report
if ($result->num_rows<=0){
    echo "
    <tr>
        <td colspan='3'>No claims in this report</td>
    </tr>
    ";
}

while ($row = $result->fetch_assoc()) {

    echo "
    <tr>
        <td>{$row['name']}</td>
        <td>{$row['claim_date']}</td>
        <td>
            <form method='POST' action='resolveClaim.php'>
                <input type='hidden' name='report_id' value='$report_id'>
                <input type='hidden' name='claim_id' value='{$row['claim_id']}'>
                <button type='submit' onclick=\"return confirm('Resolve this claim?')\">
                    select this claim
                </button>
            </form>
        </td>
    </tr>
    ";
}

echo "</table>";
?>