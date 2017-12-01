<?php
    session_start();
    require("../../classes/db2.php");
    require("../dbconfig.php");
    if(isset($_GET['mail']) && isset($_GET['phone']) && isset($_GET['newctry'])){
        $dbo = new db();
        $lcountry = $_GET['newctry'];
        $lphon = $_GET['phone'];
        $lmail = $_GET['mail'];
        $q = "update user set country='{$lcountry}' where email='{$lmail}' and phone='{$lphon}'";
        $lh = $dbo->executeQuery($q);
        if($lh===0){
            echo "-1";
            }else{
            $_SESSION['user']['country'] = $lcountry;
            echo "1";
            }
        }
    ?>