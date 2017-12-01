<?php
$f3 = require("lib/base.php");
$f3->route('GET /',function(){
$db = new DB\SQL("mysql:host=localhost;port=3306;dbname=starbox","root","adeade");
$user = new DB\SQL\Mapper($db,'user');
$user->sn='0';
$user->username='SALBEEB';
$user->passwd=md5('Sa!ld33n');
$user->name='Saladeen Abbeeb';
$user->phone='+235329366';
$user->email='saladeen_dad@gmail.com';
$user->city='Accra';
$user->state='Accra';
$user->country='Gnana';
$user->datereg=date("Y-m-d h:s:i");
$user->status='0';
$user->save();
});
$f3->run();
