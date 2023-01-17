<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';


if(isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

 
    if($_POST['submit'] === 'Register') 
    {

        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        mysqli_query($conn, $query);

        // redirect to index page
        header("Location: index.php");
    } elseif ($_POST['submit'] === 'Login') 
    {
        // check if the username and password match the record in the database
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
   
            $_SESSION['username'] = $username;
            header("Location: index.php");
        } else {
            // display an error message
            echo "Invalid username or password";
        }
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login/Registration Form</title>
    <style>
      /* Add some styling for the form */
      form {
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
      }

      /* Style the form elements */
      input[type="text"], input[type="password"] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
      }

      /* Style the submit button */
      input[type="submit"] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      input[type="submit"]:hover {
        background-color: #45a049;
      }

      /* Add some spacing and a label for the form */
      label {
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: bold;
      }

      /* Add some styling for the error message */
      .error {
        color: red;
        font-size: 12px;
        margin-top: 10px;
      }

    </style>
  </head>
  <body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <input type="submit" name="submit" value="Register">
      <input type="submit" name="submit" value="Login">
    </form>
    <div class="error">
        <?php
            if(isset($_POST['submit']) && $_POST['submit'] === 'Login'){
                echo "Invalid username or password";
            }
        ?>
    </div>
  </body>
</html>
