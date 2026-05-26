<?php
//this is the page where reports are updated
session_start();
include 'DBConnector.php';


if (!isset($_POST['report_id'])) {
    die("No report id received");
}

$reportID = $_POST['report_id'];
$query = "SELECT * FROM reports WHERE report_id = '$reportID'";

$result = $conn->query($query);
$report = $result->fetch_assoc();

?>

<!--render the html elements with pre filled values-->
<!DOCTYPE html>
<html>
<body>

    <form action="updateReport.php" method="POST">

        <table style="width:100%">
            
            <input 
            type="hidden"
            name="report_id"
            value="<?= $report['report_id'] ?>"
            >

            <tr>
                <td class="tlabel">Item Name</td>
                <td><input type="text" name="name"
                value = <?php?>
                ></td>
            </tr>

            <tr>
                <td class="tlabel">Item Description*</td>
                <td>  
                    <textarea id="itemdesc" name="itemdesc" rows="4" cols="50" required><?= htmlspecialchars($report['item_desc']) ?></textarea>
                </td>
            </tr>

            <tr>
                <td class="tlabel">Item Category</td>
                <td>
                    <select class="expand" name="category">
                        <option value="" disabled="">--Select Item Category--</option>
                        <?php
                            include 'allCategoriesUpdate.php';
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td class="tlabel">Report Type*</td>
                <td>
                    <input type="radio" name="reportType" value="Lost" required
                    <?= $report['report_type'] == 'Lost' ? 'checked' : '' ?>
                    >Lost item<br>
                    <input type="radio" name="reportType" value="Found"
                    <?= $report['report_type'] == 'Found' ? 'checked' : '' ?>
                    >Found item<br>
                </td>
            </tr>

            <tr>
                <td class="tlabel">Photo of Item*</td>
                <td><img src="<?= $report['image_url'] ?>" width="150"></td>
                <td><input type="file" name="image" accept="uploads/*" required></td>
            </tr>

            <tr>
                <td class="tlabel">WHEN object was last seen/found*</td>
                <td><input class="expand" type="date" name="last-seen-date" 
                value="<?= $report['last_seen_date'] ?>"
                required></td>
            </tr>

            <tr>
                <td class="tlabel">WHERE object was last seen/found*</td>
                <td><input type="text" name="last-seen-loc" 
                value="<?= htmlspecialchars($report['last_seen_location']) ?>"
                required></td>
            </tr>

            <tr>
                <td class="tlabel"></td>
                <td><input type="submit"></td>
            </tr>
        </table>

    </form>

</body>
</html>