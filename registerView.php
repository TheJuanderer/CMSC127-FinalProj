/*this is the register form for creating new users
this is the "registerView.php" */

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
    <div>
        <form method="POST" action="register.php">
            <label>name</label>
            <input name="name" required>
            <label>contact number</label>
            <input name="contactNo" type="text" required>
            <label>password</label>
            <input name="password" type="password" required>
            <button>Create Account</button>
        </form>
    </div>
    
</body>