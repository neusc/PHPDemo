<?php
require_once('bookmark_fns.php');
session_start();
doHtmlHeader('Add Bookmarks');
checkValidUser();
displayAddBMForm();
displayUserMenu();
doHtmlFooter();
?>