<?php

$message = "Welcome.";

include ("connect.php");
include("functions.php");
include("secure.php");

session_start();

if (isset($_POST['submit'])) {


  $username_l = trims($_POST['username']);
  $password_l = trims($_POST['password']);
  $password_l = md5($password_l);

  $query = "SELECT * FROM `users` WHERE username = '$username_l' and password = '$password_l'";

  $result = mysqli_query($connect, $query);

  $num_of_rows = mysqli_num_rows($result);

    if ($num_of_rows == 1) {


      $_SESSION['username'] = $username_l;
      header("Location: main.php?login=1");

    } else {

      $message = "Invalid Credentials.";
    }

}
mysqli_close($connect);

?>


<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <script src="bower_components/bootstrap-growl/jquery.bootstrap-growl.min.js"></script>
      <link href="src/css/interface.css" rel="stylesheet" />
    </head>
  <body>
<div class="center">
    <?php echo '<h2>' . $message . '</h2>'; ?>
     <form action="index.php" method="POST">
     <input type="text" placeholder="Username *" name="username" id="username" class="error-input"><br />
     <input type="password" placeholder="Password *" name="password" id="password" /><br />
     <button id="login-button" name="submit">Login</button><br />
   </form>
</div>
</body>
  <script type='text/javascript' src='src/js/view.js'></script>
</html>

<?php

  if (isset($_GET['logout']) && $_GET['logout'] == '1') {

    echo '<script type="text/javascript">
          display_input_message(3);
          </script>';
  }


 ?>
