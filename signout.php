<?php
session_start();

if(!isset($_SESSION['session_user']))
{
   $_SESSION['session_user']="";
}

if(isset($_GET['access']))
{
   $_SESSION['session_user']=$_GET['access'];
}

if(!isset($_SESSION['error']))
{
   $_SESSION['error']="";
}

session_destroy();

header('Location: ./Enrollment.php');
?>
