<?php
ob_start();
session_start();
$f3 = require("../../lib/base.php");
require_once("../../classes/mailer.php");
require_once("../dbconfig.php");
?>
<!DOCTYPE html />
<html lang="en">
<head>
<title></title>
<link href='https://fonts.googleapis.com/css?family=Raleway:300|Open+Sans+Condensed:300|Ubuntu:300|Droid+Serif|Slabo:300' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="../../images/logo.png"/>
<link rel="stylesheet" href="../../css/bootstrap.min.css" />
<link  rel="stylesheet" href="../../css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="../../css/index.css" />
<script type="text/javascript">
 var oa = document.createElement('script');
 oa.type = 'text/javascript'; oa.async = true;
 oa.src = '//starbox.api.oneall.com/socialize/library.js'
 var s = document.getElementsByTagName('script')[0];
 s.parentNode.insertBefore(oa, s)
</script>
</head>
<body onLoad="getDateNow();">
<div class="row">
<div class="col-lg-4"></div>
<div class="col-lg-4"><div id="msgbox" name="msgbox"></div></div>
<div class="col-lg-4"></div>
</div>
<div class="row">
<div class="col-lg-3"></div>
<div class="col-lg-5">
	<form method="post">
	<table class="table">
	<tr><td colspan="2">Sign Up with<br/>
		<!-- The plugin will be embedded into this div //-->
		<div id="oa_social_login"></div>

		<script type="text/javascript">
		 var _oneall = _oneall || [];
		 _oneall.push(['social_login', 'set_callback_uri', 'http://starbox.ahertl.com/app/controllers/getsociallogin.php?signup']);
		 _oneall.push(['social_login', 'set_providers', ['facebook', 'google', 'linkedin', 'twitter', 'windowslive', 'yahoo', 'youtube']]);
		 _oneall.push(['social_login', 'do_render_ui', 'oa_social_login']);
		</script>
	</td></tr>
	<tr><td colspan="2" vertical-align="middle" align="center">--------------OR------------------<br/>Fill out the form below to register.</td></tr>
	<tr><input type="hidden" name="datereg" id="datereg"  />
	<td>Username*</td>
	<td><input type="text" name="username" id="username" class="form-control" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>" onBlur="validate('username',this.value);" required/>
    <span id="usernamediv" class="solabel">This username had been taken, please choose another one.</span>
		<input type="hidden" id="txtDes" name="txtDes" value="<?php if(isset($_GET['d'])){ echo $_GET['d']; } ?>" />
	</td>
	</tr>
	<tr>
	<td>Password*</td>
	<td><input type="password" name="passwd2" id="passwd2" onBlur="passhash(this.id);" class="form-control" required/></td>
	</tr>
	<tr>
	<td>Name*</td>
	<td><input type="text" name="name" id="name" class="form-control" value="<?php if(isset($_POST['name'])){ echo $_POST['name']; } ?>" required/></td>
	</tr>
	<tr>
	<td>Email*</td>
	<td><input type="email" name="email" id="email" class="form-control" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" onBlur="validate('email',this.value);" required/>
  <span id="emaildiv" class="solabel">This email is in use. Please use the password reset page to request for a password reset if you have forgotten your password or contact product manager.</span></td>
	</tr>
	<tr>
	<td>Phone Number*</td>
	<td><input type="number" name="phone" id="phone" class="form-control" value="<?php if(isset($_POST['phone'])){ echo $_POST['phone']; } ?>" onBlur="validate('phone',this.value);" required/>
  <span id="phonediv" class="solabel">This phone number is in use. Use the password reset page to reset your password if you have forgotten it.</span></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td align="right"><button id="btnRegUser" name="btnRegUser" class="btn btn-danger btn-lg" >Submit</button></td>
	</tr>
    <tr><td colspan="2"><input type="hidden" id="designation" name="designation" value="<?php echo $_GET['d']; ?>" /><input type="hidden" id="city" name="city" value="<?php echo $city; ?>" />
			<input type="hidden" id="state" name="state" value="<?php echo ""; ?>" />
			<input type="hidden" id="country" name="countrty" value="<?php echo $country; ?>" />
			<input type="hidden" id="passwd" name="passwd" />
      <input type="hidden" id="UniQueUser" name="UniQueUser" />
      <input type="hidden" id="UniQuePhon" name="UniQuePhon" />
      <input type="hidden" id="UniQueEmai" name="UniQueEmai" />
<input type="hidden" id="ipt" name="ipt" value="<?php if(isset($ip)){ echo $ip; } ?>" />
</td></tr>
<tr><td>Click to <a href="userLogin.php?d=<?php if(isset($_GET['d'])){ echo $_GET['d']; } ?>">here login</a></td>
<td>forgot your Password? <a href="request.php?d=<?php if(isset($_GET['d'])){ echo $_GET['d']; } ?>">Click here to reset it.</a></td>
</tr>
	</table>
