<?php
require_once('bookmark_fns.php');
session_start();
$oldUser = $_SESSION['validUser'];
//×¢Ïú»á»°
unset($_SESSION['validUser']);
$destResult = session_destroy();
if (!empty($oldUser)) {
    if ($destResult) {
        echo 'Logged out';
        doHtmlUrl('login.php', 'Login');
    }else {
        echo 'Could not log you out';
    }
}else {
    echo 'You were not logged in, and so have not been logged out.<br/>';
    doHtmlUrl('login.php', 'Login');
}