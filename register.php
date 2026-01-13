<?php
session_start();
require "db.php";

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['register'])) {
  $fullname = $_POST['fullname'];
  $username = $_POST['username'];
  $email    = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (fullname, username, email, password)
          VALUES ('$fullname', '$username', '$email', '$password')";

  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Registered successfully!');</script>";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
  <div class="title">Registration</div>

  <div class="content">
    <form method="POST">

      <div class="user-details">

        <div class="input-box">
          <span class="details">Full Name</span>
          <input type="text" name="fullname" required>
        </div>

        <div class="input-box">
          <span class="details">Username</span>
          <input type="text" name="username" required>
        </div>

        <div class="input-box">
          <span class="details">Email</span>
          <input type="email" name="email" required>
        </div>

        <div class="input-box">
          <span class="details">Password</span>
          <input type="password" name="password" required>
        </div>

      </div>

      <div class="button">
        <input type="submit" name="register" value="Register">
      </div>

      <div class="login-link">
          Already have an account?
      <a href="login.php">Login here</a>
</div>


    </form>
  </div>
</div>

</body>
</html>
