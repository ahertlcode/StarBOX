<?php
	$f3 = require("../lib/base.php");
	$f3->route('GET /saveuser.php',function(){
	$db = new DB\SQL("mysql:host=localhost;port=3306;dbname=twsixcom_starbox","twsixcom_star","b@klop*&12345ADE+#");
	$user = new DB\SQL\Mapper($db,'user');
	$user->copyFrom('POST');
	$user->save();
});
$f3->run();
?>
