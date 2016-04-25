<?php
// include function files for this application
require_once('book_sc_fns.php');
session_start();

doHtmlHeader("Deleting category");
if (checkAdminUser()) {
  if (isset($_POST['catid'])) {
    if(deleteCategory($_POST['catid'])) {
      echo "<p>Category was deleted.</p>";
    } else {
      echo "<p>Category could not be deleted.<br />
            This is usually because it is not empty.</p>";
    } 
  }
  else {
    echo "<p>No category specified.  Please try again.</p>";
  }
  doHtmlUrl("admin.php", "Back to administration menu");
} else {
  echo "<p>You are not authorised to view this page.</p>";
}
doHtmlFooter();
?>