<?php

$domain = $_SERVER['HTTP_HOST'];
$path = $_SERVER['SCRIPT_NAME'];
$queryString = $_SERVER['QUERY_STRING'];

echo $domain;
echo " - ";
echo $path;
echo " - ";
echo $queryString;

if ($path != NULL){
	$dlink = "http://localhost/onelink03/redirect?".$path;
}
else {
$dlink = "http://localhost/onelink03/";
}

?>

<meta http-equiv="refresh" content="5;url=<?php echo $dlink?>">
</head>
    
    <body>
        You will be rediercted soon!
    </body>
    
</html>