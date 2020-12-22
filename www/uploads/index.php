<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                background: #dbdbdb;
            }

            #wrapper {
                background: #0a2351;
                box-shadow: 0px 0px 0px 2px #6B4900, 0px 0px 0px 4px #FFFFFF, 0px 0px 0px 6px #FFB64A, 0px 0px 0px 8px #6B4900;

                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                padding: 5px;
                color: white;
            }
            #upload {
                text-align: right;
            }
            #submit-button {
                margin-top: 20px;
                margin-bottom: 20px;
            }
            a:link, a:visited, a:hover, a:active {
                color: yellow;
            }
            input, span, a {
                font-size: 4vw;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <?php
                $hasFiles = false;
                $directory = './';
                if (is_dir($directory)) {
                    if ($opendirectory = opendir($directory)) {
                        while (($file = readdir($opendirectory)) !== false) {
                            if ($file !== '..' && $file !== '.' && $file !== 'index.php') {
                                echo '<a href="'.$file.'">'.$file.'</a><br />';
                                $hasFiles = true;
                            }
                        }
                        closedir($opendirectory);
                    }
                }
                if (!$hasFiles) {
                    echo '<a href="../fileupload.php">Empty...</a>';
                }
            ?>
        </div>
    </body>
</html>