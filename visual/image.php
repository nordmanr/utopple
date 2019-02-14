<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			table{
				position:absolute;
				left:0;
				top:0;
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
			$size = $_GET["size"];
			$temp = "";
			$tempArr = array();
			$colors = array();
			$file = fopen("$size.csv", "r") or die("Unable to open!");
			$string = fread($file,filesize("$size.csv"));
			fclose($file);

			$pixelSize = 100/$size-.25;

			for($i=0; $i<strlen($string); $i++){
				$sub = substr($string,$i,1);
				if($sub==","){
					array_push($tempArr, $temp);
					$temp = "";
				}else{
					$temp = $temp.$sub;
				}
				if($sub=="\n"){
					//Each line
					array_push($tempArr, $temp);
					$temp = "";
					array_push($colors, $tempArr);
					$tempArr = array();
				}
			}

			echo "\n";

			for($i=0; $i<count($colors); $i++){
				echo "<tr>";
				for($j=0; $j<count($colors[$i]); $j++){
					$af = $colors[$i];
				echo "<td style='background-color:#".$af[$j]."; width:".$pixelSize."vw; height:".$pixelSize."vw'></td>";

				}
				echo "</tr>";
			}
		?>
	</table>
	</body>
</html>
