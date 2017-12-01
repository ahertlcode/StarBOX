<?php
session_start();
require_once("../dbconfig.php");
require_once("../../classes/db2.php");
if(!isset($_SESSION['attempt'])){ $_SESSION['attempt'] = array(); }
if(!isset($_SESSION['qsn'])){ $_SESSION['qsn'] = array(); }
if(!isset($_SESSION['kount'])){ $_SESSION['kount'] = 0; }
if(!isset($_SESSION['rendered'])){ $_SESSION['rendered'] = false; }
//$_SESSION['qtoans'] = 2;
?>
<!DOCTYPE html >
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>StarBox - Dashboard</title>
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
				  <li class="active"><a href="#">Profile</a></li>
				  <li data-toggle="modal" data-target="#opform"><a href="#">Take Test</a></li>
				  <li><a href="../views/?q=result">My Results</a></li>
				  <li><a href="../models/logout.php">Log Out</a></li>
			   </ul>
    		       </div>
	</div>
	</div>
	</div>
	<div class="col-lg-9"></div>
	<div class="modal fade" id="opform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Take Test</h4>
          </div>
          <div class="modal-body">
            <?php include_once('option.php'); ?>
          </div>
    </div></div></div>
</div>
 <!--style="margin-top:50px;"-->
<div class="row">
<?php
$f3 = require("../../lib/base.php");
$f3->set('DEBUG', 3);
/***************************************************************
This section display result i.e. the performance for the currently LogicException
user from the database. It fetches and display the result for all the test the
user had taken. The fetched scores with other parameter are displayed using f3 template
Engine.
***************************************************************/
$perfm = array(); //This array is declare to extract the score from the dry state of f3 database table mapper
if(isset($_GET['q']) && $_GET['q']=="result" ){
	$f3->route('GET|POST /',function($f3){
	/*This variable are made to be global i.e. given a global scope for f3 to alter
	the values in them an make available to php*/
	global $dbname,$dbuser,$dbpass,$perfm;
	$db = new DB\SQL("mysql:host=localhost;port=3306;dbname={$dbname}","{$dbuser}","{$dbpass}");
	$rque = "select * from euser where username='{$_SESSION['user']['username']}'";
	$result = $db->exec($rque);
	$t=0;
	foreach($result as $res){
		$perfm[$t]['sn'] = $t;
		$perfm[$t]['ldate']=$res['date'];
		$perfm[$t]['subject'] = $res['subj'];
		$perfm[$t]['score'] = $res['score'];
		$perfm[$t]['grade'] = $res['grade'];
		$perfm[$t]['exam'] = $res['examtype'];
		$perfm[$t]['comment'] = $res['comment'];
		$t++;
	}
	$f3->set('owner',$_SESSION['user']);
	$f3->set('result',$perfm);
	echo \Template::instance()->render('result.php');
});
$f3->run();
}
if(isset($_GET['q']) && $_GET['q']!="result"){
	$crit = $_GET['q'];

//Condition when q is set to a particular question number
if($crit!="next" && $crit!="prev" && $crit!="u" && $crit!="t"){
	$t = $_GET['q'];
	shoQuest($t);
}
//Condition flow to get previous Question Sequentially and Serrially
if($crit == "prev"){
	if(!isset($_SESSION['prev'])){
		$_SESSION['prev'] = count($_SESSION['attempt']) - 2;
	}else if(isset($_SESSION['prev']) && $_SESSION['prev']>1){ $_SESSION['prev']-=1; }
	else if(isset($_SESSION['prev']) && $_SESSION['prev']<=1){
		$_SESSION['prev'] = 0;
	}
	if(isset($_SESSION['prev']) && $_SESSION['prev']<0){
		$_SESSION['prev'] = 0;
	}
		shoQuest($_SESSION['attempt'][$_SESSION['prev']]);
	}
	//Condition follow to fetch Next Question Sequentially and Serially.
	else if($crit == "next"){
		if(count($_SESSION['attempt'])<$_SESSION['qtoans']){
		shoQuest();
		/*This clause require more attention for the next button to work well*/
	}else{ shoQuest($_SESSION['attempt'][count($_SESSION['attempt'])-1]); }
		if(isset($_SESSION['prev'])){ unset($_SESSION['prev']); }
	}
	else if($crit == "u"){
		$reason = " User Terminated.";
		$_SESSION['why'] = $reason;
		doGrade();
	}else if($crit == "t"){
		$reason = " Time Exhausted, Systm terminated.";
		$_SESSION['why'] = $reason;
		doGrade();
	}
}else if(isset($_SESSION['subject']) && isset($_SESSION['exam']) && !isset($_GET['q'])){
	//Condition flow to fetch up Question from db
	getQuestions();
}else{}


