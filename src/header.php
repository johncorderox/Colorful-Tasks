<head>
  <meta charset="UTF-8">
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>
  <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="../bower_components/bootstrap-growl/jquery.bootstrap-growl.min.js"></script>
  <link href="../css/interface.css" rel="stylesheet" />
  <div class="header-name">
   <a href="javascript:void(0)" onclick="open_sidebar()" id="open">&#9776;</a> 

  <a href="../modules/main.php"><h3>Eternity Tracking</h3></a>
    </div><br />
</head>
<?php
ob_start();
session_start();

$logged = $_SESSION['username'];

if (!isset($_SESSION['username'])) {

    header("Location: index.php");
    exit();

}
?>
