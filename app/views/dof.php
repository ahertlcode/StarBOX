<?php
$f3=require('lib/base.php');
/*$f3->route('GET /dof.php',
function($f3) {
$f3->set('name','Apetu');
echo \Template::instance()->render('views/dof.html');
}
);
*/

$f3->route('GET /dof.php',function($f3){
$db = new DB\SQL("mysql:host=localhost;port=3306;dbname=starbox","root","adeade");
$user = new DB\SQL\Mapper($db,'user');
$u = $user->find();
$f3->set('Question',$u[0]);
echo \Template::instance()->render('views/TPage.php');
});
$f3->run();

if(isset($_POST['btnNext'])){

}
?>
