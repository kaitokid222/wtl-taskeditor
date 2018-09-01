<?php
require_once("include/core.php");
echo wtl_html::header("hello");
echo "<div id=\"wtl-editor\" class=\"wtl-editor-box\" style=\"padding-top:100px\">";
echo "  <h1 class=\"cover-heading\">taskeditor for</h1>";
echo "  <p class=\"lead\"><img src=\"img/wtl_logo_black.png\" border=\"0\" height=\"210\" width=\"480\" /></p>";
echo "  <p class=\"lead\">this pages purpose is to create, sort and rate user-tasks for while true: learn()<br></p>";
echo "  <p class=\"lead\"><a href=\"archive.php\" class=\"btn btn-lg btn-default\">browse archive</a></p>";
echo "</div>";
echo wtl_html::footer();
?>