<?php

// @desc connects to MySQL and queries the DB for a count.
// uses the function COUNT and echo's the num
function num_of_bugs() {

global $connect;
global $database;

if($connect) {
  mysqli_select_db($connect, $database);
  if(!$database){
    die('Database Not Found! ! ! ');
  }
  $sql = "SELECT COUNT(*) as total FROM bugs";
  $result = mysqli_query($connect, $sql);
  $number = mysqli_fetch_assoc($result);
  echo $number['total'];

  }

}


// @des connects and uses the count function to return n results.
// Returns amount to the main.php page for the first view.
// Uses assoc to output using echo.

function num_of_accounts () {

  include "connect.php";
  $sql = "SELECT COUNT(*) as total FROM users";
  $result = mysqli_query($connect, $sql);
  $number = mysqli_fetch_assoc($result);
  echo $number['total'];

}

// Counts the number of deleted bugs exactly like the num of
// accounts and bugs. uses total as the assoc variable

function num_of_deleted () {

  global $connect;
  global $database;
  mysqli_select_db($connect, $database);
  $sql = "SELECT COUNT(*) as total FROM deleted_bugs";
  $result = mysqli_query($connect, $sql);
  $number = mysqli_fetch_assoc($result);
  echo $number['total'];

}

// @desc Pings the MySQL Server and returns true if connected.
// Throws mysqli_connect_error if there are errors in config.php. Global is
// used to grab variable from connect.
function check_mysql_server_status() {
   global $connect;

     if(mysqli_ping($connect)) {
        echo ' Connected';
        }
}

// Retrieves the last bug from the database.
// Connects and fetces using the query from the var $sql
// Selects all bugs from the message column, orders them by id and
// decends the list going from ex 9-1. Limiting 1 showing the last.

function getLastBug() {

global $connect;

if ($connect) {

  $sql = "SELECT title from `bugs` ORDER BY `id` DESC LIMIT 1";
  $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) != 1) {

        echo '<p>Whoo hoo! No bugs reported!</p>';
    } else {

        while ($row = mysqli_fetch_assoc($result)) {

          echo '<p><b>Last bug reported:</b> '  .$row['title'].'</p>';
        }
     }

  }

}

function showError() {

     echo '<script type="text/javascript">
           display_input_message(7);
           </script>';
}

function getReported ($x) {
  global $connect;

  if ($connect && $x == 1) {

    $sql_get_r = "SELECT COUNT(*) as total FROM bugs WHERE reported_by = '{$_SESSION['username']}'";
    $result = mysqli_query($connect, $sql_get_r);
    $number = mysqli_fetch_assoc($result);

    echo $number['total'];

  } else if ($connect && $x == 2) {

    $sql_get_r = "SELECT COUNT(*) as total FROM deleted_bugs WHERE deleted_by = '{$_SESSION['username']}'";
    $result = mysqli_query($connect, $sql_get_r);
    $number = mysqli_fetch_assoc($result);

    echo $number['total'];

  }
}
 ?>
