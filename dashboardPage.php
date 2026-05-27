<!--this is the "dashboardView.php"
this is where a user can view reports using the status
this is also where the user can click a link to create a report
this is also where a user can claim or unclaim a report -->
<?php
// Ensure session tracking is running before rendering the HTML content
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>
        <table border="1" cellpadding="10"> 
            <tr>
                <!-- ADDED ELEMENTS DYNAMIC TO ROLE  -->
                <td>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <p style="color: green;">You are logged in.</p>
                    <?php else: ?>
                        <p style="color: red;">You are browsing as a guest.</p>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="logout.php">logout</a>
                    <?php else: ?>
                        <a href="loginPage.php">log-in</a>
                    <?php endif; ?>
                    <?php
                        if ($_SESSION['role'] === 'admin') {
                            echo "<a href='adminPanel.php'>Admin Panel</a>";
                        }
                        
                    ?>
                </td>
                <td>
                    <?php if ($isLoggedIn): ?>
                        <a href="newReportPage.php">create reports</a>
                    <?php else: ?>
                        <span title="Please log in to create reports" style="color: gray; text-decoration: none; cursor: not-allowed;">
                            create reports
                        </span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        <h2>This is the dashboard!</h2>

        <h3>Reports available</h3>

        <form method="POST" action="dashboardPage.php">

            <table border="0" cellpadding="8">

                <tr>
                    <td><label>Report Status</label></td>
                    <td>
                        <select name="statusSearch">
                            <option value="OPEN">OPEN</option>
                            <option value="CLOSED">CLOSED</option>
                            <option value="ALL">ALL</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><label>Date Filter</label></td>
                    <td>
                        <select name="datePreset">
                            <option value="ALL">All time</option>
                            <option value="TODAY">Today</option>
                            <option value="LAST_7">Last 7 days</option>
                            <option value="LAST_30">Last 30 days</option>
                            <option value="CUSTOM">Custom range</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><label>Report Type</label></td>
                    <td>
                        <select name="typeFilter">
                            <option value="ALL">ALL</option>
                            <option value="Lost">Lost</option>
                            <option value="Found">Found</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><label>Category</label></td>
                    <td>
                        <select name="categoryFilter">
                            <option value="ALL">ALL</option>
                            <option value="1">Electronics</option>
                            <option value="2">Jewelry</option>
                            <option value="3">Wallets</option>
                            <option value="4">Umbrella</option>
                            <option value="5">Documents</option>
                            <option value="6">Stationary</option>
                            <option value="7">Perishables</option>
                            <option value="8">Other</option>
                        </select>
                    </td>
                </tr>
                <!--
                <tr>
                    <td><label>From Date</label></td>
                    <td>
                        <input type="date" name="dateFrom">
                    </td>
                </tr>

                <tr>
                    <td><label>To Date</label></td>
                    <td>
                        <input type="date" name="dateTo">
                    </td>
                </tr>
                -->
                <tr>
                    <td></td>   
                    <td>
                        <button type="submit" class="auth-required">Search</button>

                    </td>
                </tr>
                
            </table>
        </form>

        <div class = "" id = "reportSearchResult">
            <?php include "viewReport.php";?>
        </div>
        

        
        
    </body>

</html>