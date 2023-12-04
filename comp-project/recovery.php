<!-- recovery.php -->
<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Recovery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px; /* Adjust the width as needed */
        }
        .header h2 {
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }
        .btn {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        p {
            margin-top: 16px;
            font-size: 14px;
        }
        a {
            text-decoration: none;
            color: #4caf50;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Password Recovery</h2>
    </div>

    <form method="post" action="recovery.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="recovery_email">
        </div>
        <!-- Add more recovery fields as needed -->
        <div class="input-group">
            <label>Security Question 1</label>
            <input type="text" name="security_question_1">
        </div>
        <div class="input-group">
            <label>Security Question 2</label>
            <input type="text" name="security_question_2">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="recover_password">Recover Password</button>
        </div>
    </form>

    <p>Remember your password? <a href="login.php">Login here</a></p>
</div>

</body>
</html>

