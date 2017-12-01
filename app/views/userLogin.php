<?php
ob_start();
session_start();
require_once "../dbconfig.php";
?>
<!DOCTYPE html >
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>StarBox</title>
<link href='https://fonts.googleapis.com/css?family=Raleway:300|Open+Sans+Condensed:300|Ubuntu:300|Droid+Serif|Slabo:300' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="../../images/logo.png"/>
<link rel="stylesheet" href="../../css/bootstrap.min.css" />
<link  rel="stylesheet" href="../../css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="../../css/index.css" />
<script src="../../js/jquery-1.11.3.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<script src="../../js/starbox.js"></script>
<script type="text/javascript">
 var oa = document.createElement('script');
 oa.type = 'text/javascript'; oa.async = true;
 oa.src = '//starbox.api.oneall.com/socialize/library.js'
 var s = document.getElementsByTagName('script')[0];
 s.parentNode.insertBefore(oa, s)
</script>
</head>
<body>
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
		<tr><td colspan="2" align="center">

			<!-- The plugin will be embedded into this div //-->
			<div id="oa_social_login"></div>

			<script type="text/javascript">
			 var _oneall = _oneall || [];
			 _oneall.push(['social_login', 'set_callback_uri', 'http://starbox.ahertl.com/app/controllers/getsociallogin.php?login']);
			 _oneall.push(['social_login', 'set_providers', ['facebook', 'google', 'linkedin', 'twitter', 'windowslive', 'yahoo', 'youtube']]);
			 _oneall.push(['social_login', 'do_render_ui', 'oa_social_login']);
			</script>
		</td></tr>
		<tr><td colspan="2" align="center">--------------------OR---------------------</td></tr>
	<tr>
	<td colspan="2">Username<br/><input type="text" name="username" id="username" class="form-control" required/></td>
	</tr><tr>
	<td colspan="2">Password<br/><input type="password" name="passwd" id="passwd" class="form-control" required/></td>
	</tr>
	<tr><td colspan="2">forgot your Password? <a href="request.php?d=<?php if(isset($_GET['d'])){ echo $_GET['d']; } ?>">Click here to reset it.</a></td></tr>
	<tr>
	<td>&nbsp;</td>
	<td align="right"><button name="btnLoginUser" id="btnLoginUser" class="btn btn-warning btn-lg">Login</button></td>
	</tr>
	<tr><td colspan="2"><a href="register.php?d=<?php if(isset($_GET['d'])){  echo $_GET['d']; } ?>">Click Here to Register.</a></td></tr>
	</table>
	</form>
</div>
<div class="col-lg-4"></div>
</div>
<div class="row" id="footer"></div>
</body>
</html>
<?php
if(isset($_POST['btnLoginUser'])){
	$myuser = array();
	$f3 = require("../../lib/base.php");
	$f3->route('GET|POST /userLogin.php',function(){
	global $dbname,$dbuser,$dbpass;
  	$uid = $_POST['username'];
	$passwd = $_POST['passwd'];
	$pass = md5($passwd);
	$db = new DB\SQL("mysql:host=localhost;port=3306;dbname={$dbname}","{$dbuser}","{$dbpass}");
	$user = new DB\SQL\Mapper($db,'user');
	$user->load(array('username=? AND passwd=? AND designation=?',$uid,$pass,$_GET['d']));
	if($user->passwd === $pass)
	{
		if($user->status == '0')
		{
			//header("Location: ../../index.php?noconfirm", true);
			//exit;
			?>
			<script>
				window.location="../../index.php?noconfirm";
			</script>
			<?php
		}else{
		$myuser['username'] = $user->username;
		$myuser['password'] = $user->passwd;
		$myuser['name'] = $user->name;
		$myuser['phone'] = $user->phone;
		$myuser['email'] = $user->email;
		$myuser['city'] = $user->city;
		$myuser['state'] = $user->state;
		$myuser['country'] = $user->country;
		$myuser['dateReg'] = $user->datereg;
		$myuser['designation'] = $user->designation;
        $myuser['status'] = $user->status;
        $myuser['expired'] = $user->expired;
		$_SESSION['user'] = $myuser;
		if(strtoupper($myuser['designation'])==="STUDENT"){
		//header("Location: ../views/",true);
		//exit;
		?>
			<script>
				window.location="../views/";
			</script>
			<?php
	}
		else if(strtoupper($myuser['designation'])==="ADMIN"){
			//header("Location: ../admin/",true);
			//exit;
			?>
			<script>
				window.location="../admin/";
			</script>
			<?php
		}else if(strtoupper($myuser['designation'])==="TEACHER"){
			//header("Location: ../teacher/",true);
			//exit;
			?>
			<script>
				window.location="../teacher/";
			</script>
			<?php
		}
		}
	}
	else{
		?>
		<script>showInfo("danger","Either your username or password is wrong!");</script>
		<?php
	}
});
$f3->run();
}
ob_end_flush();
?>
