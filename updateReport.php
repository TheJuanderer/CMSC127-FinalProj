<?php
session_start();
include 'DBConnector.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // get form values
    $reportID = (int) $_POST['report_id'];

    $itemName = $conn->real_escape_string($_POST['name']);
    $itemDesc = $conn->real_escape_string($_POST['itemdesc']);
    $categoryID = (int) $_POST['category'];
    $reportType = $conn->real_escape_string($_POST['reportType']);
    $lastSeenDate = $_POST['last-seen-date'];
    $lastSeenLocation = $conn->real_escape_string($_POST['last-seen-loc']);

    /*
        OPTIONAL IMAGE UPDATE
        if user uploads a new image,
        replace the old image path
    */
    $imagePath = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $uploadDir = "uploads/";
        $fileName = basename($_FILES['image']['name']);

        // create unique filename
        $newFileName = time() . "_" . $fileName;

        $targetFile = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;
        }
    }

    /*
        UPDATE ITEMS TABLE
        since item_name is stored in items table
    */

    // get item_id first
    $itemQuery = "
        SELECT item_id
        FROM reports
        WHERE report_id = $reportID
    ";

    $itemResult = $conn->query($itemQuery);

    if ($itemResult && $itemResult->num_rows > 0) {

        $itemRow = $itemResult->fetch_assoc();
        $itemID = $itemRow['item_id'];

        // update item name
        $updateItemSQL = "
            UPDATE items
            SET item_name = '$itemName'
            WHERE item_id = $itemID
        ";

        $conn->query($updateItemSQL);
    }

    /*
        UPDATE REPORT TABLE
    */

    $updateReportSQL = "
        UPDATE reports
        SET
            category_id = $categoryID,
            item_desc = '$itemDesc',
            report_type = '$reportType',
            last_seen_date = '$lastSeenDate',
            last_seen_location = '$lastSeenLocation'
    ";

    // only update image if a new one was uploaded
    if ($imagePath !== null) {
        $updateReportSQL .= ",
            image_url = '$imagePath'
        ";
    }

    $updateReportSQL .= "
        WHERE report_id = $reportID
    ";

    if ($conn->query($updateReportSQL)) {

        echo "
            <script>
                alert('Report updated successfully!');
                window.location.href = 'dashboard.php';
            </script>
        ";

    } else {

        echo "Error updating report: " . $conn->error;
    }
    header ("Location: dashboardPage.php");
} else {

    echo "Invalid request.";
}
?>