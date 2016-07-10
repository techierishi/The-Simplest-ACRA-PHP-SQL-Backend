<html>
    <h1 style="text-align:center;">File viewer</h1>
    <p style="text-align:center;color:green">Thank you for using Simplest PHP ACRA Backend with modifications by Gamers Cave.<br>
    Feel free to support this project on <a href="https://github.com/GamersCave/ACRA-Simplest-Backend-With-Alterations">Github!</a>
    <br> Visit our website: <a href="https://gamers-cave-world.com">gamers-cave-world.com</a></p> 
    <br><br>
    <p style="text-align:center;">Simple file viewer. Lists the files in errors/logs/ where the text files are. <br>
    This is for when you do not have access to MySQL or when you need to see the content of the files without<br>
    adding them to the SQL database.
    </p>
<?php
$files = array();
foreach (new DirectoryIterator(__DIR__ . "/errors/") as $file) {
    if ($file->isFile()) {
        $filename =  $file->getFilename();
             echo '<a href="errors/' . $file . '">' . $file . '</a> read <br>';
            
    }
}


?>
</html>