//The route for grade calculation
function doGrade()
{
	$dbs = new db();
	$score = 0;
	if(isset($_SESSION['answered']) && count($_SESSION['answered'])>0){
	foreach($_SESSION['answered'] as $ansd){
		$sc = explode(",",$ansd);
		if($sc[0]===$sc[1])
		{
			$score++;
		}
	}
}
	$percent = ($score/$_SESSION['qtoans'])*100;
	$grade = getGrade($percent);
	$_SESSION['score'] = $percent;
	$squery="insert into euser values('0','{$_SESSION['user']['username']}',now(),'{$_SESSION['subject']}','{$percent}','{$grade}','{$_SESSION['why']}','{$_SESSION['exam']}')";
	$ts = $dbs->executeQuery($squery);
	retSess();
}

//Function to grade the score obtained
function getGrade($sc){
	$lgrade = "";
	if($sc>=75){
		$lgrade = "A";
	}else if($sc>=60){
		$lgrade = "B";
	}else if($sc>=50){
		$lgrade = "C";
	}else if($sc>=45){
		$lgrade = "D";
	}else if($sc>=40){
		$lgrade = "E";
	}else{
		$lgrade = "F";
	}
	return $lgrade;
}
//Function to r3eset all existing Session Variables
function retSess(){
	unset($_SESSION['attempt']);
	unset($_SESSION['q']);
	unset($_SESSION['kount']);
	unset($_SESSION['rendered']);
	unset($_SESSION['answered']);
	unset($_SESSION['qsn']);
	shoGrade();
}

//The route to display user performance.
function shoGrade(){
	global $f3;
	$f3->route('GET|POST /',function($f3){
		$percent = $_SESSION['score'];
		$why = $_SESSION['why'];
		$f3->set('reason',$why);
		if($percent<50){
			$f3->set('Statement',"Your performance is poor,\r\n You scored {$percent}%");
			}
			else if($percent>50 && $percent<70){
				$f3->set('Statement',"A very good trial,\r\n You scored {$percent}%");
			}else{
				$f3->set('Statement',"Excellent Performance! Keep it Up.\r\n You Scored {$percent}%");
			}
			echo \Template::instance()->render('showResult.php');
	});
	$f3->run();
}
function getQuestions(){
	global $f3;
	$question = array();
	$f3->route('GET|POST /',function($f3){
	global $dbname;
	global $dbuser;
	global $dbpass;
	global $question;
	$subj = $_SESSION['subject'];
	$exam = $_SESSION['exam'];
	$db = new DB\SQL("mysql:host=localhost;port=3306;dbname={$dbname}","{$dbuser}","{$dbpass}");
	$query = "select * from questionbank where subject='{$subj}' AND examtype='{$exam}'";
	$_SESSION['df'] = $query;
	$qu = $db->exec($query);
	$i = 0;
	foreach($qu as $quest){
		$question[$i]['sn'] = $i;
		$question[$i]['question'] = $quest['question'];
		$question[$i]['optionA'] = $quest['optionA'];
		$question[$i]['optionB'] = $quest['optionB'];
		$question[$i]['optionC'] = $quest['optionC'];
		$question[$i]['optionD'] = $quest['optionD'];
        $question[$i]['optionE'] = $quest['optionE'];
		$question[$i]['answer'] = $quest['answer'];
		$question[$i]['questImg'] = $quest['questImg'];
		$i++;
	}
	$_SESSION['q'] = $question;
	$_SESSION['ln'] = count($question);
	if($_SESSION['ln']!= 0){
	shoQuest();
	}else {
		echo "<br/><br/><br/><br/><br/>There is no Question found for the chosen Category, try another.";
	}
});
$f3->run();
}

function shoQuest($pt=NULL)
{
	global $f3;
	$_SESSION['d'] = $pt;
	$f3->route('GET|POST /',function($f3){
	$pot = $_SESSION['d'];
	if(is_null($pot))
	{
		$point = lookUpValue();
	}
	else{
		$point = $pot;
	}
	$f3->set('sn',$_SESSION['qsn']);
	$f3->set('atempt',$_SESSION['attempt']);
	$f3->set('Question',$_SESSION['q'][$point]);
	echo \Template::instance()->render('TPage.php');
});
$f3->run();
}

function lookUpValue()
{
	$point = getPointer();
	if(!in_array_r($point,$_SESSION['attempt']) && count($_SESSION['attempt'])<$_SESSION['qtoans'])
	 {
		 $_SESSION['kount'] = $_SESSION['kount'] + 1;
		 $ty = array("Q{$point}" =>$_SESSION[kount]);
		 $_SESSION['qsn'] = array_merge_recursive($_SESSION['qsn'],$ty);
		 array_push($_SESSION['attempt'], $point);
		 return $point;
	 }
	 else if(sizeof($_SESSION['attempt']) < $_SESSION['qtoans']){
		 lookUpValue();
	 }
	 else{ return -1; }
}

function getPointer()
{
	$tn = (int)$_SESSION['ln']-1;
	return rand(0,$tn);
}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}
?>
</div>
<div class="row">
	<div class="col-lg-12"></div>
</div>
<div class="row">
	<div class="col-lg-12"><br/><br/><br/>StarBox &copy; 2015 AHER TECHNOLOGIES LIMITED.</div>
</div>
<iframe id="dwin" name="dwin"></iframe>
</div>
</body>
</html>
