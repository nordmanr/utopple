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


        // Get projects
            $sql = "SELECT * FROM projects";
            $result = $conn->query($sql);

            $project_records = array();

            // get all job experiences in a nice array
            while($row = $result->fetch_assoc()) {
                array_push($project_records, $row);
            }
            usort($project_records, 'compareProjects');

            function compareProjects($a, $b){
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
            <div id="name">
                <h2>Robert T. Nordman</h2>
            </div>
            <div id="title">
                <span>Computer Science (Cybersecurity) Student at Arizona State University</span>
            </div>
            <div id="contact_info">
                <span>Email: rnordman@protonmail.com</span>
            </div>
        </div>
        <div id="about">
            <h2>About</h2>
            <div>
                <span>
                    I'm a computer science student at Arizona State University.  The most important thing to know about me is that I love learning.  I've always been one to 
                    learn whenever possible.  Whether it be learning the intricacies of the systems I use at work or spending my spare time learning about web hosting in my, 
                    I'm always looking to expand what I know.  Early in my high school career I dabbled a bit in Computer Aided Design, but as an upper classman, 
                    I started into the computer science courses the school offered.  I began with Java, and quickly expanded into learning more in my spare time, messing 
                    around in the realities of hosting a website.  From there I went onto building a more complex network at my house, with a hardware firewall, my own DNS 
                    server, and some VPNs to allow myself to remote into my home network.  Now I'm working on a couple android apps and continuing to work on my website as 
                    I find time.
                </span>
            </div>  
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
                        if($row["show"]){
                            echo "<tr><td>".$row["title"]."</td></tr>";
                        }
                    }
                ?>
            </tbody></table>
        </div>
        <div id="projects">
            <h2 title="Some websites are self hosted on home network.  Slow speeds should be expected.">Projects</h2>

            <table><tbody>
                <?php
                    foreach($project_records as $row){
                        if($row["show"]){
                            echo "<tr><td>".$row["title"]."</td><td>".$row["details"]."</td></tr>";
                        }
                    }
                ?>
            </tbody></table>
        </div>
    </body>
</html>