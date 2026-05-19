<?php
/*this is the "dashboard.php"
get the value from the select element, if the user did not choose then the default 'ALL'
would be the statusSearch*/
$conn = new mysqli("localhost", "root", "", "lf_db");

$statusSearch = $_POST['statusSearch'] ?? 'ALL';

//output the statusSearch string
echo "<p>$statusSearch</p>
";

//create the query depending on the search status you want
if ($statusSearch === 'ALL') {
    $repQuery = "SELECT * FROM reports";
} else {
    $repQuery = "SELECT * FROM reports WHERE status = '$statusSearch'";
}

//returns multiple rows
$res = $conn->query($repQuery);

//returns info about the reports as html elements
echo "<table>";
while ($row = $res->fetch_assoc()) {
    //create html elements
    echo "
    <tr>
        <td>{$row['report_id']}</td>
        <td>{$row['category_id']}</td>
        <td>{$row['description']}</td>
        <td>{$row['type']}</td>
        <td>{$row['status']}</td>
    </tr>
    ";
}
echo "</table>";




?>