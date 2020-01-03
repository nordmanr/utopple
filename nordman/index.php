<!DOCTYPE html>
<html>
    <?php
        $pageTitle = $_GET["title"];

        // has user and password info for MySQL SELECT.
        $configFile = fopen("config.txt", "r") or die("Unable to open file!");

        // Read from file
        $line1 = fgets($configFile);
        $line2 = fgets($configFile);
        $line1 = str_replace('USER: ', '', $line1);
        $line2 = str_replace('PASSWORD: ', '', $line2);

        // SQL database info
        $servername = "localhost";
        $username = preg_replace('/\s+/', '', $line1);  // get rid of newlines and other whitespaces
        $password = preg_replace('/\s+/', '', $line2);  // get rid of newlines and other whitespaces
        $dbname = "resume";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }



        // Get job experience
            $sql = "SELECT * FROM job_experience";
            $result = $conn->query($sql);

            $job_experience_records = array();

            // get all job experiences in a nice array
            while($row = $result->fetch_assoc()) {
                array_push($job_experience_records, $row);
            }
            $job_experience_records = array_reverse($job_experience_records);
        // Get job experience

        // Get education
            $sql = "SELECT * FROM education";
            $result = $conn->query($sql);

            $education_records = array();

            // get all job experiences in a nice array
            while($row = $result->fetch_assoc()) {
                array_push($education_records, $row);
            }
            $education_records = array_reverse($education_records);
        // Get education



        // Get skills
            $sql = "SELECT * FROM skills";
            $result = $conn->query($sql);

            $skills_records = array();

            // get all job experiences in a nice array
            while($row = $result->fetch_assoc()) {
                array_push($skills_records, $row);
            }
            usort($skills_records, 'compareSkills');

            function compareSkills($a, $b){
                return $a["priority"]<$b["priority"];
            }
        // Get skills






        // Close DB connection
        $conn->close();
    ?>
    <head>
        <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="index.css">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<title>Robert Nordman</title>
    </head>
    <body>
        <div id="intro">
            <div id="portrait">
                <img src="portrait.png"/>
            </div>
            <div id="name">
                <h2>Robert T. Nordman</h2>
            </div>
            <div id="title">
                <span>Student at Arizona State University</span>
            </div>
            <div id="contact_info">
                <span>Email: rnordman@protonmail.com</span>
            </div>
            <table><tr>
                <td class="accent">&nbsp&nbsp&nbsp</td>
                <td class="primary">&nbsp&nbsp&nbsp</td>
                <td class="secondary">&nbsp&nbsp&nbsp</td>
                <td class="tertiary">&nbsp&nbsp&nbsp</td>
                <td class="dark">&nbsp&nbsp&nbsp</td>
            </tr></table>
        </div>
        <div id="about">
            <span>

            </span>
        </div>
        <div id="background">
            <div id="job_experience">
                <h2>Job Experience</h2>
                <?php
                    foreach($job_experience_records as $row){
                        echo "<table><tr><td colspan=\"1\" class=\"dates\">".$row["sdate"]." – ".$row["fdate"].
                            "</td><td colspan=\"4\" class=\"title\"><b>".$row["title"].
                            "</b></td></tr><tr><td colspan=\"1\" class=\"location\">".$row["location"].
                            "</td><td colspan=\"4\" class=\"employer\"><i>".$row["employer"].
                            "</i></td></tr><tr><td colspan=\"5\" class=\"description\">".$row["description"].
                            "</td></tr><tr><td></td><td></td><td></td><td></td><td></td></tr></table>";
                    }
                ?>
            </div>
            <div id="education">
                <h2>Education</h2>
                <?php
                    foreach($education_records as $row){
                        echo "<table><tr><td colspan=\"1\" class=\"dates\">".$row["sdate"]." – ".$row["fdate"].
                            "</td><td colspan=\"4\" class=\"title\"><b>".$row["title"].
                            "</b></td></tr><tr><td colspan=\"1\">".
                            "</td><td colspan=\"4\" class=\"employer\"><i>".$row["degree"].
                            "</i></td></tr><tr><td colspan=\"5\" class=\"description\">".$row["description"].
                            "</td></tr><tr><td></td><td></td><td></td><td></td><td></td></tr></table>";
                    }
                ?>
            </div>
        </div>
        <div id="skills">
            <h2>Skills</h2>

            <table><tbody>
                <?php
                    foreach($skills_records as $row){
                        echo "<tr><td>".$row["title"]."</td></tr>";
                    }
                ?>
            </tbody></table>
        </div>
        <div id="accomplishments">
            <div id="projects">
                <h2>Accomplishments</h2>
                <span>Shining Force Station Website</span><br>
                <span>Utopple Website</span><br>
                <span>Christ Lutheran Avon Lake Website</span><br>
                <span>Keepsake Video Memories Website</span><br>
                <span>n11 Android App</span><br>
            </div>
        </div>
    </body>
</html>