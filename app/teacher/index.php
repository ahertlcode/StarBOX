<?php
ob_start();
session_start();
require_once("../dbconfig.php");
require_once("../../classes/db2.php");
$f3 = require("../../lib/base.php");
$f3->set('DEBUG', 3);
?>
<!DOCTYPE html >
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>StarBox - Teachers' Panel</title>
<script src="../../js/jquery-1.11.3.js" language="javascript" type="text/javascript"></script>
<script src="../../js/jquery-ui.min.js" language="javascript" type="text/javascript"></script>
<script src="../../js/bootstrap.min.js" language="javascript" type="text/javascript"></script>
<script src="../../js/starbox.js" language="javascript" type="text/javascript"></script>
<link rel="shortcut icon" href="../../images/logo.png"/>
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../../css/jquery-ui.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="../../css/bootstrap-theme.min.css" type="text/css" />
<link rel="stylesheet" href="../../css/index.css" type="text/css" />
</head>
<body>
<div class="container-fluid">
<div class="row">
	<div class="col-lg-3">
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  		<div class="container">
    			<div class="navbar-header">
      				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> </button>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
    			</div>
	 		<div class="navbar-collapse collapse">
			   <ul class="nav navbar-nav navbar-right">
				  <li class="active"><a href="#">Add Question</a>
            <ul>
                <li><a href="../teacher/?m=s">Single Question</a></li>
                <li><a href="../teacher/?m=m">Multiple Question</a></li>
            </ul>
          </li>
				  <li data-toggle="modal" data-target="#opform"><a href="#">Questions</a></li>
				  <li><a href="#">Menu2</a></li>
				  <li><a href="../models/logout.php">Log Out</a></li>
			   </ul>
    	</div>
	</div>
	</div>
	</div>
	<div class="col-lg-9"></div>
</div>
<div class="modal fade" id="opform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
<div class="modal-dialog">
  <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Select Subject</h4>
        </div>
        <div class="modal-body">
          <?php include_once('../views/QOption.php'); ?>
        </div>
  </div></div></div>
 <!--style="margin-top:50px;"-->
<div class="row">
	<div class="col-lg-12">
    <?php
    if(isset($_GET['m'])){
      $mode = trim($_GET['m']);
      if($mode == 's'){
        global $f3;
      	$f3->route('GET|POST /',function($f3){
      		echo \Template::instance()->render('../views/QPage.php');
      	});
      	$f3->run();
      }
      if($mode == 'm'){
        global $f3;
      	$f3->route('GET|POST /',function($f3){
      		echo \Template::instance()->render('../views/massUpload.php');
      	});
      	$f3->run();
      }
    }
if(isset($_POST['btnQlist'])){
	$qlist = array();
	$sub = trim($_POST['sltSubj']);
	$exa = trim($_POST['sltExam']);
	global $f3;
	$f3->route('GET|POST /',function($f3){
		global $dbname, $dbuser, $dbpass, $sub, $exa;
		$db = new DB\SQL("mysql:host=localhost;port=3306;dbname={$dbname}","{$dbuser}","{$dbpass}");
		$ques = new DB\SQL\Mapper($db,'questionbank');
		$ques->load(array('subject=? AND examtype=?',$sub,$exa));
		$j=1;
		foreach($ques as $q){
			$qlist[$j]['sn'] = $j;
			$qlist[$j]['question'] = $ques['question'];
			$qlist[$j]['optionA'] = $ques['optionA'];
			$qlist[$j]['optionB'] = $ques['optionB'];
			$qlist[$j]['optionC'] = $ques['optionC'];
			$qlist[$j]['optionD'] = $ques['optionD'];
			$qlist[$j]['answer'] = $ques['answer'];
			$j++;
		}
		$f3->set('Qlist',$qlist);
		echo \Template::instance()->render('../views/qlist.php');
	});
	$f3->run();
}
ob_end_flush();
 ?>
</div>
</div>
<div class="row">
<div class="col-lg-12"><br/><br/><br/>StarBox &copy; 2015 AHER TECHNOLOGIES LIMITED.</div>
</div>
</div>
</body>
</html>
