<?php
/*this is the "dashboard.php"
get the value from the select element, if the user did not choose then the default 'ALL'
would be the statusSearch*/
include 'DBConnector.php';

session_start();

//intialize
$conditions = [];

//get the search filter presets
$statusSearch = $_POST['statusSearch'] ?? 'ALL';
$dateSearch = $_POST['datePreset'] ?? 'ALL';

//output the statusSearch string
echo "<p>$statusSearch</p>";
echo "<p>{$_SESSION['user_id']}</p>"; //the page saves the credentials of the user from the loginView

//create the query depending on the search status you want
//STATUS FILTER
if ($statusSearch !== 'ALL') {
    $conditions[] = "report_status = '$statusSearch'";
}

// DATE FILTER
if ($dateSearch !== 'ALL') {

    if ($dateSearch === 'TODAY') {
        $conditions[] = "DATE(report_date_made) = CURDATE()";
    }

    if ($dateSearch === 'LAST_7') {
        $conditions[] = "report_date_made >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
    }

    if ($dateSearch === 'LAST_30') {
        $conditions[] = "report_date_made >= DATE_SUB(NOW(), INTERVAL 30 DAY)";
    }

    // CUSTOM will come later when you add dateFrom/dateTo inputs
}

// BASE QUERY
$repQuery = "SELECT * FROM reports";

// ATTACH CONDITIONS IF ANY
if (count($conditions) > 0) {
    $repQuery .= " WHERE " . implode(" AND ", $conditions);
}

$rows = fetchAllRows($conn, $repQuery);

    //returns info about the reports as html elements
echo "<table>";
    foreach ($rows as $row) {
        //create html elements
        echo "
        <tr>
            <td>{$row['report_id']}</td>
            <td>{$row['category_id']}</td>
            <td>{$row['item_desc']}</td>
            <td>{$row['report_type']}</td>
            <td>{$row['report_status']}</td>
        <td>";

        // claim button -- show if not your report
        if ($row['user_id'] != $_SESSION['user_id']) {
            echo "
            <form method = 'POST' action = 'createClaim.php'>
                <input type = 'hidden' name = 'report_id' value = '{$row['report_id']}'>
                <button type = 'submit'>Claim</button>
            </form>";
        }

        // resolve button -- show only if you own the report
        if ($row['user_id'] == $_SESSION['user_id']) {
            echo "
            <form method = 'POST' action = 'resolveClaim.php'>
                <input type = 'hidden' name = 'report_id' value = '{$row['report_id']}'>
                <button type = 'submit'>Resolve</button>
            </form>";
        }

        echo "</td>
        </tr>";
    }
echo "</table>";
   
    
//returns an array (if there is) of the query that is executed
function fetchAllRows($conn, $query) {
    $res = $conn->query($query);

    if (!$res) {
        die("Query failed: " . $conn->error);
    }

    $rows = [];

    while ($row = $res->fetch_assoc()) {
        $rows[] = $row;
    }

    return $rows;
}





?>