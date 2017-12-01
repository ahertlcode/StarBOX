<?php
session_start();
require_once("../../classes/db2.php");
if(isset($_GET['login'])){
if(!empty($_POST['connection_token'])){
//echo "Token not Empty: ".$_POST['connection_token']."<br/>";
//Implement Signin
 //Get connection_token
  $token = $_POST['connection_token'];
 
  //Your Site Settings
  $site_subdomain = 'starbox';
  $site_public_key = 'c077f9bf-ff7e-4070-a477-af64b473b424';
  $site_private_key = 'e254952b-ef8e-4453-a7b4-f99822af0079';
 
  //API Access domain
  $site_domain = $site_subdomain.'.api.oneall.com';
 
  //Connection Resource
  //http://docs.oneall.com/api/resources/connections/read-connection-details/
  $resource_uri = 'https://'.$site_domain.'/connections/'.$token .'.json';
 
  //Setup connection
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $resource_uri);
  curl_setopt($curl, CURLOPT_HEADER, 0);
  curl_setopt($curl, CURLOPT_USERPWD, $site_public_key . ":" . $site_private_key);
  curl_setopt($curl, CURLOPT_TIMEOUT, 15);
  curl_setopt($curl, CURLOPT_VERBOSE, 0);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
  curl_setopt($curl, CURLOPT_FAILONERROR, 0);
 
  //Send request
  $result_json = curl_exec($curl);

  //Error
  if ($result_json->result->status->flag === false)
  {
    //You may want to implement your custom error handling here
    //echo 'Curl error: ' . curl_error($curl). '<br />';
    //echo 'Curl info: ' . curl_getinfo($curl). '<br />';
    echo "There is an error! You could not be logged in. Try again Later";
    curl_close($curl);
    ?><script>
	setTimeout("window.location.href='../views/userLogin.php'",5000);
    </script><?php
  }
  //Success
  else
  {
    //Close connection
    curl_close($curl);
 
    //Decode
    $json = json_decode ($result_json);
    //Extract data
    $data = $json->response->result->data;
   
    //Check for service
    switch ($data->plugin->key)
    { 
	case 'social_login':
       
        //Single Sign On
        case 'single_sign_on':            
        //Operation successfull
        if ($data->plugin->data->status == 'success')
        {
          //The user_token uniquely identifies the user that has connected with his social network account
          $user_token = $data->user->user_token;

          //The identity_token uniquely identifies the social network account that the user has used to connect with
          $identity_token = $data->user->identity->identity_token;       
   
          // 1) Check if you have a userID for this token in your database
          $user_id = GetUserIdForUserToken($user_token);
	  $maile = $data->user->identity->emails[0]->value;
	  $alt_id = getIdWithMail($maile);
	  
          // 1a) If the userID is empty then this is the first time that this user has connected with a social network account on your website
          if ($user_id === null && $alt_id != null)
          {
		/**/
		echo "I got here :".$alt_id;exit;
	    $user_id = $alt_id;
            // 1a1) Create a new user account and store it in your database
            // Optionally display a form to collect  more data about the user.
            //$user_id = {The ID of the user that you have created}
   
            // 1a2) Attach the user_token to the userID of the created account.
		    if(LinkUserTokenToUserId ($user_token, $user_id)){
		    doUserLogin($user_id,$maile);
		   }
          }else if($user_id != null){
		doUserLogin($user_id,$maile);
	  }
          // 1b) If you DO have an userID for the user_token then this user has
          // already connected before
          else
          {
            // 1b1) The account already exists
	   echo "Account not found! It appears you are not registered on StarBox yet.";
	   ?><script>
		setTimeout("window.location.href='../views/register.php'",5000);
	   </script><?php
          }
   
          // 2) You have either created a new user or read the details of an existing
          // user from your database. In both cases you should now have a $user_id 
           
          // 2a) Create a Single Sign On session
          // $sso_session_token = GenerateSSOSessionToken ($user_token, $identity_token); 
          // If you would like to use Single Sign on then you should now call our API
          // to generate a new SSO Session: http://docs.oneall.com/api/resources/sso/
                     
          // 2b) Login this user
          // You now need to login this user, exactly like you would login a user
          // after a traditional (username/password) login (i.e. set cookies, setup 
          // the session) and forward him to another page (i.e. his account dashboard)    
        }
      break;
    }
  }

}
else{
	header("Location: ../../index.php",true);
	exit;
}
}else if(isset($_GET['signup'])){
//echo "This is a signUp<br/>";
if(!empty($_POST['connection_token'])){
//Implement Sign Up

}
else{
	header("Location: ../../index.php",true);
	exit;
}
}


function GetUserIdForUserToken($tok){
$db = new db();
return $db->getRowAssoc("select user_id from user_social_link where user_token='{$tok}'")[0]['user_id'];
//echo "<br/>Got userid with token.";
}
function getIdWithMail($m){
$dbm = new db();
return $dbm->getRowAssoc("select username from user where email='{$m}'")[0]['username'];
//echo "<br/>Get Userid with mail.";
}
function LinkUserTokenToUserId($tok,$uid){
 $dbl = new db();
 return $dbl->executeQuery("insert into user_social_link values('0','{$uid}','{$tok}')");
//echo "<br/>Userid linked up.";
}
function doUserLogin($uid,$email){
 //echo "<br/>User about to be logged in.";
 $dbi = new db();
 $myuser = $dbi->getRowAssoc("select * from user where username='{$uid}' AND email='{$email}'");
 $_SESSION['user'] = $myuser;
 header("Location: ../views/",true);
 exit;
}
?>
