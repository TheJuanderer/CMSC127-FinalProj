<!--this is the "dashboardView.php"
this is where a user can view reports using the status
this is also where the user can click a link to create a report
this is also where a user can claim or unclaim a report -->
<!DOCTYPE html>
<html>
    <head>
    
    </head>
    <body>
        <table> 
            <tr>
                <td><a href="logout.php">log-out</a></td>
                <td><a href="newReportPage.php">create reports</a></td>
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
                        <button type="submit">Search</button>
                    </td>
                </tr>
                
            </table>
        </form>

        <div class = "" id = "reportSearchResult">
            <?php include "viewReport.php";?>
        </div>
        

        
        
    </body>

</html>