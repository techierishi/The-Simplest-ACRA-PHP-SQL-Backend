<?php
$servername = '';
$username = '';
$password = '';
$dbname = '';
$mysql = mysql_connect($servername, $username, $password);
mysql_select_db($dbname);
$state = 'state=';
if(isset($_REQUEST['all'])){
    $sql = "DELETE FROM `exceptions`"; 
    $result = mysql_query($sql, $mysql);
}
if(isset($_REQUEST['time'])){
    $delete = $_REQUEST['time'];
    $sql = "DELETE FROM `exceptions` WHERE `time`='$delete'"; 
    $result = mysql_query($sql, $mysql);
    if($result == true){
        $state = 'Success!';
        
    }else{
        $state = 'FAILED!';
    }
    
}else{
    $state = 'Noinput';
}

sleep(3);
   
die(header("Location: https://gamers-cave-world.com/android/crash/index.php?$state"));



?>
<html>
    
    <h1><a href="index.php">RETURN</a></h1>
    
</html>