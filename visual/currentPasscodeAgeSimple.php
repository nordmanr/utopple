<?php
	$dateFile = exec("date +%s -r ./pythonCreated/ageCounter.passcode");
	$date = exec("date +%s");
	if((120-($date - $dateFile)) > 0){
		echo (120-($date - $dateFile));
	}else{
		echo "N/A";
	}
?>
