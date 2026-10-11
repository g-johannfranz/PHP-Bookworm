<?php
// Initialize variables
$firstName = $lastName = $email = $username = $password = $confirmPassword = "";
$firstNameErr = $lastNameErr = $emailErr = $usernameErr = $passwordErr = $confirmPasswordErr = $termsErr = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // First Name: only letters, min 2 chars
    if (empty($_POST["firstName"])) {
        $firstNameErr = "First name is required";
    } elseif (!preg_match("/^[A-Za-z]{2,}$/", $_POST["firstName"])) {
        $firstNameErr = "First name must be at least 2 letters";
    } else {
        $firstName = htmlspecialchars($_POST["firstName"]);
    }

    // Last Name: only letters, min 2 chars
    if (empty($_POST["lastName"])) {
        $lastNameErr = "Last name is required";
    } elseif (!preg_match("/^[A-Za-z]{2,}$/", $_POST["lastName"])) {
        $lastNameErr = "Last name must be at least 2 letters";
    } else {
        $lastName = htmlspecialchars($_POST["lastName"]);
    }

    // Email validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    // Username: letters, numbers, underscores, min 4 chars
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } elseif (!preg_match("/^[A-Za-z0-9_]{4,}$/", $_POST["username"])) {
        $usernameErr = "Username must be at least 4 characters (letters, numbers, underscores)";
    } else {
        $username = htmlspecialchars($_POST["username"]);
    }

    // Password: min 6 chars, must contain at least one letter and one number
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/", $_POST["password"])) {
        $passwordErr = "Password must be at least 6 characters, include letters and numbers";
    } else {
        $password = $_POST["password"];
    }

    // Confirm Password
    if (empty($_POST["confirmPassword"])) {
        $confirmPasswordErr = "Please confirm your password";
    } elseif ($_POST["confirmPassword"] !== $_POST["password"]) {
        $confirmPasswordErr = "Passwords do not match";
    } else {
        $confirmPassword = $_POST["confirmPassword"];
    }

    // Terms checkbox
    if (empty($_POST["terms"])) {
        $termsErr = "You must agree to the Terms of Service and Privacy Policy";
    }

    // If no errors, process registration (e.g., save to DB)
    if (empty($firstNameErr) && empty($lastNameErr) && empty($emailErr) && empty($usernameErr) && empty($passwordErr) && empty($confirmPasswordErr) && empty($termsErr)) {
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
  <title>BookWorm Registration</title>
  <link rel="stylesheet" href="styles-login.css">
</head>
<body>
<div class="center-container">
  <div class="login-box">
    <h2 class="form-title">Create Your BookWorm Account</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

      <div class="form-row">
        <div class="form-group">
          <label for="firstName">First Name:</label>
          <input type="text" name="firstName" id="firstName" value="<?php echo $firstName; ?>">
          <span class="error"><?php echo $firstNameErr; ?></span>
        </div>
        <div class="form-group">
          <label for="lastName">Last Name:</label>
          <input type="text" name="lastName" id="lastName" value="<?php echo $lastName; ?>">
          <span class="error"><?php echo $lastNameErr; ?></span>
        </div>
      </div>

      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span>
      </div>

      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>">
        <span class="error"><?php echo $usernameErr; ?></span>
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <span class="error"><?php echo $passwordErr; ?></span>
      </div>

      <div class="form-group">
        <label for="confirmPassword">Verify Password:</label>
        <input type="password" name="confirmPassword" id="confirmPassword">
        <span class="error"><?php echo $confirmPasswordErr; ?></span>
      </div>

      <div class="form-group">
        <input type="checkbox" name="terms" id="terms" <?php if(!empty($_POST["terms"])) echo "checked"; ?>>
        <label for="terms">I agree to the Terms of Service and Privacy Policy.</label>
        <span class="error"><?php echo $termsErr; ?></span>
      </div>

      <button type="submit">Register</button>
    </form>

    <div class="login-section">
      <p>Already have an account?</p>
      <a href="login.php" class="login-link">Log-in here.</a>
    </div>
  </div>
</div>
</body>
</html>
