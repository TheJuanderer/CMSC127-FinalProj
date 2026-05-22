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
                <td><a href="loginView.php">log-out</a></td>
                <td><a href="newReportPage.php">create reports</a></td>
            </tr>
        </table>
       
        <h2>This is the dashboard!</h2>

        
        <form method = "POST" action = "dashboardView.php">
            <label>Search using report status</label>
            <br>
            <select name = "statusSearch">
                <option value = "OPEN">OPEN</option>
                <option value = "CLOSED">CLOSED</option>
                <option value = "ALL">ALL</option>
            </select>
            <button type="submit">Search</button>
        </form>

        <div class = "" id = "reportSearchResult">
            <?php include "dashboard.php";?>
        </div>
        

        
        
    </body>

</html>