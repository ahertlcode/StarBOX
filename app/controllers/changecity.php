<?php
    session_start();
    require("../../classes/db2.php");
    require("../dbconfig.php");
    if(isset($_GET['mail']) && isset($_GET['phone']) && isset($_GET['newcity'])){
        $dbo = new db();
        $lcity = $_GET['newcity'];
        $lphon = $_GET['phone'];
        $lmail = $_GET['mail'];
        $q = "update user set city='{$lcity}' where email='{$lmail}' and phone='{$lphon}'";
        $lh = $dbo->executeQuery($q);
        if($lh===0){
            echo "-1";
            }else{
            $_SESSION['user']['city'] = $lcity;
            echo "1";
            }
        }
    ?>