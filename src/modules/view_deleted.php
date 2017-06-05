<?php
include 'module_header.php';
include('../config/config.php');
include('../lib/functions.php');
include ('../lib/secure.php');
?>
<body>
  <form action="view_deleted.php" method="POST">
    <div class="search_input">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search*" autofocus>
      <div class="input-group-btn">
        <button class="btn btn-default" id="searchButton" type="submit">
          <i class="glyphicon glyphicon-search"></i>
        </button>
      </div>
    </div>
    </div>
  </form>
</body>
<?php



if (isset($_POST['undelete'])) {

  $id = $_POST['undelete'];

      $sql  = "INSERT INTO `bugs` (id, title, message, priority, category, status, reported_by, date) ";
      $sql .= "SELECT `id`, `title`, `message`, `priority`, `category`, `status`, `deleted_by`, `delete_date` FROM deleted_bugs ";
      $sql .= "WHERE `id` = '$id' ";

      $sql_value_change  = "UPDATE status, reported_by, date SET `status` = 'open', reported_by = 'System', date = NOW() WHERE id = '$id' ";

      $sql_delete = "DELETE FROM deleted_bugs WHERE id = '$id' ";

     $connect->query($sql);
     $connect->query($sql_value_change);
     $connect->query($sql_delete);

     header("Location: view_deleted.php?undelete=1");


}

if (isset($_POST['destroy'])) {

  $id = $_POST['destroy'];

  $sql_destroy = "DELETE FROM deleted_bugs WHERE id = '$id'";
  $sql_destroy_comments = "DELETE FROM comments WHERE bug_id = '$id'";

  $result_destroy          = $connect->query($sql_destroy);
  $result_destroy_comments = $connect->query($sql_destroy_comments);

  if ($result_destroy && $result_destroy_comments) {

      header("Location: view_deleted.php?destroy=1");
  }



}

$undelete_icon = "<span class=\"glyphicon glyphicon-refresh\"></span>";

        $sql_view_deleted = "SELECT id, title, status, delete_date, deleted_by FROM deleted_bugs WHERE status = 'closed'";

        $result = $connect->query($sql_view_deleted);
        $result_count = $result->num_rows;


        echo "<table class=\"table table-hover\">";
        echo "<thead> <tr> <tbody>";
        echo "<tr><th>ID: </th><th>Title</th><th>Status</th><th>Delete Date</th><th>Deleted By</th><th>Actions</th>";
        echo "</thead><tbody>";
        while($row = $result->fetch_assoc()) {

            echo "<tr><td>".$row["id"]."</td><td>".$row["title"]."</td><td>".$row["status"]."</td><td>".$row["delete_date"]."</td><td>";
            echo $row["deleted_by"]."</td>";
            echo "<form action=\"view_deleted.php\" method=\"POST\">";
            echo "<td><div class=\"btn-group\">
              <button type\"submit\" class=\"btn btn-primary\" id=\"view_deleted\" name=\"undelete\" value='".$row['id']."'>Undelete ".$undelete_icon."</button>
              <button type=\"submit\" class=\"btn btn-danger\" id=\"view_deleted\" name=\"destroy\" value='".$row['id']."'>Destroy</button>
              </td>";
          }
          echo "</tbody></table></form>";

?>
<script type='text/javascript' src='../js/notification.js'></script>
<?php

if (isset($_GET['undelete']) && $_GET['undelete'] == 1) {

  echo '<script type="text/javascript">
        display_input_message(13);
        </script>';
}

if (isset($_GET['destroy']) && $_GET['destroy'] == 1) {

  echo '<script type="text/javascript">
        display_input_message(14);
        </script>';
}

?>
