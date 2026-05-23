# CMSC127-FinalProj
Final Project for CMSC 127

## Database
'''
the database is named "lf_db"

Note: there is already added dummy values in the database
'''


To open the page, type this as an example
http://localhost/*folder in htdocs*/registerView.php

This is the header page
http://localhost/*folder in htdocs*/loginView.php

This is the main page
*no link yet, but its going to be dashboard.php


ROLES
- so basically we dont need to create a register page for admins, we create the admins directly from the database itself
- although we need to add a login page but for admins, this will be the loginAdminView


## naming php files
If the filename ends with “Page” (e.g., newReportPage), it represents a UI/page component. These files are mainly responsible for rendering the interface and handling user interactions on that specific screen.

If the filename starts with “view” (e.g., viewReport), it refers to a file that handles data retrieval (queries) and returns data, usually from an API or backend service. These are typically used for fetching and preparing data for display, rather than handling UI logic.

In general, “Page” files focus on presentation, while “view” files focus on data fetching and processing logic.
