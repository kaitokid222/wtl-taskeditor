<?php
require_once("include/core.php");
echo wtl_html::header("login");
echo "<div id=\"wtl-editor\" class=\"wtl-editor-box\" style=\"padding-top:100px\">";
echo "  <h1 class=\"cover-heading\">login with your steamaccount</h1>";
echo "  <br><br>";
echo "  <p class=\"lead\">you get redirected to steam, to do the login. no data is stored on this server. the purpose is to link your activity to any number. in this case your steamid. since while true learn is a steamgame, I assume all except the pirates have a steamaccount. again: no personal data gets stored here.<br>the sourcecode of the page is free and public and you can get it on github.<br></p>";
if(!isset($_SESSION['steamid']))
	echo "  <p class=\"lead\">" . loginbutton() . "</p>";
else
	echo "  <p class=\"lead\">" . logoutbutton() . "</p>";
echo "</div>";
echo wtl_html::footer();
?>