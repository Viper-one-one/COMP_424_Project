<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// initializing variables
$pre_sanitize_first_name;
$pre_sanitize_last_name;
$pre_sanitize_email;
$pre_sanitize_password;
$pre_sanitize_dob;
$pre_sanitize_username;

$user_first_name = "";
$user_last_name = "";
$user_dob = "";
$user_name = "";
$user_email = "";
$user_role = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'sergio', 'Password123!', 'registration'
);
// a different implementation?
$dsn = "mysql:host=$localhost;dbname=$registration";
$conn = new PDO($dsn, "sergio", "Password123!");

//Debug purpose clean this up afterwards
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form

  $user_first_name = mysqli_real_escape_string($db, $_POST['first_name']);
  $user_last_name = mysqli_real_escape_string($db, $_POST['last_name']);
  $user_dob = mysqli_real_escape_string($db, $_POST['dob']);
  $user_name = mysqli_real_escape_string($db, $_POST['username']);
  $user_email = mysqli_real_escape_string($db, $_POST['email']);
  $user_role = 'user';  // Assuming a default role for registration
  $hashed_user_password = md5(mysqli_real_escape_string($db, $_POST['password_1'])); // Encrypt the password

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($user_first_name)) { array_push($errors, "First name is required"); }
  if (empty($user_last_name)) { array_push($errors, "Last name is required"); }
  if (empty($user_dob)) { array_push($errors, "Date of Birth is required"); }
  if (empty($user_name)) { array_push($errors, "Username is required"); }
  if (empty($user_email)) { array_push($errors, "Email is required"); }
  if (empty($hashed_user_password)) { array_push($errors, "Password is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user_table WHERE user_name='$user_name' OR user_email='$user_email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['user_name'] === $user_name) {
      array_push($errors, "Username already exists");
    }

    if ($user['user_email'] === $user_email) {
      array_push($errors, "Email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    //$query = "INSERT INTO user_table (user_first_name, user_last_name, user_dob, user_name, user_email, hashed_user_password, user_role) 
    //          VALUES('$user_first_name', '$user_last_name', '$user_dob', '$user_name', '$user_email', '$hashed_user_password', '$user_role')";
    $update_sql = "INSERT INTO user_table (user_first_name, user_last_name, user_dob, user_name, user_email, hashed_user_password, user_role) 
    VALUES(:user_first_name, :user_last_name, :user_dob, :user_name:, :user_email, :hashed_user_password, :user_role)";
    $statement = $conn->prepare($update_sql);
    $statement->bindValue(":username", $user_first_name);
    $statement->bindValue(":user_last_name", $user_last_name);
    $statement->bindValue(":user_dob", $user_dob);
    $statement->bindValue(":user_name", $user_name);
    $statement->bindValue(":user_email", $user_email);
    $statement->bindValue(":password", $hashed_user_password);
    $statement->bindValue(":user_role", $user_role);
    $statement->execute();
    // mysqli_query($db, $query);
    
    $_SESSION['user_name'] = $user_name;
    $_SESSION['success'] = "You are now registered and logged in";
    header('location: index.php');
  }
}
// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
        array_push($errors, "Username is required");
  }
  if (empty($password)) {
        array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $sql = "SELECT * FROM user_table WHERE user_name=:username AND hashed_user_password=:hashed_password";
    $statement = $conn->prepare($sql);
    $statement->bindValue(":username", $username);
    $statement->bindValue(":hashed_password", $password);
    $statement->execute();
    //$results = mysqli_query($db, $query);
	if (mysqli_num_rows($results) == 1) {
    $user = mysqli_fetch_assoc($results); 
    $_SESSION['user_id'] = $user['id']; // Store user ID in the session
    $updateLoginQuery_sql = "INSERT INTO user_logins (last_login, login_total, id) VALUES (NOW(), 1, :id) ON DUPLICATE KEY UPDATE last_login = NOW(), login_total = login_total + 1";
    $statement = $conn->prepare($updateLoginQuery_sql);
    $statement->bindValue(":id", $user['id']);
    $statement->execute();
    //mysqli_query($db, $updateLoginQuery);
    // Retrieve last login and login total
        $loginInfoQuery = "SELECT last_login, login_total FROM user_logins WHERE id = " . $user['id'];
        $loginInfoResult = mysqli_query($db, $loginInfoQuery);
        $loginInfo = mysqli_fetch_assoc($loginInfoResult);  
    $_SESSION['username'] = $username;
    $_SESSION['last_login'] = $loginInfo['last_login'];
        $_SESSION['login_total'] = $loginInfo['login_total'];
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
        }else {
                array_push($errors, "Wrong username/password combination");
        }
  }
}
?>
