<!DOCTYPE html>
<html lang="en">
<head>
<title>StarBox</title>
<script src="js/jquery-1.11.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="shortcut icon" href="images/starboximg.jpg"/>
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link  rel="stylesheet" href="css/bootstrap-theme.min.css" />
<link rel="stylesheet" href="css/index.css" />
</head>
<body>
<form method="post">
<table class="table">
<tr>
<td>Username</td>
<td><input type="text" name="username" id="username" class="form-control" required/></td>
</tr><tr>
<td>Password</td>
<td><input type="password" name="passwd" id="passwd" class="form-control" required/></td>
</tr>
<tr>
<td></td>
<td><button name="btnLoginUser" id="btn" class="btn btn-warning">Login</button></td>
</tr>
</table>
<?php

if (isset($_POST['btnLoginUser'])){
	$user = $_POST['username'];
	$pass = $_POST['passwd'];
echo $user;
}
?>
</form>