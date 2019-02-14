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
	$publicKey = $_GET["key"];			// From URL parameters

	$file = fopen("./pythonCreated/pub.pem", "w");	// Write
	fwrite($file, "-----BEGIN PUBLIC KEY-----\n");	// BEGIN
		echo "-----BEGIN PUBLIC KEY-----<br>";		// echo
	$file = fopen("./pythonCreated/pub.pem", "a");	// Append

	$publicKey = str_replace(" ", "+", $publicKey);	// +'s instead of spaces

	for($i=0; $i<strlen($publicKey); $i=$i+64){	// Separate each line into 64 characters
		$sect = substr($publicKey, $i, 64);
			echo $sect."<br>";			// echo
		fwrite($file, $sect."\n");

	}
        fwrite($file, "-----END PUBLIC KEY-----\n");	// END
		echo "-----END PUBLIC KEY-----<br>";		// echo

	// testing temporarily
	$file = fopen("./pythonCreated/pub.pem", "w");  // Write
        fwrite($file, $publicKey);

	fclose($file);
?>
</span>
</body>
</html>
