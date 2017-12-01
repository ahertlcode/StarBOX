<?php
session_start();
require_once("../../classes/mailer.php");
require_once("../../classes/db2.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Password Reset Request</title>
<link href='https://fonts.googleapis.com/css?family=Raleway:300|Open+Sans+Condensed:300|Ubuntu:300|Droid+Serif|Slabo:300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="../../css/bootstrap-theme.min.css" type="text/css" />
<link rel="stylesheet" href="../../css/index.css" type="text/css" />
<link rel="shortcut icon" href="../../images/logo.png"/>
<script src="../../js/jquery-1.11.3.js" language="javascript" type="text/javascript"></script>
<script src="../../js/bootstrap.min.js" language="javascript" type="text/javascript"></script>
<script src="../../js/starbox.js" language="javascript" type="text/javascript"></script>
<script src="../../js/jquery-ui.min.js" language="javascript" type="text/javascript"></script>
</head>
<body>
<div class="row">
<div class="col-lg-4"></div>
<div class="col-lg-4"><div id="msgbox" name="msgbox"></div></div>
<div class="col-lg-4"></div>
</div>
<div class="row">
	<div class="col-lg-4"></div>
    <div class="col-lg-4">
		<?php if(!isset($_GET['cf']) || $_GET['cf'] == "expired"){
			if(isset($_GET['cf']) && $_GET['cf'] == "expired"){ ?>
				<script>
				showInfo("The password reset request has expired, please make another request if you still want to change your password.<br/>NOTE: Your password has not changed yet.");
				</script><?php }
			?>
			<form method="post">
        	<table class="table">
            	<tr><td>Please Enter your E-mail Address
								<input type="hidden" id="txtDes" name="txtDes" value="<?php if(isset($_GET['d'])){ echo $_GET['d']; } ?>" />
							</td></tr>
                <tr><td><input class="form-control form-group-lg" id="rmail" name="rmail" type="email" required="required" /></td></tr>
                <tr><td align="right"><button id="btnRequest" name="btnRequest">Send Request</button></td></tr>
								<tr>
									<td>Click <a href="userLogin.php?d=<?php if(isset($_GET['d'])){ echo $_GET['d']; } ?>">here to login</a>&nbsp;&nbsp;&nbsp;&nbsp;Click <a href="register.php?d=<?php if(isset($_GET['d'])){ echo $_GET['d']; } ?>">here to register.</a>
							</td>
								</tr>
            </table>
        </form>
				<?php }else if(isset($_GET['cf']) && $_GET['cf'] == true){
					?>
					<form method="post">
						<table class="table">
							<tr><td>Please Provide A New Password Below</td></tr>
							<tr><td>&nbsp;<input type="hidden" id="passwd" name="passwd" /></td></tr>
							<tr><td>Enter New Password<br/><input type="password" id="passwd1" name="passwd1" required /></td></tr>
							<tr><td><br/>Confirm New Password<br/><input type="password" id="passwd2" name="passwd2" onblur="passhash(this.id);compVal('passwd1','passwd2')" data-toggle="tooltip" data-placement="right" data-animation="fade" data-delay="200" data-trigger="focus" required /></td></tr>
							<tr><td align="right"><button type="submit" id="btnChngPass" name="btnChngPass" class="btn btn-warning btn-lg">Change Password</button></td></tr>
							<tr>
								<td>Click <a href="userLogin.php?d=<?php if(isset($_GET['d'])){ echo $_GET['d']; } ?>">here to login</a>&nbsp;&nbsp;&nbsp;&nbsp;Click <a href="register.php?d=<?php if(isset($_GET['d'])){ echo $_GET['d']; } ?>">here to register.</a>
						</td>
							</tr>
						</table>
					</form>
					<?php
				}else{} ?>
	  </div>
    <div class="col-lg-4"></div>
</div>
<div class="row" id="footer"></div>
<?php
if(isset($_POST['btnChngPass'])){
	$dbn = new db();
	$newpass = $_POST['passwd'];
	//var_export($_SESSION['reset']);
	if(isset($_SESSION['reset']) && sizeof($_SESSION['reset'])>0){
	$jmail = $_SESSION['reset'][0]['email'];
	$jphone = $_SESSION['reset'][0]['phone'];
	$up = $dbn->executeQuery("update user set passwd='{$newpass}' where email='{$jmail}' AND phone='{$jphone}'");
	if($up == 1){
		?><script>
		showInfo("Success","Password Successfully changed, you can proceed to login.");
		updaterequest("<?php echo $_SESSION['reset'][0]['email'] ?>");
		setTimeout('window.location.href="../../index.php"',5000);
		</script><?php
	}else{
		?><script>
		showInfo("warn","There is an error, password could not be changed try again. If this error persist contact support@ahertl.com or the product manager. Thank you!");
		setTimeout('window.location.href="../../app/views/request.php"',5000);
		</script><?php
	}
}else{
	?><script>
	showInfo("warn","There is an error, password could not be changed try again. If this error persist contact support@ahertl.com or the product manager. Thank you!");
	setTimeout('window.location.href="../../app/views/request.php"',5000);
	</script><?php
}
}
if(isset($_POST['btnRequest'])){
	$db = new db();
	$resq = $_POST['rmail'];
	$query = "select * from user where email='{$resq}'";
	$rdat = $db->getRowAssoc($query);
	if(sizeof($rdat)>0){
		$mailr = new mailer();
		$tk = $rdat[0]['passwd'];
		$qu = "insert into request values('0','{$rdat[0]['username']}','{$resq}','{$tk}',now(),'0')";
		if($db->executeQuery($qu) == 1){
		createMail($rdat);
		$ml = $mailr->_msend();
		?><script>showInfo("Success","<?php echo $ml['Status'].": ".$ml['Info']; ?>\r\nCheck your InBox for Further Instruction. Thank you.");
		setTimeout("window.location.href='../../'",5000);
		</script><?php
		}
		}else{
			?><script>
			showInfo("Info","No User Account for this E-mail.\r\nIf you are sure you have an Account with this E-mail with us contact the product manager or better still create another account. Thank you.");
			setTimeout("window.location.href='register.php?d='+$('#txtDes').val()",5000);
			</script><?php
		}
	}
function createMail($user){
	global $mailr;
	$mailr->setReceiver($user[0]['email']);
	$mailr->setSubject("Password Reset Request.");
	$mailr->setParameters("false");
	createHeader();
	createMsg($user);
	}
function createHeader(){
	global $mailr;
	$heading = array();
	$heading[] = "MIME-Version: 1.0";
	$heading[] = "Content-type: text/html; charset=utf-8";
	$heading[] = "Reply-To: StarBox Enquiry<enquiries@ahertl.com>";
	$heading[] = "From: StarBox Technical Support<support@ahertl.com>";
	$mailr->setHeaders(implode("\r\n",$heading));
	}
function createMsg($u){
	global $mailr;
	global $tk;
	$m = "";
	$m .= "<table width='100%'>";
	$m .= "<tr><td colspan='2' align='right'><img src='http://starbox.ahertl.com/images/giftbox.jpg' height='64px' width='64px' /></td></tr>";
	$m .= "<tr><td colspan='2'>";
	$m .= "We received your request to reset your password<br/> Click on this link to reset your password.<br/>";
	$m .= "http://starbox.ahertl.com/?res=1&u={$u[0]['username']}&tk={$tk}";
	$m .= "<br/> but if you did not request for a password reset, ignore the mail.<br/><br/><br/><br/>Best Regards<br/><br/>";
	$m .= "</td><tr>";
	$m .="<tr><td align='left'><br/><br/>Abayomi Apetu<br/>Product Manager<br/>E-mail:abayomi.apetu@ahertl.com<br/>Tel: +234 806 358 2789<br/>Website: http://www.ahertl.com</td><td align='right'>Technical Support<br/>StarBox, AHERTL<br/>support@ahertl.com<br/>Tel: +234 1 778 9009.</td></tr>";
	$m .= "<tr><td colspan='2'>like us:&nbsp;follow us:&nbsp;linkedIn:</td></tr>";
	$m.="</table>";
	$mailr->setMessage($m);
	}
 ?>
</body>
</html>
