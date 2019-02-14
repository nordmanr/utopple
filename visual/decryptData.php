<!DOCTYPE html>
<html>
<head>
        <title>Push Public Key</title>
        <style>
                span{
                                font-family: monospace;
                                font-size: 16px;
                }
        </style>
</head>
<body>
<span>
<?php
        $data = $_GET["data"];					// From URL parameters

	$pub = file_get_contents("./pythonCreated/pub.pem");	// Get public key

?>
</span>
</body>
</html>


<?php
//$priv = file_get_contents("./pythonCreated/priv.pem");
$pub = file_get_contents("./pythonCreated/pub.pem");

$myin = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";

echo strlen($myin)."<br><br>";

//echo $priv."<br><br><br>";
echo $pub."<br>";

if(openssl_private_encrypt($myin,$en,$priv)){
	echo $en;
}else{
	echo "NO";
}
openssl_public_decrypt($en, $de, $pub);
echo "<br>".$de;
echo "<br><br><br>";
?>
