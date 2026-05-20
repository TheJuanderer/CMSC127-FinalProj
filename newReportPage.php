<h1>Make a report</h1>
    <br>
    <form action="addReport.php" method="POST" enctype="multipart/form-data">
        <table style="width:100%">
            <tr>
                <td class="tlabel">Item Name</td>
                <td><input type="text" name="name" ></td>
            </tr>
            <tr>
                <td class="tlabel">Item Description*</td>
                <td>  <textarea id="itemdesc" name="itemdesc" rows="4" cols="50" required></textarea>
                </td>
            </tr>
            <tr>
                <td class="tlabel">Item Category</td>
                <td>
                    <select class="expand" name="category">
                        <option value="" disabled="">--Select Item Category--</option>
                        <?php
                            include 'allCategories.php';
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="tlabel">Report Type*</td>
                <td>
                    <input type="radio" name="reportType" value="Lost" required>Lost item<br>
                    <input type="radio" name="reportType" value="Found">Found item<br>
                </td>
            </tr>
            <tr>
                <td class="tlabel">Photo of Item*</td>
                <td><input type="file" name="image" accept="uploads/*" required</td>
            </tr>
            <tr>
                <td class="tlabel">WHEN object was last seen/found*</td>
                <td><input class="expand" type="date" name="last-seen-date" required></td>
            </tr>
            <tr>
                <td class="tlabel">WHERE object was last seen/found*</td>
                <td><input type="text" name="last-seen-loc" required></td>
            </tr>
            <tr>
                <td class="tlabel"></td>
                <td><input type="submit"></td>
            </tr>
        </table>

    </form>