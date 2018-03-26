<?php
include('session-handle.php');
if(!isset($_SESSION['user']))
{
include('logout.php');
}
else if($_SESSION['user']=="")
{
include('logout.php');
}

