
<?php
//this checks whether you have really logged in from the loginView, if not 
//it will redirect you back
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: loginView.php");
    exit();
} 
?>