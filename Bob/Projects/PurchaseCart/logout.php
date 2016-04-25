<?php
// include function files for this application
require_once('book_sc_fns.php');
session_start();
$oldUser = $_SESSION['admin'];  // store  to test if they *were* logged in
unset($_SESSION['admin']);
session_destroy();

// start output html
doHtmlHeader("Logging Out");

if (!empty($oldUser)) {
    echo "<p>Logged out.</p>";
    doHtmlUrl("login.php", "Login");
} else {
    // if they weren't logged in but came to this page somehow
    echo "<p>You were not logged in, and so have not been logged out.</p>";
    doHtmlUrl("login.php", "Login");
}

doHtmlFooter();
?>