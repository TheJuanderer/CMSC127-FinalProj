<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>All REPORTS:</h2>
    <table style="width: 100%">
        <tr>
            <th>Report ID</th>
            <th>Category ID</th>
            <th>From: </th>
            <th>Item</th>
            <th>Desc</th>
            <th>Type</th>
            <th>Status</th>
            <th>image</th>
            <th>When Last Seen</th>
            <th>Where Last Seen</th>
            <th>Time Reported</th>
        </tr>
    <?php
        include 'reports.php';
    ?>
    </table>
</body>
</html>