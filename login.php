<?php
$username = $password = "";
$usernameErr = $passwordErr = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate Username (letters, numbers, underscores, min 4 chars)
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } elseif (!preg_match("/^[a-zA-Z0-9_]{4,}$/", $_POST["username"])) {
        $usernameErr = "Username must be at least 4 characters and contain only letters, numbers, or underscores";
    } else {
        $username = htmlspecialchars($_POST["username"]);
    }

    // Validate Password (min 6 chars, at least one letter and one number)
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/", $_POST["password"])) {
        $passwordErr = "Password must be at least 6 characters, include letters and numbers";
    } else {
        $password = htmlspecialchars($_POST["password"]);
    }

    // If no errors, redirect or process login
    if (empty($usernameErr) && empty($passwordErr)) {
        // Example: redirect to landing page
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookWorm Log-in Portal</title>
  <link rel="stylesheet" href="styles-login.css">
</head>
<body>

  <div class="center-container">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <h2 class="form-title">BookWorm</h2>

      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>" placeholder="Enter username">
        <span class="error"><?php echo $usernameErr; ?></span>
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter password">
        <span class="error"><?php echo $passwordErr; ?></span>
      </div>

      <button type="submit">Log In</button>

      <div class="register-section">
        <p>No account yet?</p>
        <a href="register.php" class="register-link">Create an account!</a>
      </div>
    </form>
  </div>

</body>
</html>