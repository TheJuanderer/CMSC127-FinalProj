<?php
session_start();
include 'DBConnector.php';

if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

$id = $_GET['id'];

// FETCH REPORT
$res = $conn->query("SELECT * FROM reports WHERE report_id = $id");
$row = $res->fetch_assoc();
?>

<form method="POST">
    <input type="hidden" name="id" value="<?= $row['report_id'] ?>">

    Description:
    <input type="text" name="desc" value="<?= $row['item_desc'] ?>"><br>

    Status:
    <select name="status">
        <option value="OPEN">OPEN</option>
        <option value="CLOSED">CLOSED</option>
    </select><br>

    <button type="submit">Update</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $desc = $_POST['desc'];
    $status = $_POST['status'];

    $conn->query("
        UPDATE reports 
        SET item_desc='$desc', report_status='$status'
        WHERE report_id=$id
    ");

    header("Location: adminPanel.php");
}
?>