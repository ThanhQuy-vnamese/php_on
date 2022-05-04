<?php
session_start();
session_destroy();
echo "<script>
         window.location = '../main-ltr/login.php';
      </script>";
?>