<?php


// YOU CAN SET VARIABLES OF ERROR OUTPUT MESSAGES AND SET TO NULL


// <?PHP $ERROR


// $ERROR += YOU DID NOT ENTER A NAME




  include('config.php');
  include('connect.php');
  include('functions.php');
?>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="src/css/interface.css" rel="stylesheet" />
  </head>
  <body>
    <div class="header-name">
  <?php echo '<h3>Eternity Tracking</h3><br />'; ?>
    </div><br />
      <div class="leftside-info">
        <div class="list-group">
          <a href="#" class="list-group-item active">Main Information</a>
          <a href="#" class="list-group-item"><b>Number of Bugs:</b> <?php num_of_bugs(); ?></a>
          <a href="#" class="list-group-item"><b>Number of User Accounts:</b> <?php num_of_accounts(); ?></a>
          <a href="#" class="list-group-item"><b>Host Name:</b> <?php echo $servername; ?></a>
          <a href="#" class="list-group-item"><b>Database name:</b> <?php echo $database; ?></a>
        </div>
        <br />
        <div class="list-group">
          <a href="#" class="list-group-item active">Backend Information</a>
          <a href="#" class="list-group-item"><b>PHP Info:</b> <?php echo phpversion(); ?></a>
          <a href="#" class="list-group-item"><b>MySQL Server Status:</b><?php check_mysql_server_status(); ?></a>
          <a href="#" class="list-group-item"><b>MySQL Vers:</b> <?php echo mysqli_get_server_version($connect); ?></a>
        </div>
      </div>
      <div class="ui-main">
        <div class="ui-main-button-group">
          <button onclick="add_bug()">Add Bug</button>
          <button onclick="edit_bug()">Edit Bug</button>
          <button onclick="delete_bug()">Delete Bug</button>
          <button onclick="new_user()">Add New User</button><br />
          <button onclick="remove_user()">Remove User</button>
          <button onclick="remove_user()">Bug List</button><br />
        </div>
        <div class="addform2">
          <form action="addfunc.php" method="POST">
          <p id="larger"> Please Enter a Title and a Descriptive Message! </p>
          <input type="text" placeholder="Title *" name="title" id="title"/><br />
          <input type="text" placeholder="Message *" id="message"></textarea><br />
          <select class="form-control" name="priority" id="select_box">
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
          </select><br />
          <button type="submit" name="submit2" id="add-button">Submit</button>
          <button type="button" onclick="cancel(0)">Cancel</button>
        </form>
      </div>
      <div class="editform">
        <form action="main.php" method="POST">
          <div id="description_main"><br /></div>
          <input type="text" id="edit_start" name ="edit_id" placeholder="ID #: "/><br />
          <div class="edit_hidden">
            <input type="text" placeholder="Title *" name="title" id="title_edit"/><br />
            <input type="text" placeholder="Message *" id="message_edit"></textarea><br />
            <select class="form-control" name="priority" id="select_box">
              <option value="Low">Low</option>
              <option value="Medium">Medium</option>
              <option value="High">High</option>
            </select>
          </div>
          <button type="submit" name="submit_edit" id="add-button">Submit</button>
          <button type="button" onclick="cancel(0)">Cancel</button>
        </form>
      </div>
      <div class="deleteform">
        <form action="main.php" method="POST">
          <div id="description_delete"></div>
          <input type="text" id="del_start" name ="delete_id" placeholder="ID #: "/><br />
          <button type="submit" name="submit_delete" id="add-button">Submit</button>
          <button type="button" onclick="cancel(0)">Cancel</button>
        </form>
      </div>
      <div class="newuserform">
        <form action="main.php" method="POST">
          <div id="description_newuser">
            <p id="larger">
              Please enter desired Username and Password.
            </p><br />
            <p>
              Username and Password must be longer than 7 characters!
          </div>
          <input type="text" id="user_new" name ="username_new" placeholder="Username *"/><br />
          <input type="password" id="pass_new" name ="password_new" placeholder="Password *"/><br />
          <button type="submit" name="submit_newuser" id="add-button">Submit</button>
          <button type="button" onclick="cancel(0)">Cancel</button>
        </form>
      </div>
      <div class="removeuserform">
        <form action="removeuser.php" method="POST">
          <p id="larger">
            Enter Username ID:
          </p>
          <!-- DIV HERE WHERE A PHP FUNCTION WILL CALL AND VIEW LIST OF USERNAMES + IDS -->
          <input type="text" id="remove_id" name ="delete_id" placeholder="ID #: "/><br />
          <button type="submit" name="submit_edit" id="add-button">Submit</button>
          <button type="button" onclick="cancel(0)">Show Users</button>
          <button type="button" onclick="cancel(0)">Cancel</button>

        </form>
      </div>

      <div class="table-design">
      </div>
  </body>
  <script type='text/javascript' src='src/js/view.js'></script>
</html>


<?php



  if (isset($_POST['submit_delete'])) {

    if (!empty($_POST['delete_id'])) {

      $id = $_POST['delete_id'];
      mysqli_select_db($connect, $database);

          $sql = "DELETE FROM bugs WHERE id = " .$id;
          $test = "SELECT * FROM bugs WHERE id = " .$id;

          $query = mysqli_query($connect, $test);

          if(mysqli_num_rows($query) > 0 ) {

            mysqli_query($connect, $sql);

            print ' bug number ' .$id . ' has been deleted';
          } else {

              print ' bug number ' . $id . ' does not exist';
          }
  }

}




  if(isset($_POST['submit_newuser'])) {

      if(!empty($_POST['first']) && !empty($_POST['second'])) {

        $username = $_POST['first'];
        $password = $_POST['second'];

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        mysqli_select_db($connect, $database);


        mysqli_query($connect, $sql);



      }


  }

?>
