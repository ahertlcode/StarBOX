<?php
//Password Hashing
if(isset($_GET['p'])){
	$pwd = $_GET['p'];
	echo md5($pwd);
	}
?>
