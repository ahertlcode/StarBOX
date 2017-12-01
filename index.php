<?php
require_once "classes/db2.php";
$dbQ = new db();
$fQuotes = $dbQ->getRowAssoc("select * from quotes");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to StarBox</title>
<link href='https://fonts.googleapis.com/css?family=Raleway:300|Open+Sans+Condensed:300|Ubuntu:300|Droid+Serif|Slabo:300' rel='stylesheet' type='text/css'>
<script src="js/jquery-1.11.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/starbox.js"></script>
<link rel="shortcut icon" href="images/logo.png"/>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link  rel="stylesheet" href="css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="css/index.css" />
<style type="text/css">
body{
  background: url("images/starbox-home.jpg"); background-repeat:no-repeat;
  background-position: top;
  background-size: cover;
}
div{
  z-index: -1;
}
</style>
</head>
<body onload="showSlide();">
  <!-- Top Links -->
  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div id="logo"><img src="images/logo.png" /></div>
  		<div class="container">

    			<div class="navbar-header">
      				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> </button>
				      <span class="glyphicon glyphicon-menu"></span>
    			</div>
	 		<div class="navbar-collapse collapse">
			   <ul class="nav navbar-nav navbar-right">
				  <li class="hmenu"><a href="app/views/userLogin.php?d=admin"><img src="images/Admin2.png" height="32" width="32" />&nbsp;Administrator</a></li>
          <li class="hmenu"><a href="app/views/userLogin.php?d=teacher"><img src="images/teacher2.png" height="32" width="32" />&nbsp;Teacher</a></li>
          <li class="hmenu"><a href="app/views/userLogin.php?d=student"><img src="images/student.png" height="32" width="32" />&nbsp;Student</a></li>
          <li class="hmenu"><a href="app/views/userLogin.php?d=student"><img src="images/examination.png" height="32" width="32" />&nbsp;Take Test</a></li>
			   </ul>
    	</div>
	</div>
	</div>
<!-- Top Links Ends -->
<div class="container">
<div class="row">
<div class="col-lg-12">&nbsp;</div>
</div>
<div class="row">
<div class="col-lg-8">
  <div class="row"><span class="htitle">Welcome</span></div>
  <div class="row">You are welcome to StarBox the online CBT simulation Engine that  allows you to prepare for any Computer  Based Test of your choice. We have Past Questions for JAMB(UTME), WASSEC(WAEC), NECO & NABTEB.</div>
  <div class="row" style="text-align:right;font-size:22px; font-weight:300; padding-right:10px;">...StarBox</div>
</div>
<div class="col-lg-4" id="dQuote">
  <div class="row" style="padding:0; height:10%; border-top-left-radius:15px; border-top-right-radius:15px;">
		<h2 style="background:#FFF; margin-top:0; border-top-left-radius:15px; border-top-right-radius:15px; padding-left:20px; color:Blue;">Quotes</h2>
	</div>
  <div class="row" style="height:80%;">
    <ul class="slider">
      <?php
        if(isset($fQuotes) && sizeof($fQuotes)>0){
          for($f=0;$f<sizeof($fQuotes);$f++){
            ?>  <li class="slab">
              <span class="Qbody"><?php echo $fQuotes[$f]['quote']; ?></span>
              <span class="Qfoot">...<?php echo $fQuotes[$f]['author']; ?></span>
            </li><?php
          }
        }
      ?>
    </ul>
  </div>
  <div class="row" style="background:#fff; height:10%; border-bottom-left-radius:15px; border-bottom-right-radius:15px;"></div>
</div>
</div>
<div class="row">
<div class="col-lg-3">&nbsp;</div>
<div class="col-lg-3">&nbsp;</div>
<div class="col-lg-3">&nbsp;</div>
<div class="col-lg-3">&nbsp;</div>
</div>
</div>
<div id="noconfirm" class="alert alert-info"></div>
<div id="msgbox" class="alert alert-info"></div>
<?php
if(isset($_GET['noconfirm'])){
	?>
  <script type="text/javascript">
  showNoConfirm("You must confirm your E-mail before you can be allowed to login. Simply check your mail box and open an E-mail sent to you from support@ahertl.com and click the link in that mail to confirm your e-mail. Thank you!");
  </script>
  <?php
	}
if(isset($_GET['cf']) && $_GET['cf']==1){
  $usern = $_GET['ui'];
  $uid = $_GET['n'];
  ?><script type="text/javascript">
      confirmtoken("<?php echo $usern; ?>","<?php echo $uid; ?>");
  </script><?php
}
if(isset($_GET['res']) && $_GET['res'] == 1){
  $ui = $_GET['u'];
  $tk = $_GET['tk'];
  ?><<script type="text/javascript">
    passresetrequest("<?php echo $ui; ?>","<?php echo $tk; ?>");
  </script><?php
}
?>
</body>
</html>
