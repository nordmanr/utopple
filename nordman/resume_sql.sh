mysqladmin -p create resume

mysql -u root -p  <<EOF
GRANT SELECT ON resume.* TO 'selectResume'@'localhost' IDENTIFIED BY '<REMOVED FOR SECURITY>';
GRANT SELECT,INSERT,UPDATE,DELETE ON resume.* TO 'modifyResume'@'localhost' IDENTIFIED BY '<REMOVED FOR SECURITY>';
GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP,ALTER ON resume.* TO 'databaseResume'@'localhost' IDENTIFIED BY '<REMOVED FOR SECURITY>';
UPDATE user SET plugin='mysql_native_password' where User='selectResume';
UPDATE user SET plugin='mysql_native_password' where User='modifyResume';
UPDATE user SET plugin='mysql_native_password' where User='databaseResume';
FLUSH PRIVILEGES;
USE resume;
CREATE TABLE `job_experience` (
    `id` INT NOT NULL AUTO_INCREMENT, 
    `title` VARCHAR(50) NOT NULL, 
    `employer` VARCHAR(50) NOT NULL, 
    `sdate` VARCHAR(50) NOT NULL, 
    `fdate` VARCHAR(50) NOT NULL, 
    `location` VARCHAR(50) NOT NULL, 
    `description` VARCHAR(500) NOT NULL,
    PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `resume`.`job_experience` (
    `title`,`employer`,`sdate`,`fdate`,`location`,`description`)
    VALUES
    ('TV & Theater Crew Member','Avon Lake City Schools','2015','2018','Avon Lake, OH','Producing real time video coverage of sporting and Performaing Art Center (PAC) events.  Operating lighting and audio equipment for performances in the PAC.'),
    ('Freelance, Auxiliary Technical Developer','Christ Evangelical Lutheran Church','2017','Now','Avon Lake, OH','Migrated Church\'s website over to Sqaurespace.  Maintaining custom website navigation tools.  Combatting issues as they arise.'),
    ('Freelance, Auxiliary Technical Developer','Keepsake VM','2017','Now','Avon Lake, OH','Migrated website over to Squarespace.  Combatting issues as they arise.'),
    ('A/V Technician','Arizona State University','2019','Now','Tempe, AZ','Handle A/V equipment for the Student Pavilion.  Preparing projectors and microphones and providing event support as needed.'),
    ('Salesforce Developer','Arizona State University','2019','Now','Tempe, AZ','Create new features and functionalities using Salesforce and maintain existing front-end pages and back-end code.');

CREATE TABLE `education` (
    `id` INT NOT NULL AUTO_INCREMENT, 
    `title` VARCHAR(50) NOT NULL, 
    `degree` VARCHAR(50) NOT NULL, 
    `sdate` VARCHAR(50) NOT NULL, 
    `fdate` VARCHAR(50) NOT NULL, 
    `description` VARCHAR(500) NOT NULL,
    PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `resume`.`education` (
    `title`,`degree`,`sdate`,`fdate`,`description`)
    VALUES
    ('Avon Lake High School','Honors Diploma','2014','2018','GPA: 4.7.  National Merit Scholar.'),
    ('Arizona State University','Computer Science (Cybersecurity) (BS)','2018','Now','GPA: 4.0.  Ira A Fulton School or Engineering.');

CREATE TABLE `skills` (
    `id` INT NOT NULL AUTO_INCREMENT, 
    `title` VARCHAR(50) NOT NULL, 
    `show` BOOLEAN NOT NULL, 
    `priority` INT NOT NULL, 
    PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `resume`.`skills` (
    `title`,`show`,`priority`)
    VALUES
    ('<b>Programming</b>',true,8500),
    ('Java, C++',true,8490),
    ('HTML, CSS, JS',true,8480),
    ('Android App Development',true,8470),
    ('Salesforce',true,8460),
    ('<b>Technical</b>',true,7500),
    ('Debian Linux',true,7450),
    ('Webservice hosting',true,7470),
    ('<b>Other</b>',true,1100),
    ('Signal Flow',true,1010),
    ('A/V Systems',true,1020),
    ('Computer Repair',true,1050);

CREATE TABLE `projects` (
    `id` INT NOT NULL AUTO_INCREMENT, 
    `title` VARCHAR(50) NOT NULL, 
    `details` VARCHAR(250) NOT NULL, 
    `show` BOOLEAN NOT NULL, 
    `priority` INT NOT NULL, 
    PRIMARY KEY (`id`) ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO `resume`.`projects` (
    `title`,`details`,`show`,`priority`)
    VALUES
    ('Shining Force Station Website','<a href="https://www.shiningforcestation.com">Shining Force Station</a>".  Responsible for hosting and construction of site.',true,8490),
    ('uToppple Website','<a href="https://nordman.utopple.com/">uTopple</a>.  Responsible for hosting and construction of site.',true,8480),
    ('Christ Lutheran Avon Lake Website','<a href="https://www.christlutheranavonlake.org/">Christ Lutheran Avon Lake</a>.  Responsible for migrating over to Squarespace and custom navigation tools',true,8470),
    ('Keepsake Video Memories Website','<a href="https://www.keepsakevm.com/">Keepsake VM</a>.  Repsonsible for migrating over to Squarespace.',true,8460),
    ('n11 Android App','<a href="https://code.utopple.com/">Main Repo</a>.  Built an app repliacting the functionality of the mobile game 2048.',true,1050);
EOF

