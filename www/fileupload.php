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
                if (isset($_FILES['upload'])) {
                    $uploadDir = './uploads/';
                    $uploadedFile = $uploadDir . basename($_FILES['upload']['name']);

                    exit('Feature disabled by admin');

                    if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadedFile)) {
                        chmod($uploadedFile, 0644);
                        echo '<span>File was uploaded successfully.</span>';
                        echo '<br/><a href="fileupload.php">Go back...</a>';
                        echo '<br/><a href="./uploads/">View uploads</a>';
                    } else {
                        echo '<span">There was a problem saving the uploaded file<span>';
                        echo '<br/><a href="fileupload.php">Go back...</a>';
                    }
                } else {
                    echo '<form action="./fileupload.php" method="post" enctype="multipart/form-data">';
                    echo '<input id="upload" type="file" name="upload"><br />';
                    echo '<input id="submit-button" type="submit" name="submit" value="Upload">';
                    echo '</form>';
                }
            ?>
        </div>
    </body>
</html>