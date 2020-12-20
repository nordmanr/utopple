<?php
function RetrieveUserIP() {
	if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$address=$_SERVER['HTTP_CLIENT_IP'];
	} elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$address=$_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$address=$_SERVER['REMOTE_ADDR'];
	}
	return $address;
}

echo RetrieveUserIP();
?>
