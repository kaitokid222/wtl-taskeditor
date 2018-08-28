<?php
// data format
/* task as obj
{
"tid":123,
"description":"Just relay all data",
"tasknodes":{
	"sources":[{"rc":100,"rs":100,"rt":100,"gc":100,"gs":100,"gt":100,"bc":100,"bs":100,"bt":100}],
	"targets":[{"rc":1,"rs":1,"rt":1,"gc":1,"gs":1,"gt":1,"bc":1,"bs":1,"bt":1,"precision":100,"matches":50}]
	}
}
*/
class db
{
	//superior ;D
	private $taskfile = "./db/tasks.txt";
	private $taskfile_arr = array();
	function __construct(){
		$t = file_get_contents($this->taskfile, true);
		$this->taskfile_arr = explode(";",$t);
		foreach($this->taskfile_arr as $k => $task){
			$d = json_decode($task);
			$this->taskfile_arr[$k] = $d;
		}
	}
	public function getTask($id = 0){
		if($id === 0)
			return false;
		foreach($this->taskfile_arr as $task){
		  if($task->tid === $id)
			return $task;
		}
	}
	public function getArchivePageContent($mode = 0, $page = 1){
		$arr = array();
		$arr = Arrch\Arrch::sort($this->taskfile_arr, "tid", "DESC");
		return $arr;
	}
}

class wtl_html
{
	public static function footer(){
	  $o = "          <div class=\"mastfoot\">";
	  $o .= "            <div class=\"inner\">";
	  $o .= "              <p>utility for <a href=\"https://luden.io/wtl/\">while true: learn()</a> created by <a href=\"https://luden.io\">luden.io</a>.</p>";
	  $o .= "            </div>";
	  $o .= "          </div>";
	  $o .= "        </div>";
	  $o .= "      </div>";
	  $o .= "    </div>";
	  $o .= "  <script src=\"https://code.jquery.com/jquery-3.3.1.min.js\"></script>";
	  $o .= "  <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js\"></script>";
	  $o .= "  <script src=\"js/script.js\"></script>";
	  $o .= "  </body>";
	  $o .= "</html>";
	  return $o;
	}
	
	public static function header($t = "under construction"){
	  $a = array();
	  $a[] = ($t == "hello") ? " class=\"active\"" : "";
	  $a[] = ($t == "archive") ? " class=\"active\"" : "";
	  $a[] = ($t == "add task") ? " class=\"active\"" : "";
	  // not menu
	  $a[] = ($t == "show task #") ? " class=\"active\"" : "";
	  if($t == "show task #" && (!isset($_GET["id"]) || !is_numeric($_GET["id"])))
		die("sth went wrong method");
	  $o = "<!DOCTYPE html>";
	  $o .= "<html lang=\"de\">";
	  $o .= "  <head>";
	  $o .= "    <meta charset=\"utf-8\">";
	  $o .= "    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
	  $o .= "    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";
	  $o .= "    <meta name=\"description\" content=\"Editor for WTL\">";
	  $o .= "    <meta name=\"author\" content=\"iNk\">";
	  $o .= "    <title>wtl editor :: " . $t . $_GET["id"] . "</title>";
	  $o .= "    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css\">";
	  $o .= "    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.2.0/css/regular.css\" integrity=\"sha384-zkhEzh7td0PG30vxQk1D9liRKeizzot4eqkJ8gB3/I+mZ1rjgQk+BSt2F6rT2c+I\" crossorigin=\"anonymous\">";
	  $o .= "    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css\" integrity=\"sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6\" crossorigin=\"anonymous\">";
	  $o .= "    <link href=\"css/style.css\" rel=\"stylesheet\">";
	  $o .= "    <script src=\"js/wtl.js\"></script>";
	  $o .= "  </head>";
	  $o .= "  <body>";
	  $o .= "    <div class=\"site-wrapper\">";
	  $o .= "      <div class=\"site-wrapper-inner\">";
	  $o .= "        <div class=\"cover-container\">";
	  $o .= "          <div class=\"masthead clearfix\">";
	  $o .= "            <div class=\"inner\">";
	  $o .= "              <h3 class=\"masthead-brand\">user-tasks 4 wtl</h3>";
	  $o .= "              <nav>";
	  $o .= "                <ul class=\"nav masthead-nav\">";
	  $o .= "                  <li" . $a[0] . "><a href=\"index.php\">hello</a></li>";
	  $o .= "                  <li" . $a[1] . "><a href=\"archive.php\">browse tasks</a></li>";
	  $o .= "                  <li" . $a[2] . "><a href=\"createproblem.php\">create a task</a></li>";
	  $o .= "                </ul>";
	  $o .= "              </nav>";
	  $o .= "            </div>";
	  $o .= "          </div>";
	  return $o;
	}
	
