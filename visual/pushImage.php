<!DOCTYPE html>
<html>
	<head>
		<style>
			table{
				border: none;
				border-collapse: collapse;
				padding: 0;
				margin: 0
			}
		</style>
	</head>
	<body>
	<table>
		<?php
			$passcode = $_GET["passcode"];
			$size = $_GET["size"];
			$newData = $_GET["data"];

			echo "Passcode:&nbsp&nbsp".$passcode."<br>";
			echo "Size:&nbsp&nbsp".$size."<br>";
			echo "Data:&nbsp&nbsp".$data."<br>";

			$updatedColors = "";
			$colors = array();

			$colors = explode(",", $newData);

			for($i = 0; $i < $size*$size; $i++){		// For every pixel
				if(($i+1)%$size==0){
					$updatedColors = $updatedColors.$colors[$i]."\n";
				}else{
					$updatedColors = $updatedColors.$colors[$i].",";
				}
			}

			$pub = file_get_contents("./pythonCreated/pub.pem");		// Public key

			//openssl_public_decrypt($passcode, $verified, $pub);		// Decrypt the passcode
			$verified = $passcode;

			if($verified == $pub){					// Verified from current user
				$file = fopen($size."x".$size.".csv", "w") or die("Unable to open!");
				fwrite($file, $updatedColors);
				fclose($file);
			}
		?>
	</table>
	</body>
</html>
