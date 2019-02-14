<!DOCTYPE html>
<html>
<head>
	<script>
		var i = 0;

		function countUp(){
			var element = document.getElementById("time")
			if(element.innerHTML > 1){
				element.innerHTML--;
			}else{
				element.innerHTML = "N/A";
				clearInterval(fun);
			}
		}

		var fun = setInterval(countUp, 1000);
	</script>
</head>
<body>
<div id="time">
	<?php
		$dateFile = exec("date +%s -r ./pythonCreated/ageCounter.passcode");
		$date = exec("date +%s");
		echo (120-($date - $dateFile));
	?>
</div>
</body>
</html>