	public static function create_source_html($sources_arr){
	  $sourcehtml = "";
	  foreach($sources_arr as $k => $v){
        $sourcehtml .= "<div id=\"wtl-source-" . $k . "\" class=\"wtl-source-grid\">";
        for($i = 0; $i <= 2; $i++){
          for($j = 0; $j <= 2; $j++){
            $sourcehtml .= "  <div onmousedown=\"click_source_item(event, 's-" . $k . "-" . $i . $j . "')\"><canvas id=\"s-" . $k . "-" . $i . $j . "\" width=\"32\" height=\"32\"></canvas></div>";
            //$sourcehtml .= "  <div><canvas id=\"s-" . $k . "-" . $i . $j . "\" width=\"32\" height=\"32\"></canvas></div>";
          }
        }
        $sourcehtml .= "</div>";
	  }
	  $sourcehtml .= self::draw_shapes($sources_arr, 1);
      return $sourcehtml;
    }
	
	public static function create_target_html($targets_arr){
	  $targethtml = "";
	  foreach($targets_arr as $k => $v){
        $targethtml .= "<div id=\"wtl-target-" . $k . "\" class=\"wtl-target-grid-outer\">";
        $targethtml .= "  <div class=\"wtl-target-grid-left\">";
        $targethtml .= "    <div class=\"wtl-target-grid\">";
        for($i = 0; $i <= 2; $i++){
          for($j = 0; $j <= 2; $j++){
            $targethtml .= "      <div><canvas id=\"t-" . $k . "-" . $i . $j . "\" width=\"32\" height=\"32\"></canvas></div>";
          }
        }
        $targethtml .= "    </div>";
        $targethtml .= "  </div>";
        $targethtml .= "  <div class=\"wtl-target-grid-right\">";
        $targethtml .= "    <div class=\"prec\">";
        $targethtml .= "      <div class=\"prec-bar\"><canvas id=\"t-" . $k . "-prec-bar\" width=\"32\" height=\"100\"></canvas></div>";
        $targethtml .= "      <div class=\"prec-icon\"><canvas id=\"t-" . $k . "-prec-icon\" width=\"32\" height=\"32\"></canvas></div>";
        $targethtml .= "    </div>";
        $targethtml .= "    <div class=\"stacks\">";
        $targethtml .= "      <div class=\"stacks-bar\"><canvas id=\"t-" . $k . "-stacks-bar\" width=\"32\" height=\"100\"></canvas></div>";
        $targethtml .= "      <div class=\"stacks-icon\"><canvas id=\"t-" . $k . "-stacks-icon\" width=\"32\" height=\"32\"></canvas></div>";
        $targethtml .= "    </div>";
        $targethtml .= "  </div>";
        $targethtml .= "</div>";
	  }
	  $targethtml .= self::draw_shapes($targets_arr, 2);
      return $targethtml;
    }	
	
	public static function draw_shapes($wtl_node_arr, $mode = 1){
	  $r = "<script>";
	  $xc = count($wtl_node_arr);
	  for($x = 0; $x <= $xc-1; $x++){
		for($i = 0; $i <= 2; $i++){
		  $shape = ($i == 0) ? "circle" : (($i == 1) ? "square" : "triangle");
		  for($j = 0; $j <= 2; $j++){
			$color = ($j == 0) ? "red" : (($j == 1) ? "green" : "blue");
			$coord = $i . $j;
			if($mode == 1)
			  $r .= "sourcegrid.push(new wtlshapes(\"s-" . $x . "-" . $i . $j . "\", \"" . $shape . "\", \"" . $color . "\",\"" . $wtl_node_arr[$x]->{$coord} . "\"));";
			else
			  $r .= "targetgrid.push(new wtlshapes(\"t-" . $x . "-" . $i . $j . "\", \"" . $shape . "\", \"" . $color . "\",\"" . $wtl_node_arr[$x]->{$coord} . "\"));";
		  }
		}
		if($mode == 2){
		  $r .= "targetgrid.push(new wtlshapes(\"t-" . $x . "-prec-bar\", \"bar\", \"\",\"" . $wtl_node_arr[$x]->precision . "\"));";
		  $r .= "targetgrid.push(new wtlshapes(\"t-" . $x . "-prec-icon\", \"crosshair\", \"\",\"\"));";
		  $r .= "targetgrid.push(new wtlshapes(\"t-" . $x . "-stacks-bar\", \"bar\", \"\",\"" . $wtl_node_arr[$x]->matches . "\"));";
		  $r .= "targetgrid.push(new wtlshapes(\"t-" . $x . "-stacks-icon\", \"stack\", \"\",\"\"));";
		}
	  }
	  if($mode == 1)
	    $r .= "sourcegrid.forEach(function(i){i.draw();});";
	  else
	    $r .= "targetgrid.forEach(function(i){i.draw();});";
	  $r .= "</script>";
	  return $r;
	}
}
?>