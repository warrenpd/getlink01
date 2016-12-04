<?php

 require __DIR__ . '/vendor/autoload.php';
 require __DIR__ . '/dotenv-loader.php';
  $auth0 = new \Auth0\SDK\Auth0(array(
    'domain'        => getenv('AUTH0_DOMAIN'),
    'client_id'     => getenv('AUTH0_CLIENT_ID'),
    'client_secret' => getenv('AUTH0_CLIENT_SECRET'),
    'redirect_uri'  => getenv('AUTH0_CALLBACK_URL')
  ));
  $userInfo = $auth0->getUser();
  if (isset($_REQUEST['logout'])) {
   session_unset();
  }

// Establishing connection with server..
  $connection = mysql_connect("localhost", "onelink", "onelink123");

// Selecting Database 
  $db = mysql_select_db("onelink", $connection);

//echo mysql_errno($connection) . ": " . mysql_error($connection). "\n";

console.log($newID);

//Fetching Values from URL  
$appname2=$_POST['appname'];
$playlink2=$_POST['playlink'];
$applink2=$_POST['applink'];
$mslink2=$_POST['mslink'];
$bblink2=$_POST['bblink'];
$deflink2=$_POST['deflink'];
$username=$userInfo['name'];
$useremail=$userInfo['email'];


$msg = "Username: $username \n AppName: $appame2 \n playlink: $playlink2 \n applink: $applink2 \n mslink: $mslink2 \n bblink: $bblink2 \n deflink: $deflink2";

srand((double)microtime()*10000); 

 //Random String Generator
    function generateRandomString($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        date_default_timezone_set("Asia/Kolkata");
        $randomString = $randomString.date('U');
        return $randomString;
   	 }
    $APPID = generateRandomString();

//Insert query 
  $query = mysql_query("insert into userdata(APPID, APPNAME, UserId, UserEmail, defaulturl, iphone, android, windowsp, blackb) values ('$APPID', '$appname2', '$username' , '$useremail' ,'$deflink2','$applink2', '$playlink2' ,'$mslink2', '$bblink2' )");

echo mysql_errno($connection) . ": " . mysql_error($connection) . "\n";

// seed random number generator 
srand((double)microtime()*10000); 

function gen_urlid() 
{ 
    $id = '';
    for ($i=1; $i<=5; $i++) { 
            $id .= chr(rand(65, 90)); 
    } 
    return $id;
} 

startgen:
$newID = gen_urlid(); 
$idquery = mysql_query("select URLID from getlink_url where URLID='$newID' ");
$row = mysql_fetch_array($idquery);
$idrow = $row["URLID"];
//echo $idrow;
if ($idrow == NULL) {
  $idinsert = mysql_query("insert into getlink_url(APPID, APPNAME, URLID) values ('$APPID', '$appname2','$newID')");
}
else {
  goto startgen;
}

echo "http://localhost/onelink03/linkit.php?".$newID;

//connection closed
mysql_close($connection);

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

//echo "HELLO";

// send email
mail("warren.prasad@gmail.com","Contact from $appname2",$msg);


?>