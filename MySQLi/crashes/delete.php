<?php
$servername = '';
$username = '';
$password = '';
$dbname = '';
$mysql = mysqli_connect($servername, $username, $password, $dbname);

$state = 'state=';
if(isset($_REQUEST['all'])){
    $sql = "DELETE FROM `exceptions`"; 
    $result = mysqli_query($mysql, $sql);
}
if(isset($_REQUEST['time'])){
    $delete = $_REQUEST['time'];
    $sql = "DELETE FROM `exceptions` WHERE `time`='$delete'"; 
    $result = mysqli_query($mysql, $sql);
    if($result == true){
        $state = 'Success!';
        
    }else{
        $state = 'FAILED!';
    }
    
}else{
    $state = 'Noinput';
}

sleep(3);
   
die(header("Location: index.php?$state"));



?>
<html>
    
    <h1><a href="index.php">RETURN</a></h1>
    
</html>
