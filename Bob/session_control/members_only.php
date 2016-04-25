<?php

session_start();
require_once('dump_variables.php');
if (isset($_SESSION['validUser'])){
    echo '<p>You are logged in as '.$_SESSION['validUser'].'</p>';
    echo '<p>Members only content goes hers</p>';
}
else {
    if (isset($_COOKIE['validUser'])){
        $_SERVER['validUser'] = $_COOKIE['validUser'];
    }else {
        echo '<p>You are not logged in.</p>';
        echo '<p>Only logged in members may see this page.</p>';
    }
}

echo '<a href="authmain.php">Back to main page</a>';