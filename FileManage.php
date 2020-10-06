<?php

require_once 'app/config/config.php';

session_start();

if(isset($_POST['submit']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(($username == UsernameFile) && ($password == PasswordFile))
	{
		$_SESSION['GiveAccessFile'] = true;
	}
}

if(isset($_SESSION['GiveAccessFile']))
{
	if($_SESSION['GiveAccessFile'] == true)
	{
		require_once 'assets/FileManage.php';
	} else {
		require_once 'assets/Login.php';
	}
} else {
	require_once 'assets/Login.php';
}