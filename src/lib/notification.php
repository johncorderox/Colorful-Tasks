<?php

  class Notification {


    public function notifications() {

      if (isset($_GET['successbug']) && $_GET['successbug']=='1') {

        echo '<script type="text/javascript">
              display_input_message(0, \'success\');
              </script>';

      }

      if (isset($_GET['deletebug']) && $_GET['deletebug']=='1') {

        echo '<script type="text/javascript">
              display_input_message(1, \'success\');
              </script>';

      }

      if (isset($_GET['login']) && $_GET['login']=='1') {

        echo '<script type="text/javascript">
              display_input_message(2, \'success\');
              </script>';

      }

      if (isset($_GET['logout']) && $_GET['logout']=='1') {

        echo '<script type="text/javascript">
              display_input_message(3, \'info\');
              </script>';

      }

      if (isset($_GET['removeuser']) && $_GET['removeuser']=='1') {

        echo '<script type="text/javascript">
              display_input_message(4, \'success\');
              </script>';

      }

      if (isset($_GET['newuser']) && $_GET['newuser']=='1') {

        echo '<script type="text/javascript">
              display_input_message(6, \'success\');
              </script>';

      }

      if (isset($_GET['savebug']) && $_GET['savebug']=='1') {

        echo '<script type="text/javascript">
              display_input_message(10, \'success\');
              </script>';

      }

      if (isset($_GET['successcomment']) && $_GET['successcomment']=='1') {

        echo '<script type="text/javascript">
              display_input_message(11, \'success\');
              </script>';

      }

      if (isset($_GET['deletecomment']) && $_GET['deletecomment']=='1') {

        echo '<script type="text/javascript">
              display_input_message(12, \'success\');
              </script>';

      }

      if (isset($_GET['status']) && $_GET['status']=='1') {

        echo '<script type="text/javascript">
              display_input_message(15, \'info\');
              </script>';

      }

      if (isset($_GET['status']) && $_GET['status']=='2') {

        echo '<script type="text/javascript">
              display_input_message(16, \'info\');
              </script>';

      }

      if (isset($_GET['status']) && $_GET['status']=='3') {

        echo '<script type="text/javascript">
              display_input_message(17, \'info\');
              </script>';

      }

      if (isset($_GET['status']) && $_GET['status']=='4') {

        echo '<script type="text/javascript">
              display_input_message(18, \'info\');
              </script>';

      }

      if (isset($_GET['deleteall']) && $_GET['deleteall']=='1') {

        echo '<script type="text/javascript">
              display_input_message(19, \'success\');
              </script>';

      }

      if (isset($_GET['undelete']) && $_GET['undelete'] == 1) {

        echo '<script type="text/javascript">
              display_input_message(13, \'success\');
              </script>';
      }

      if (isset($_GET['destroy']) && $_GET['destroy'] == 1) {

        echo '<script type="text/javascript">
              display_input_message(14, \'info\');
              </script>';
      }

      if (isset($_GET['deleteaccount']) && $_GET['deleteaccount'] == 1) {

        echo '<script type="text/javascript">
              display_input_message(22, \'info\');
              </script>';
      }

   }

}


 ?>
