<html>
	<head>
		<link rel="stylesheet" text="test/css" href="general.css">
		<link rel="stylesheet" text="test/css" href="download_page.css">
                <title>youtube-dl</title>

	</head>
	<body>
		<div id="title">
			<span>Youtube Download</span>
		</div>
		<div id="main">
			<?php
				$url = $_GET["url"];  //Get from page parameters
				//Next is the line of code to download the audio
				$cat = "youtube-dl --embed-thumbnail --extract-audio --audio-format mp3 --restrict-filenames --output '/var/www/com/utopple/youtube-dl/downloads/%(title)s.%(ext)s' ".$url."";
				shell_exec($cat);
				//Get title of video
				$title = exec("youtube-dl --skip-download --get-title --restrict-filenames --no-warnings ".$url);
			?>
			<br>
			<div id="links">
				<table>
					<thead>
						<tr>
							<th>
								<span>
									<?php
										echo $title;
									?>
								</span>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php
									$title = str_replace(' ','_',$title);
									echo "<a href='downloads/$title.mp3'>Link</a>";
								?>
							</td>
						</tr>
						<tr>
							<td>
								<a href="downloads.php">
									All Downloads
								</a>
							</td>
						</tr>
					</tbody>

				</table>
			</div>
		</div>
	</body>
</html>
