<?php
session_start();

// Check Give Access To Browser This

if(isset($_SESSION['GiveAccess']))
{
    if($_SESSION['GiveAccess'] == false)
    {
        header("../Error.php");
        die();
    }
} else {
    header("../Error.php");
    die();
}

// If In Check Is True. Run This Script

require_once '../app/init.php';

$app = new App;