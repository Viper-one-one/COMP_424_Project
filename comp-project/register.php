<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script>
        var button = document.getElementById("reg_user");
        button.addEventListener("click", validateForm);
    </script>
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
    <script src="validation.js">
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Register</h2>
    </div>

    <form method="post" action="register.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?php echo isset($first_name) ? $first_name : ''; ?>">
        </div>
        <div class="input-group">
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>">
        </div>
        <div class="input-group">
            <label>Date of Birth</label>
            <input type="date" name="dob" value="<?php echo isset($dob) ? $dob : ''; ?>">
        </div>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label>Confirm password</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="reg_user" id="reg_user">Register</button>
        </div>
        <p>Already a member? <a href="index.php">Sign in</a></p>
    </form>
</div>

</body>
</html>