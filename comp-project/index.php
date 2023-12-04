<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
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
      width: 400px;
    }

    .header h2 {
      color: #333;
    }

    .content {
      margin-top: 20px;
    }

    .success {
      color: green;
    }

    p {
      margin-top: 16px;
      font-size: 18px;
      color: #333;
    }

    a {
      text-decoration: none;
      color: #4caf50;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }

    .logout-btn {
      background-color: #f44336;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 20px;
    }

    .logout-btn:hover {
      background-color: #d32f2f;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="header">
      <h2>Welcome to the Home Page</h2>
    </div>

    <!-- Notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="success">
        <h3><?php echo $_SESSION['success']; ?></h3>
      </div>
    <?php endif ?>

    <!-- Logged in user information -->
    <?php if (isset($_SESSION['username'])) : ?>
      <div class="content">
        <p>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></p>
        <p>Last Login: <?php echo $_SESSION['last_login']; ?></p>
        <p>Login Total: <?php echo $_SESSION['login_total']; ?></p>
    <!-- Download link -->
        <p><a href="download.php" class="download-btn">Download Company Confidential File</a></p>
        <p><a href="index.php?logout='1'" class="logout-btn">Logout</a></p>
      </div>
    <?php endif ?>
  </div>

</body>
</html>

