<?php
require_once("include/core.php");
$spacer = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo wtl_html::header("archive");
echo "<h3>Here you can see all suggested tasks</h3><hr>";
echo "<div id=\"wtl-editor\" class=\"wtl-editor-box\">";
echo "  <div class=\"wtl-editor-box-left-archive\">Sort by<br><br>".$spacer."<a href=\"archive.php?s=l\">latest added</a><br><br>".$spacer."<a href=\"archive.php?s=b\">the best</a><br><br>".$spacer."<a href=\"archive.php?s=w\">the worst</a>";
echo "  </div>";
echo "  <div class=\"wtl-editor-box-middle-archive\"><div>";
//echo "  <pre>";
$db = new db();
//var_dump($db->getArchivePageContent());
//echo "</pre>";
foreach($db->getArchivePageContent() as $task){
	echo "<hr><a href=\"problem.php?id=" . $task->tid . "\">" . $task->description . "</a>";
}

echo "</div></div>";
echo "  <div class=\"wtl-editor-box-right-archive\"><img src=\"img/seriousinfo.png\" border=\"0\" />";
echo "  </div>";
echo "</div>";
echo "";
echo wtl_html::footer();
?>