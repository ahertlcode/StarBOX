<?php
session_start();
require("../../classes/db2.php");
if(isset($_GET['subj']) && isset($_GET['exam'])){
unset($_SESSION['exam']);
unset($_SESSION['subject']);
unset($_SESSION['TestMode']);
unset($_SESSION['qtoans']);
$dbg = new db();
$quer = "select * from examsetup where examtype='{$_GET['exam']}' and subject='{$_GET['subj']}' and status='1'";
$eout = $dbg->getRowAssoc($quer);
$_SESSION['exam'] = $_GET['exam'];
$_SESSION['subject'] = $_GET['subj'];
$_SESSION['TestMode'] = $_GET['mode'];
$_SESSION['qtoans'] = $eout[0]['questions'];
}
?>
