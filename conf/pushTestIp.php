<?php
        $ip = $_GET["ip"];                       // From URL parameters

	$file = fopen("./testIp.txt", "w");
	fwrite($file, "$ip");
	fclose($file);
?>