</form>
</div>
<div class="col-lg-4">&nbsp;</div>
</div>
<div class="row" id="footer">
</div>
<script src="../../js/jquery-1.11.3.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="//js.maxmind.com/js/apis/geoip2/v2.1/geoip2.js" type="text/javascript"></script>
<script src="../../js/starbox.js"></script>
<script type="text/javascript">

var onSuccess = function(location){
 $("#country").val(location.country.names.en);
 $("#city").val(location.city.names.en);
 $("#state").val(location.states.names.en);
};

var onError = function(error){
  $("#country").val(" ");
 $("#city").val(" ");
 $("#state").val(" ");
};
geoip2.insights(onSuccess, onError);
 </script>
<?php
$ip = getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR');
$mailo = new mailer();
$_SESSION['saved'] = false;
if(isset($_POST['btnRegUser'])){
  if(strtoupper($_POST['txtDes'])==="ADMIN"){
    ?><script type="text/javascript">
      showInfo("warn","Sorry, you can not register as an Admin.");
      setTimeout("window.location.href='../../'",5000);
    </script><?PHP
  }else {
  $uniuser = $_POST['UniQueUser'];
  $uniphon = $_POST['UniQuePhon'];
  $uniemai = $_POST['UniQueEmai'];
  if($uniuser=="no" || $uniphon=="no" || $uniemai=="no"){
    ?><script>showInfo("danger","Please correct the errors and try again.");</script><?php
    exit;
  }
  $maili = $_POST['email'];
  $name = $_POST['name'];
  $pass = $_POST['passwd'];
  $userv = $_POST['username'];
	$f3->route('POST|GET /register.php',function($f3){
	global $dbname, $dbuser, $dbpass;
	$db = new DB\SQL("mysql:host=localhost;port=3306;dbname={$dbname}","{$dbuser}","{$dbpass}");
	$user = new DB\SQL\Mapper($db,'user');
	$user->copyFrom('POST');
	$user->save();
	$_SESSION['saved'] = true;
});
$f3->run();
}
}
if($_SESSION['saved']){
	createMail();
	$lm = $mailo->_msend();
	?><script>
	showInfo("Success","<?php echo $lm['Status'].": ".$lm['Info'] ?>\r\nA Confirmation E-mail has been sent to you.\r\nCheck your InBox and follow the Instruction to activate/confirm your email. Thank you");
	setTimeout("window.location.href='userLogin.php?='+$('#txtDes').val()",5000);
	</script><?php
}

function createMail(){
	global $mailo;
	global $maili;
	$mailo->setReceiver($maili);
	$mailo->setSubject("Account Confirmation");
	$mailo->setParameters("false");
	createHeader();
	createMsg();
	}
function createHeader(){
	global $mailo;
	$heading = array();
	$heading[] = "MIME-Version: 1.0";
	$heading[] = "Content-type: text/html; charset=utf-8";
	$heading[] = "Reply-To: Enquiry<enquiries@ahertl.com>";
	$heading[] = "From: Technical Support<support@ahertl.com>";
	$mailo->setHeaders(implode("\r\n",$heading));
	}
function createMsg(){
	global $mailo;
	global $name;
	global $pass;
	global $userv;
	//$m = "";••••
	$m .= "<table>";
	$m .= "<tr><td colspan='2' align='right'><img src='http://starbox.ahertl.com/images/giftbox.jpg' height='64px' width='64px' /></td></tr>";
	$m .= "<tr><td colspan='2'>";
	$m .= "Dear {$name},<br/><br/>You have successfully register a user account with us at StarBox.<br/> Click on the link below to confirm your E-mail address. If click on it did not work, copy and paste into your browser.<br/><br/>";
	$m .= "http://starbox.ahertl.com/?cf=1&ui={$pass}&n={$userv}";
	$m .= "<br/><br/>In the case of any challenge feel free to contact the product manager or the technical support department.<br/>Their contact information are given below, if you have any issue with them report to admin@ahertl.com<br/>NOTE: E-mail sent to Admin will only be considered if it is a complaint about any of our staff. Please use the appropriate communication channel to get prompt response.<br/><br/><br/>Best Regards!<br/>";
	$m .= "</td><tr>";
	$m .="<tr><td align='left'>Abayomi Apetu<br/>Product Manager<br/>E-mail:abayomi.apetu@ahertl.com<br/>Tel: +234 806 358 2789<br/>Website: http://www.ahertl.com</td><td align='right'>Technical Support<br/>StarBox, AHERTL<br/>support@ahertl.com<br/>Tel: +234 1 778 9009.</td></tr>";
	$m .= "<tr><td colspan='2'>like us:&nbsp;follow us:&nbsp;linkedIn:</td></tr>";
	$m.="</table>";
	$mailo->setMessage($m);
	}
ob_end_flush();
?>
</body>
</html>
