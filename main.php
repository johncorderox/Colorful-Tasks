<?php

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
          <a href="#" class="list-group-item"><b>Number of Bugs: </b><?php num_of_bugs(); ?></a>
          <a href="#" class="list-group-item">Number of User Accounts: <b> accountcount</b></a>
          <a href="#" class="list-group-item">Host Name: <?php echo $servername; ?></a>
          <a href="#" class="list-group-item">Database name: <?php echo $database; ?></a>
        </div>
        <br />
        <div class="list-group">
          <a href="#" class="list-group-item active">Backend Information</a>
          <a href="#" class="list-group-item">PHP Info: <?php echo phpversion(); ?></a>
          <a href="#" class="list-group-item">MySQL Server Status:<?php check_mysql_server_status(); ?></a>
          <a href="#" class="list-group-item">MySQL Vers: <?php echo mysqli_get_server_version($connect); ?></a>
        </div>
      </div>
      <div class="ui-main">
        <div class="ui-main-button-group">
          <button onclick="add_bug()">Add Bug</button>
          <button onclick="edit_bug()">Edit Bug</button>
          <button onclick="delete_bug()">Delete Bug</button>
          <button>Add New User</button><br />
        </div>
        <div class="addform">
          <form action="addfunc.php" method="POST">
          <p id="larger"> Please Enter a Title and a Descriptive Message! </p>
          <input type="text" placeholder="Title *" name="title" id="title"/><br />
          <input type="text" placeholder="Message *" id="message"></textarea><br />
          <select class="form-control">
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
          </select><br />
          <button type="submit" name="submit2" id="add-button">Submit</button>
          <button type="button" onclick="cancel(0)">Cancel</button>
        </form>
      </div>
      <div class="editform">
        <form action="#" method="#">
          <input type="text" id="edit" />
        </form>
      </div>
      </div>
      <div class="table-design">
      </div>
  </body>
  <script type='text/javascript' src='src/js/view.js'></script>
</html>
