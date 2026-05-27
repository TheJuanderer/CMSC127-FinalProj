<?php
session_start();
include 'DBConnector.php';

// block non admins
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied");
}

// GET ALL REPORTS
$query = "SELECT reports.*, users.name 
          FROM reports 
          JOIN users ON reports.user_id = users.user_id";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>

<h2> Admin Panel</h2>
<a href="dashboardPage.php">← Back to Dashboard</a>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Owner</th>
    <th>Description</th>
    <th>Type</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['report_id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['item_desc'] ?></td>
    <td><?= $row['report_type'] ?></td>
    <td><?= $row['report_status'] ?></td>

    <td>
       

        <!-- EDIT FORM -->
        <form method="POST" action="adminEditReport.php" style="display:inline;">
            <input type="hidden" name="report_id" value="<?= $row['report_id'] ?>">
            <button type="submit">Edit</button>
        </form>

        |

        <!-- DELETE FORM -->
        <form method="POST" action="adminDeleteReport.php" style="display:inline;" 
            onsubmit="return confirm('Delete this report?');">
            <input type="hidden" name="report_id" value="<?= $row['report_id'] ?>">
            <button type="submit">Delete</button>
        </form>

       
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>