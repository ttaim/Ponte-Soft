<?php
// Initialize the session
session_start();

// Check if the form has been submitted
if (isset($_POST['login'])) {
  // Connect to the database
  $mysqli = new mysqli("localhost", "username", "password", "login_system");

  // Check for errors
  if ($mysqli->connect_error) {
    die("Connection failed: ". $mysqli->connect_error);
  }

  // Get the form data
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Prepare and bind the SQL statement
  $stmt = $mysqli->prepare("SELECT * FROM users WHERE username =? AND password =?");
  $stmt->bind_param("ss", $username, $password);

  // Execute the SQL statement
  $stmt->execute();

  // Get the result
  $result = $stmt->get_result();

  // Check if the user exists
  if ($result->num_rows > 0) {
    // Set the session variables
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;

    // Redirect to the dashboard
    header("location: dashboard.php");
    exit;
  } else {
    echo "Invalid username or password!";
  }

  // Close the connection
  $stmt->close();
  $mysqli->close();
}
?>

<!-- HTML form -->
<form action="login.php" method="post">
  <label for="username">Username:</label>
  <input id="username" name="username" required="" type="text" />
  <label for="password">Password:</label>
  <input id="password" name="password" required="" type="password" />
  <input name="login" type="submit" value="Login" />
</form>