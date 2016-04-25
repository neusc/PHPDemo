<?php
require_once('book_sc_fns.php');
session_start();
doHtmlHeader("Change administrator password");
checkAdminUser();

displayPasswordForm();

doHtmlUrl("admin.php", "Back to administration menu");
doHtmlFooter();
?>