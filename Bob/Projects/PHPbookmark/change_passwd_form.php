<?php
require_once('bookmark_fns.php');
session_start();
doHtmlHeader('Change password');
checkValidUser();
displayPasswdForm();
displayUserMenu();
doHtmlFooter();

