<?php
  include('config.php');
  include('connect.php');


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



  if(isset($_POST['cancel'])) {

    header("location: main.php");
  }

?>

<?php include 'main.php'; ?>
<html>
<body>
  <div class="deleteform">
    <form action="delete_main.php" method="POST">
      <div id="description_delete"></div>
      <input type="text" id="del_start" name ="delete_id" placeholder="ID #: "/><br />
      <button type="submit" name="submit_delete" id="add-button">Submit</button>
      <button type="button" name="cancel" >Cancel</button>
    </form>
  </div>
  <script type='text/javascript' src='src/js/view.js'></script>
</body>
</html>
<script>
$(document).ready(function() {

  $('.ui-main-button-group').hide("fast");
  $('.deleteform').fadeIn("slow");

});


</script>
