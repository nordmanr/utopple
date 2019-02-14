<html>
	<head>
		<style>
			#main{
				position:absolute;
				left:0px;
				top:50%;
				transform:translate(0,-50%);

				width:100%;

				padding:0px;
				margin:0px;

				text-align:center;
			}
			a{
				color:#e6e9ed;
			}
			body{
				background:#0a2351;
			}
		</style>
		<link rel="icon" href="favicon.ico">
		<title>
			Youtube-dl
		</title>
	</head>
	<body>
		<div id="main">
			<?php
				$path = "/var/www/com/utopple/youtube-dl/downloads";
				$files = scandir($path);  //Get array of directory elements
				for($i=0; $i<count($files); $i++){  //For every file in the downloads folder
					if(strpos($files[$i], '.mp3')){ //If is .mp3 file
						echo "<a href='downloads/$files[$i]' download>$files[$i]</a>";
						echo "<br>";
					};
				};
			?>
		</div>
	</body>
</html>
