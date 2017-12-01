<?php
session_start();
require_once("../dbconfig.php");
require_once("../../classes/db2.php");
?>
<!DOCTYPE html >
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>StarBox - Admin Panel</title>
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
	<div class="col-lg-12">
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  		<div class="container">
    			<div class="navbar-header">
      				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> </button>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
				      <span class="icon-bar"></span>
    			</div>
	 		<div class="navbar-collapse collapse dropdown">
			   <ul class="nav navbar-nav navbar-right">
				  <li><a href="../admin/?p=ap" aria-label="Left Align">
  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Admin Profile</a></li>
				  <li >
                  <button class="dropdown-toggle" data-toggle="dropdown" aria-label="Left Align">
  <span class="glyphicon glyphicon-upload" aria-hidden="true"></span>&nbsp;Upload Questions</button>
                      <ul class="dropdown-menu">
                          <li><a href="../admin/?action=mupload" aria-label="Left Align">
  <span class="glyphicon glyphicon-transfer" aria-hidden="true"></span>&nbsp;Mass Upload</a></li>
                          <li><a href="../admin/?action=supload" aria-label="Left Align">
  <span class="glyphicon glyphicon-import" aria-hidden="true"></span>&nbsp;Single Question</a></li>
                          </ul>
                      </li>
				  <li>
                  <button class="dropdown-toggle" data-toggle="dropdown"aria-label="Left Align">
  <span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>&nbsp;View Complaints</button>
                      <ul class="dropdown-menu">
                          <li><a href="#" aria-label="Left Align">
  <span class="glyphicon glyphicon-education" aria-hidden="true"></span>&nbsp;Students</a></li>
                          <li><a href="#"aria-label="Left Align">
  <span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span>&nbsp;Teachers</a></li>
                          <li><a href="#"aria-label="Left Align">
  <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>&nbsp;Guests</a></li>
                          </ul>
                      </li>
				  <li>
                  <button class="dropdown-toggle" data-toggle="dropdown"aria-label="Left Align">
  <span class="glyphicon glyphicon-record" aria-hidden="true"></span>&nbsp;Activity</button>
                  <ul class="dropdown-menu">
                      <li><a href="#">Time Report</a></li>
                      <li><a href="#">Activity Report</a></li>
                      </ul>
                      </li>
                  <li><a href="../models/logout.php"aria-label="Left Align">
  <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Log Out</a></li>
			   </ul>
    	</div>
	</div>
	</div>
	</div>
	<!--<div class="col-lg-9"></div>-->
</div>
 <!--style="margin-top:50px;"-->
<div id="msgbox" name="msgbox"></div>
<div class="row">
	<div class="col-lg-12">
        <?php
        $f3 = require('../../lib/base.php');
        $f3->set('DEBUG',3);
            if(isset($_GET['p']) && $_GET['p']==='ap'){
                $f3->route('GET|POST /', function($f3){
                    $f3->set('user',$_SESSION['user']);
					$since = date_diff(date_create(date("Y-m-d H:s:i")),date_create($_SESSION['user']['dateReg']));
					$f3->set('since',$since->format("%D")." Days ago");
                    echo \Template::instance()->render('user.php');
                    });
                $f3->run();
                }
            if(isset($_GET['action']) && $_GET['action']==='mupload'){
                $f3->route('GET|POST /',function(){
                    echo \Template::instance()->render('../views/massUpload.php');
                    });
                $f3->run();
                }
            if(isset($_GET['action']) && $_GET['action']==='supload'){
                $f3->route('GET|POST /',function(){
                    echo \Template::instance()->render('../views/QPage.php');
                    });
                $f3->run();
                }
            ?>
        </div>
</div>
<div class="row">
	<div class="col-lg-12"><br/><br/><br/>StarBox &copy; 2015 AHER TECHNOLOGIES LIMITED.</div>
</div>
</div>
</body>
</html>
