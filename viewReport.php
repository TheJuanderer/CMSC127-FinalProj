<?php
/*this is the "dashboard.php"
get the value from the select element, if the user did not choose then the default 'ALL'
would be the statusSearch*/
include 'DBConnector.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//intialize
$conditions = [];

//get the search filter presets
$statusSearch = $_POST['statusSearch'] ?? 'ALL';
$dateSearch = $_POST['datePreset'] ?? 'ALL';
$typeFilter = $_POST['typeFilter'] ?? 'ALL';
$categoryFilter = $_POST['categoryFilter'] ?? 'ALL';

// //output the statusSearch string
// echo "<p>$statusSearch</p>";
// echo "<p>{$_SESSION['user_id']}</p>"; //the page saves the credentials of the user from the loginView

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

echo "<p>Search Status: " . htmlspecialchars($statusSearch) . "</p>";

//in case user is not logged in, also for checking if user is admin
$userId = $_SESSION['user_id'] ?? 'Guest';
$userRole = $_SESSION['role'] ?? 'Guest';

echo "<p>User ID: $userId | Role: $userRole</p>";

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
}

    // TYPE FILTER (Lost / Found)
    if ($typeFilter !== 'ALL') {
        $conditions[] = "report_type = '$typeFilter'";
    }

    // CATEGORY FILTER
    if ($categoryFilter !== 'ALL') {
        $conditions[] = "category_id = '$categoryFilter'";
    }

// BASE QUERY
$repQuery = "SELECT *, users.name FROM reports JOIN users ON reports.user_id = users.user_id";

// ATTACH CONDITIONS IF ANY
if (count($conditions) > 0) {
    $repQuery .= " WHERE " . implode(" AND ", $conditions);
}

$rows = fetchAllRows($conn, $repQuery);

    //returns info about the reports as html elements
echo "<table border='1' cellpadding='10'>";
    //enter column names
    echo "
        <tr>
            <th>Report ID</th>
            <th>Category ID</th>
            <th>Who Created this report?</th>
            <th>Item Description</th>
            <th>Report Type</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        ";

    foreach ($rows as $row) {
        //create html elements
        echo "
        <tr>
            <td>{$row['report_id']}</td>
            <td>{$row['category_id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['item_desc']}</td>
            <td>{$row['report_type']}</td>
            <td>{$row['report_status']}</td>

            <td>"; include 'editReportAction.php';
            include 'deleteReportAction.php';
            include 'claimReportAction.php';
            //create 4th button
            include 'resolveReportAction.php';
            echo "</td>


        </tr>
        ";

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