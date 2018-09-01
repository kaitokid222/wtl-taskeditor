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
echo "          <div class=\"wtl-middle-panel-left-top-icon\"><i class=\"far fa-thumbs-up fa-2x\"></i></div>";
echo "          <div class=\"wtl-middle-panel-left-top-label\">upvote</div>";
echo "        </div>";
echo "        <div class=\"wtl-middle-panel-left-bot\">";
echo "          <div class=\"wtl-middle-panel-left-bot-icon\"><i class=\"far fa-thumbs-down fa-2x\"></i></div>";
echo "          <div class=\"wtl-middle-panel-left-bot-label\">downvote</div>";
echo "        </div>";
echo "      </div>";
echo "      <div class=\"wtl-middle-panel-right\">";
echo "        <div class=\"wtl-middle-panel-right-top\">";
echo "          <div class=\"wtl-middle-panel-right-top-icon\"><i class=\"far fa-surprise fa-2x\"></i></div>";
echo "          <div class=\"wtl-middle-panel-right-top-label\">report</div>";
echo "        </div>";
echo "        <div onmousedown=\"getJSON('jsonlabel')\" class=\"wtl-middle-panel-right-bot\">";
echo "          <div class=\"wtl-middle-panel-right-bot-icon\"><i class=\"far fa-file-code fa-2x\"></i></div>";
echo "          <div id=\"jsonlabel\" class=\"wtl-middle-panel-right-bot-label\"><div id=\"jsondata\" style=\"display:none;\">" . $task->rawjson . "</div>get json</div>";
echo "        </div>";
echo "      </div>";
echo "    </div>";
echo "  </div>";
echo "  <div class=\"wtl-editor-box-right\">" . wtl_html::create_target_html($task->tasknodes->targets) . "</div>";
echo "</div>";
echo wtl_html::footer();
?>