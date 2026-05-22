<?php
/*this is the "dashboard.php"
get the value from the select element, if the user did not choose then the default 'ALL'
would be the statusSearch*/
include 'DBConnector.php';

session_start();

$statusSearch = $_POST['statusSearch'] ?? 'ALL';

//output the statusSearch string
echo "<p>$statusSearch</p>";
echo "<p>{$_SESSION['user_id']}</p>";

//create the query depending on the search status you want
if ($statusSearch === 'ALL') {
    $repQuery = "SELECT * FROM reports";
} else {
    $repQuery = "SELECT * FROM reports WHERE report_status = '$statusSearch'";
}

//returns multiple rows
$res = $conn->query($repQuery);

//check if there are no returned reports
if($res->num_rows<=0) {
    echo "<p>No results found</p>";

} else{
    //returns info about the reports as html elements
    echo "<table>";
    while ($row = $res->fetch_assoc()) {
        //create html elements
        echo "
        <tr>
            <td>{$row['report_id']}</td>
            <td>{$row['category_id']}</td>
            <td>{$row['item_desc']}</td>
            <td>{$row['report_type']}</td>
            <td>{$row['report_status']}</td>
        </tr>
        ";
    }
    echo "</table>";
}






?>