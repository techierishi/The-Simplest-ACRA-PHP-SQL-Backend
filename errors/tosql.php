<h1 style="text-align:center;"><a href="index.php">Reports</a></h1>
<p style="text-align:center;color:green">Thank you for using Simplest PHP ACRA Backend with modifications by Gamers Cave.<br>
    Feel free to support this project on <a href="https://github.com/GamersCave/ACRA-Simplest-Backend-With-Alterations">Github!</a>
    <br> Visit our website: <a href="https://gamers-cave-world.com">gamers-cave-world.com</a></p>
<html>
    <title>.txt -> sql</title>
</html>
<?php
echo "PHP Initialized!<br>";
listFiles();
/*
NOTE: THIS CLASS IS DONE! EVERYTHING WORKS! DO NOT MESS WITH IT!
EXCEPTION: IF THIS IS ON GITHUB.

*/

function listFiles(){
    echo "Listing files.<br>";
    echo "------------------------------------<br>";
    $files = 0;
    foreach (new DirectoryIterator(__DIR__ . "/errors/") as $file) {
        
        if ($file->isFile()) {
            print $file->getFilename() . " read <br>";
            replaceStrings(__DIR__ . "/errors/" . $file);
            $files++;
            echo "------------------------------------<br>";
        }
    }
    echo "------------------------------------<br>";
    echo "All queries done. <br>";
    echo 'Transfered ' . $files . ' files, ' . ($files * 6) . ' values to the SQL database.';
}
function replaceStrings($file){
   
    
    $lineCount = count(file($file));//this is line count
    echo 'Counted lines: ' .$lineCount . '<br>';
    $lines = file($file);//this is all lines
    echo 'preparing var initialization<br>';
    
    $packagename = $lines[0];
    $android_ver = $lines[$lineCount - 1];
    $app_version = $lines[1];
    $device_id = $lines[$lineCount - 2];
    $LOG = "";
    foreach ($lines as $line_num => $line) {
        if($line_num == 0 || $line_num == 1 || $line_num == $lineCount - 1 || $line_num == $lineCount - 2){
            echo $line_num . ' ignored <br>';
        }else{
            $LOG .= $line . '<br>';
        }
    }
    $time = basename($file, ".txt");
    echo 'vars set up: Device ID, Android Version, App Version, Time, Log, Package<br>';
   
    initializeSQL($file, $device_id, $android_ver, $app_version, $time, $LOG, $packagename);
}
function bicou_mysql_insert($object) {
	$table_prefix = "exceptions";
	$cols = "INSERT INTO $table_prefix (".implode(", ", array_keys($object)).") ";
	$vals = "VALUES ('".implode("', '", $object)."')";
	echo 'SQL statement prepared.<br>';
	return $cols.$vals;
}
function initializeSQL($file, $device_id, $android_ver, $app_version, $time, $LOG, $package){
    $servername = '*';
    $username = '*';
    $password = '*';
    $dbname = '*';
    
    
    $mysql = mysql_connect($servername, $username, $password);
    mysql_select_db($dbname);
    
    echo 'Connected to SQL database<br>';
    $LOG = str_replace('\'', ' ', $LOG); // Replaces all spaces with hyphens.
    $obj['stacktrace'] = $LOG;
    $obj['time'] = $time;
    $obj['android_version'] = $android_ver;
    $obj['device_id'] = $device_id;
    $obj['app_version'] = $app_version;
    $obj['package'] = $package;
    
	$sql =  bicou_mysql_insert($obj);
	if(!mysql_query($sql, $mysql)){
	    die(mysql_error());
	}
	
	
    unlink($file);//Removes the file
    echo 'Data inserted into DB and file deleted<br>';
    mysql_close($mysql);
}
?>