<?php
require_once("../../classes/db2.php");
$db = new db();
$pUsed = $db->executeQuery("update request set used='1' where requestmail='{$_GET['t']}'");
?>
