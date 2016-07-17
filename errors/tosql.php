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
    echo 'Transfered ' . $files . ' files, ' . ($files * 9) . ' values to the SQL database.';
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
    $servername = '';
    $username = '';
    $password = '';
    $dbname = '';
    $delim = 'TH12124D3L1M1TOR';
    
    echo $issue_id;
    
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
    
    

	$reworkedLog = $LOG;
	$reworkedLog = str_replace('LOGCAT =', '', $reworkedLog);
	
	$reworkedLog = preg_replace("'\d{2}-\d{2} \d{2}:\d{2}:\d{2}\.\d*'", '', $reworkedLog);
	$reworkedLog = preg_replace("'$\d*'", '', $reworkedLog);
	$reworkedLog = preg_replace("'0x[0-9a-f]*'", '', $reworkedLog);
	$reworkedLog = preg_replace("'(\d{5})'",'', $reworkedLog);
	$reworkedLog = preg_replace("'... \d{1} more'", '', $reworkedLog);
	$reworkedLog = preg_replace("'... \d{2} more'", '', $reworkedLog);
	
	
    
   
	$issue_id = bicou_issue_id($reworkedLog, $package) . '<br>';
	echo $issue_id;
	$obj['issue_id'] = $issue_id;
	$obj['newest_report'] = $time;
	$obj['recorded_events'] = 1;
	/**
	 * The following code is created with two variables, issue id and package, to ensure that
	 * the issue of one app isn't overridden by another! This is really annyouing as issues
	 * from two different apps would merge together causing missing errors in the app that comes
	 * after the first error. md5 generates codes based on the content, but it might sometimes
	 * generate the same ID over and over.
	 */
	$getIssueID = "SELECT * FROM exceptions WHERE issue_id='$issue_id', package='$package'";
    $lookForIssueId = mysql_query($getIssueID);
    if(!$lookForIssueId) echo 'failed! <br>';
    else echo 'Success!!! Issue ID loaded<br>';
    
    $count = mysql_num_rows($lookForIssueId);
    
    if($count > 0){
        echo $count . 'exists. Replacing values newest_report and recorded_events<br>';
        $row = mysql_fetch_assoc($lookForIssueId);
      date_default_timezone_set("Europe/Berlin");
    $date = date('d-m-Y_H-i-s');
            $newestReport = $date;
            $recorded_events = intval($row['recorded_events']);
            $recorded_events += 1;
            mysql_query("UPDATE exceptions SET newest_report='$newestReport', recorded_events='$recorded_events' WHERE issue_id = $issue_id");
            echo 'Updated SQL entry. Newest report: ' . $newestReport . '. Recorded events: ' . $recorded_events . '<br>';
        
    }else if(count == 0 || count < 0){
	    echo 'New issue!! ID: ' . $issue_id . '. ';
    	$sql =  bicou_mysql_insert($obj);
    	if(!mysql_query($sql, $mysql)){
    	    die(mysql_error());
    	}
    }else{
        echo 'ERROR';
    }
    unlink($file);//Removes the file
    echo 'Data inserted into DB ' . $dbname . ' table \'exceptions\' and file deleted<br>';
    mysql_close($mysql);
}


    // Finds in array
    function array_find($needle, $haystack) {
    	foreach($haystack as $k => $v) {
    		if (strstr($v, $needle) !== FALSE) {
    			return $k;
    		}
    	}
    	return FALSE;
    }
    function bicou_short_stack_trace($stack_trace, $package) {
    	$lines = explode("\n", $stack_trace);
    	if (array_find(": ", $lines) === FALSE && array_find($package, $lines) === FALSE) {
    		$value = $lines[0];
    	} else {
    		$value = "";
    		foreach ($lines as $id => $line) {
    		if (strpos($line, $package) !== FALSE
    			 || strpos($line, "Error") !== FALSE || strpos($line, "E/ACRA") !== FALSE) {
    				$value .= $line . "<br />";
    			}
    		}
    	}
    	
    	return $value;
    }
    function bicou_stack_trace_overview($stack_trace, $package) {
    	$value = "";
    	$lines = explode("\n", $stack_trace);
    	foreach ($lines as $id => $line) {
    		if (/*strpos($line, "Error") !== FALSE || strpos($line, "Exception"*/strpos($line, "E/ACRA") !== FALSE) {
    			$value .= $line . "<br />";
    		}
    	}
    	return $value;
    }
    function bicou_issue_id($stack_trace, $package) {
    	return md5(bicou_short_stack_trace($stack_trace, $package));
    }




?>
