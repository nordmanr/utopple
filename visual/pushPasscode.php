<?php
	if(isset($_GET["key"])){
		$passcode = $_GET["key"];                       // From URL parameters -- app
	}else{
		$passcode = $_POST["key"];			// From POST -- online
	}

	$ls = shell_exec("ls ./pythonCreated");

	if(strpos($ls, ".passcode") === false){

		$file = fopen("./pythonCreated/$passcode.passcode", "w");	// Write

		fwrite($file, "$passcode");

		fclose($file);

		$file = fopen("./pythonCreated/ageCounter.passcode", "w");
		fwrite($file, "timer");
		fclose($file);

		echo("1");			// Same
	}else if(strpos($ls, "$passcode.passcode") !== false){
		echo("1");			// Not accepted, but same
	}else{
		echo("0");			// Not accepted or not same
	}

	if(isset($_POST["buttonSubmit"])){  // if from online, send back to homepage
		header("Location: http:\/\/visual.glasscloud.net");
		exit();
	}
?>
