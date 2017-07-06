<?php

include "../config/config.php";
include "secure.php";
require "connect.php";

ob_start();
session_start();

$view_process = new Connect();

$id       = $_POST['id'];
$title    = $_POST['title'];
$category = $_POST['category'];
$priority = $_POST['priority'];
$message  = $_POST['message'];
$user     = $_SESSION['username'];
$ip       = $_SERVER['REMOTE_ADDR'];

if (isset($_POST['cancel'])) {

  header("Location: ../modules/main.php");
}


if (isset($_POST['save'])) {

    $title    = mysqli_escape_string($view_process->connect(), $title);
    $message  = mysqli_escape_string($view_process->connect(), $message);

      $sql = "UPDATE bugs SET title = '$title', category = '$category', priority = '$priority', message = '$message' WHERE id = '$id' ";

      mysqli_query($view_process->connect(), $sql);
      header("Location: ../modules/main.php?savebug=1");


}

if (isset($_POST['delete'])) {

  $sql = "DELETE FROM bugs WHERE id = " .$id;
  $sql_copy = "INSERT INTO deleted_bugs (id, title, message, priority, category) SELECT `id`,`title`, `message`, `priority`, `category` from bugs WHERE id = '$id'";
  $sql_insert ="UPDATE deleted_bugs SET deleted_by = '{$_SESSION['username']}', delete_date = NOW(), status ='closed' WHERE id = '$id'";
  $sql_log = "INSERT INTO logs (`action_id`, `action`, `log_user`, `action_value`, `date`, `ip`) VALUES ('','D','{$_SESSION['username']}', '$id', NOW(), '$ip')";

        mysqli_select_db($connect, $database);

          // Moves data into another table
          mysqli_query($view_process->connect(), $sql_copy);
          // Adds remaining values to new table
          mysqli_query($view_process->connect(), $sql_insert);
          // Deletes the bug ID number
          mysqli_query($view_process->connect(), $sql);
          // Logs the deleted bug
          mysqli_query($view_process->connect(), $sql_log);
          // Successful redirect
          header("Location: ../modules/main.php?deletebug=1");


}
if (isset($_POST['add_comment'])) {

  $comment = trims($_POST['comment']);
  $comment = mysqli_escape_string($view_process->connect(), $comment);

    if($comment == "") {

      header("Location: ../modules/main.php");

    }


    $sql_insert = "INSERT INTO `comments` (comment_id, bug_id, comment, comment_by, date, ip) VALUES('', '$id', '$comment', '$user', NOW(), '$ip')";

     $result = mysqli_query($view_process->connect(), $sql_insert);
     if ($result) {

        header("Location: ../modules/main.php?successcomment=1");

   }
}


if (isset($_POST['delete_comment'])) {

  $id = $_POST['delete_comment'];

  $sql_delete_comment = "DELETE FROM comments WHERE comment_id = '$id'";
  $result = mysqli_query($view_process->connect(), $sql_delete_comment);


  if ($result) {

      header("Location: ../modules/main.php?deletecomment=1");

  }

}
 ?>
