<?php

 include('session-handle.php');

 
 session_destroy();

 echo "<script>window.location='./index.php'</script>";
 ?> 
