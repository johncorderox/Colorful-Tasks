<?php include 'main.php'; ?>
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
    <input type="text" id="user_new" name ="username" placeholder="Username *"/><br />
    <input type="password" id="pass_new" name ="password" placeholder="Password *"/><br />
    <button type="submit" name="submit_newuser" id="add-button">Submit</button>
    <button type="submit" name="cancel">Cancel</button>
  </form>
</div>
<script type='text/javascript' src='src/js/view.js'></script>
</body>
</html>
<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide("fast");
  $('.newuserform').show();

});

</script>
<?php

include('config.php');
include('connect.php');
include("secure.php");


if(isset($_POST['cancel'])) {

  header("Location: main.php");
}


if(isset($_POST['submit_newuser'])) {

    if(!empty($_POST['username']) && (!empty($_POST['password']))) {

      $username = trims($_POST['username']);
      $password = trims($_POST['password']);
      $password = md5($password);
      $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
      $test = "SELECT * FROM users WHERE users.username = '".$username."'";

      mysqli_select_db($connect, $database);

      $query = mysqli_query($connect, $test) or die(mysqli_error($connect));

      if (mysqli_num_rows($query) > 0) {

        showError();
        echo "The username " . $username . " already exists!";
      } else {

        $result = mysqli_query($connect, $sql);
           if ($result) {

              header("Location: main.php?newuser=1");

           }

      }

  } else if (empty($_POST['username']) or empty($_POST['password'])) {

    showError();
  }

}

function showError() {

     echo '<script type="text/javascript">
           display_input_message(7);
           </script>';

}

?>
