<?php
include 'main.php';
include('config.php');
include('connect.php');
include("secure.php");


if(isset($_POST['cancel'])) {

  header("Location: main.php");
}


if(isset($_POST['submit_newuser'])) {

    if(!empty($_POST['username']) && (!empty($_POST['password'])) && !empty($_POST['email'])) {

      $username = trims($_POST['username']);
      $password = trims($_POST['password']);
      $password = md5($password);
      $email = trims($_POST['email']);
      $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
      $test = "SELECT * FROM users WHERE users.username = '".$username."'";

      mysqli_select_db($connect, $database);

      $query = mysqli_query($connect, $test) or die(mysqli_error($connect));

      if (mysqli_num_rows($query) > 0) {

        showError();

      } else {

        $result = mysqli_query($connect, $sql);
           if ($result) {

              header("Location: main.php?newuser=1");

           }

      }

  } else if (empty($_POST['username']) or empty($_POST['password']) or empty($_POST['email'])) {

    showError();
  }

}

function showError() {

     echo '<script type="text/javascript">
           display_input_message(7);
           </script>';
}
?>
<html>
<body>
<div class="newuserform">
  <form action="add_new_main.php" method="POST">
      <p id="larger">
        Please enter desired Username and Password.
      </p><br />
      <ul>
        <li>
          Username and Password must be longer than 7 characters.
        </li>
        <li>
          Please make both fields unique for the account. Numbers and Letters.
        </li>
      </ul>
      <br />
    <input type="text" id="user_new" name ="username" placeholder="Username *"/><br />
    <input type="password" id="pass_new" name ="password" placeholder="Password *"/><br />
    <input type="text" id="email_new" name ="email" placeholder="Email *"/><br />
    <button type="submit" name="submit_newuser" id="add-button">Submit</button>
    <button type="submit" name="cancel">Cancel</button>
  </form>
</div>
</body>
</html>
<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide("fast");
  $('.newuserform').show();

});

</script>
