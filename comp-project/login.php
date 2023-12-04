<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        /* New styles for recovery section */
        .recovery-section {
            margin-top: 10px;
        }

        .recovery-link {
            font-size: 14px;
            margin-top: 10px;
            color: #4caf50;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Login</h2>
    </div>

    <form method="post" action="login.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="login_user">Login</button>
        </div>
        <p>Not yet a member? <a href="register.php">Sign up</a></p>

        <!-- Recovery section in one line -->
        <div class="recovery-section">
            <p>Forgot your username or password? <a class="recovery-link" href="recovery.php">Recover here</a></p>
        </div>
    </form>
</div>

</body>
</html>

