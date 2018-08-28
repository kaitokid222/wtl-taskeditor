<?php
require_once("include/core.php");
if(isset($_GET["id"]) && is_numeric($_GET["id"])){
	$db = new db();
	$task = $db->getTask(intval($_GET["id"]));
}else
	die("sth went wrong page");
echo wtl_html::header("show task #");
echo "<h3>task #" . $task->tid . "</h3><hr>";
echo "<div id=\"wtl-editor\" class=\"wtl-editor-box\">";
echo "  <div class=\"wtl-editor-box-left\">" . wtl_html::create_source_html($task->tasknodes->sources) . "</div>";
echo "  <div class=\"wtl-editor-box-middle\"><h3>" . $task->description . "</h3>";
echo "    <div class=\"wtl-middle-panel\">";
echo "      <div class=\"wtl-middle-panel-left\">";
echo "        <div class=\"wtl-middle-panel-left-top\">";
echo "        </div>";
echo "        <div class=\"wtl-middle-panel-left-bot\">";
echo "        </div>";
echo "      </div>";
echo "      <div class=\"wtl-middle-panel-middle\">";
echo "      </div>";
echo "      <div class=\"wtl-middle-panel-right\">";
echo "      </div>";
echo "    </div>";
echo "  </div>";
echo "  <div class=\"wtl-editor-box-right\">" . wtl_html::create_target_html($task->tasknodes->targets) . "</div>";
echo "</div>";
echo wtl_html::footer();
?>