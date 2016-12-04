<?php
  include "phpqrcode/qrlib.php";
  // Require composer autoloader
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

?>



<html>
    <head>
        <script src="http://code.jquery.com/jquery-2.2.1.min.js" type="text/javascript"></script>
        <script src="https://cdn.auth0.com/js/lock-9.0.min.js"></script>

        <script type="text/javascript" src="//use.typekit.net/iws6ohy.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- font awesome from BootstrapCDN -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

        <script>
          var AUTH0_CLIENT_ID = '<?php echo getenv("AUTH0_CLIENT_ID") ?>';
          var AUTH0_DOMAIN = '<?php echo getenv("AUTH0_DOMAIN") ?>';
          var AUTH0_CALLBACK_URL = '<?php echo getenv("AUTH0_CALLBACK_URL") ?>';
        </script>


        <script src="public/app.js"> </script>
        <link href="public/app.css" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

               <script type="text/javascript">
        $(document).ready(function(){
            
            
            //if submit button is clicked
            $('#submit').click(function () {
              
                $nameErr = $xstatus = "";
                // Captcha is Passed
                //Get the data from all the fields
                var appname = $('input[name=appname]');
                var playlink = $('input[name=playlink]');
                var applink = $('input[name=applink]');
                var mslink = $('input[name=mslink]');
                var bblink = $('input[name=bblink]');
                var deflink = $('input[name=deflink');
      
                //Simple validation to make sure user entered something
                //If error found, add hightlight class to the text field
                if (appname.val()=='') {
                    //appname.addClass('hightlight');
                    $nameErr = "Name is required";
                    alert("ERROR!");
                    return false;
                } 
                
                /*if (playlink.val()=='') {
                    playlink.addClass('hightlight');
                    return false;
                } else playlink.removeClass('hightlight');
                
                if (playlink.val()=='') {
                    applink.addClass('hightlight');
                    return false;
                } else applink.removeClass('hightlight');
                
                if (mslink.val()=='') {
                    mslink.addClass('hightlight');
                    return false;
                } else mslink.removeClass('hightlight');
                
                if (bblink.val()=='') {
                    bblink.addClass('hightlight');
                    return false;
                } else bblink.removeClass('hightlight');*/

                //alert("TEST 0: "'appname=' + appname.val()+'playlink='+playlink.val()+'applink='+applink.val()+'mslink='+mslink.vat()+'bblink='+bblink.val());
                
                //organize the data properly
                //var data = 'name=' + appname.val() + '&email=' + email.val() + '&phonenumber=' + phonenumber.val() + '&message=' + encodeURIComponent(message.val());
                
                var data = 'appname=' + appname.val()+'&'+'playlink='+playlink.val()+'&'+'applink='+applink.val()+'&'+'mslink='+mslink.val()+'&'+'bblink='+bblink.val();

                alert("TEST 1: "+data);
                //disabled all the text fields
                $('.text').attr('disabled','true');
                
                //show the loading sign
                document.getElementById("submit").disabled=true;
                document.getElementById("submit").value='Please Wait..';
                
                //start the ajax
                $.ajax({
                    //this is the php file that processes the data and send mail
                    url: "contact-form.php",    
                    
                    //GET method is used
                    type: "POST",
        
                    //pass the data         
                    data: data,     
                    
                    //Do not cache the page
                    cache: false,
                    
                    //success
                    success: function(result){
                                //hide the form
                            $('.contact-form-div').fadeOut('slow');
                            document.getElementById("p1").innerHTML = "RESULT: "+result;                 
                            document.getElementById("p2").innerHTML = "HELLO&&&&";   
                            //show the success message
                            alert("SUCCESS"+result);
                            $('.done').fadeIn('slow');
                                    }
                    
                });
                //cancel the submit button default behaviours
                return false;
                
            }); 
        })
        </script>


<?php

// Establishing connection with server..
  $connection = mysql_connect("localhost", "onelink", "onelink123");

// Selecting Database 
  $db = mysql_select_db("onelink", $connection);

//echo mysql_errno($connection) . ": " . mysql_error($connection). "\n";

// seed random number generator 
srand((double)microtime()*10000); 

function gen_id() 
{ 
    $id = ''; 

    for ($i=1; $i<=5; $i++) { 
            $id .= chr(rand(65, 90)); 
    } 
    return $id; 

} 

$newID = gen_id(); 
$idquery=mysql_query("select ID from getlink_url where URLID='$newID' ");
if ($idquery==NULL) {
  $newID = $newID;
}
else {
  $newID = gen_id();
}

console.log($newID);

//echo $msg;
//Insert query 
 // $query = mysql_query("insert into userdata(Appname, UserId, defaulturl, iphone, android, windowsp, blackb) values ('$appname2', 'TEST1', 'DEFURL','$applink2', '$playlink2' ,'$mslink2', '$bblink2' )");

//echo mysql_errno($connection) . ": " . mysql_error($connection) . "\n";

//connection closed
  mysql_close($connection);

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

//echo "HELLO";

// send email
mail("warren.prasad@gmail.com","Contact from $appname2",$msg);


?>

 

    </head>
    <body class="home">

  <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!--li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li-->
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(!$userInfo): ?>
        <li><a class="btn btn-login ">SignIn</a></li>
        <?php else: ?>
        <li><a href=""><?php echo $userInfo['email'] ?></a></li>
        <li><a href='?logout' class="glyphicon glyphicon-log-out"></a></li>
        <?php endif ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">

   
        <div class="item active">
          <img class="third-slide" src="img/i3.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->

     <div class="container marketing">

<p><br><br><br><br></p> 


<?php if(!$userInfo): ?>
  
  <p> PLEASE LOGIN TO CONTINUE ...... </p>    

<?php else: ?>

<form class="form-horizontal">
<p id="p1">Hello World!</p>
<p id="p2">Hello World!</p>
  <div class="form-group">
    <div class="col-sm-8">
      <input type="text" class="form-control" name="appname" placeholder="App Name">
    </div>
  </div>
  <p>Links to your App stores</p>
  <div class="form-group">
    <div class="col-sm-8">
      <input type="url" class="form-control" name="playlink" placeholder="Android - Play Store Link">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-8">
      <input type="url" class="form-control" name="applink" placeholder="Apple - App Store Link">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-8">
      <input type="url" class="form-control" name="mslink" placeholder="Microsoft Store Link">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-8">
      <input type="url" class="form-control" name="bblink" placeholder="Blackberry Store Link">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-8">
      <input type="url" class="form-control" name="deflink" placeholder="Fallback URL for other devices / browsers">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">

    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" id="submit" onclick="">Submit</button>
    </div>
  </div>
</form>


<?php endif ?>
<!-- /.============== -->






      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->


      <!-- FOOTER -->
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2016 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->



        <!--div class="container">
            <div class="login-page clearfix">
              <?php if(!$userInfo): ?>
              <div class="login-box auth0-box before">
                <img src="https://i.cloudup.com/StzWWrY34s.png" />
                <h3>Auth0 Example</h3>
                <p>Zero friction identity infrastructure, built for developers</p>
                <a class="btn btn-primary btn-lg btn-login btn-block">SignIn</a>
              </div>
              <?php else: ?>
              <div class="logged-in-box auth0-box logged-in">
                <h1 id="logo"><img src="//cdn.auth0.com/samples/auth0_logo_final_blue_RGB.png" /></h1>
                <img class="avatar" src="<?php echo $userInfo['picture'] ?>"/>
                <h2>Welcome <span class="nickname"><?php echo $userInfo['name'] ?></span></h2>
              </div>
              <?php endif ?>
            </div>
        </div-->
    </body>
</html>
