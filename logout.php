<?php
session_start();

if( isset($_SESSION['user_name'] ) ) 
{
	session_destroy();
	session_unset();
	header("Location: login-form.php");
}
else 
    header("Location: reg-form.php");



?>