<?php
session_start();
require "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      header("Location: index.php");
      exit;
    } else {
      $error = "Wrong password.";
    }
  } else {
    $error = "Account not found.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Poppins, sans-serif;
}

body {
  min-height: 100vh;
  background: url("ocean.jpg") no-repeat center center fixed;
  background-size: cover;
  display: flex;
  justify-content: center;
  align-items: center;
}

.container {
  width: 420px;
  background: #ffffff;
  padding: 25px 30px;
  border-radius: 8px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}

.title {
  text-align: center;
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 20px;
}

.input-box {
  margin-bottom: 15px;
}

.input-box span {
  display: block;
  margin-bottom: 5px;
  font-size: 14px;
}

.input-box input {
  width: 100%;
  height: 42px;
  padding-left: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

.button input {
  width: 100%;
  height: 45px;
  background: #111827;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.button input:hover {
  background: #1f2937;
}

p {
  text-align: center;
  margin-top: 10px;
  font-size: 14px;
}

.error {
  color: red;
  text-align: center;
  margin-bottom: 10px;
}
</style>
</head>

<body>

<div class="container">
  <div class="title">Login</div>

  <?php if ($error): ?>
    <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="input-box">
      <span>Email</span>
      <input type="email" name="email" required>
    </div>

    <div class="input-box">
      <span>Password</span>
      <input type="password" name="password" required>
    </div>

    <div class="button">
      <input type="submit" value="Login">
    </div>
  </form>

  <p>No account yet? <a href="register.php">Register</a></p>
</div>

</body>
</html>
