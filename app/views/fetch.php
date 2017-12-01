<?php
ob_start();
session_start();
require_once("../dbconfig.php");
$f3 = require("../../lib/base.php");
$f3->route('GET /fetch.php',function(){
global $dbname,$dbuser,$dbpass;
$db = new DB\SQL("mysql:host=localhost;port=3306;dbname={$dbname}","{$dbuser}","{$dbpass}");
$user = new DB\SQL\Mapper($db,'user');
$u = $user->find();
//$user->name;
foreach($u as $us)
    if(strtoupper($us->designation) == "STUDENT"){
	echo $us->username." ~ ".$us->name." ~ ".$us->email." ~ ".$us->phone." ~ ".$us->city."<br/>";
    }
}
);
$f3->run();
ob_end_flush();
?>