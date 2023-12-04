<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// initializing variables
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
    $query = "INSERT INTO user_table (user_first_name, user_last_name, user_dob, user_name, user_email, hashed_user_password, user_role) 
              VALUES('$user_first_name', '$user_last_name', '$user_dob', '$user_name', '$user_email', '$hashed_user_password', '$user_role')";
    mysqli_query($db, $query);
    
    $_SESSION['user_name'] = $user_name;
    $_SESSION['success'] = "You are now registered and logged in";
    header('location: index.php');
  }
}
?>
