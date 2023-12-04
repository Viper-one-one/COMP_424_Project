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
        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            text-decoration: none;
            color: #4caf50;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <?php
    // Handle login logic here, e.g., check if the form is submitted, validate credentials, etc.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check login credentials (dummy example)
        $username = $_POST["username"];
        $password = $_POST["password"];

        // In a real application, you would check the credentials against a database
        // For simplicity, we'll just use hardcoded values
        $valid_username = "user123";
        $valid_password = "pass123";

        if ($username == $valid_username && $password == $valid_password) {
            echo "<p style='color: green;'>Login successful!</p>";
        } else {
            echo "<p style='color: red;'>Invalid username or password.</p>";
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <br>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</div>

</body>
</html>

