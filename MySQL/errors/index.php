<html>
    
    <h1 style="text-align:center;">Error Logs</h1>
    <h2 style="text-align:center;color:red">Powered by ACRA</h2>
    
    <form style="text-align:center;" action="tosql.php">
       
        
        List all text files into the SQL database <input type="submit" value="Index"  />
    </form>
    
    <p style="text-align:center;color:green">Thank you for using Simplest PHP ACRA Backend with modifications by Gamers Cave.<br>
    Feel free to support this project on <a href="https://github.com/GamersCave/ACRA-Simplest-Backend-With-Alterations">Github!</a>
    <br> Visit our website: <a href="https://gamers-cave-world.com">gamers-cave-world.com</a></p>
    <head>
        <title>All error logs:</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <table border="1" style="border:2px solid black;">
            <thead>
                <tr>
                    <td>time</td>
                    <td>newest_report</td>
                    <td>issue_id</td>
                    <td>android_version</td>
                    <td>device_id</td>
                    <td>app_version</td>
                    <td>stacktrace</td>
                    <td>package</td>
                    <td>recorded_events</td>
                    <td>delete report</td>
                    <?php echo "<td> <a href=\"delete.php?all=true\">Delete all</a></td>"?>
                </tr>
            </thead>
            <tbody>
            <?php
            
                
                if(isset($_REQUEST['state'])){
                    $delete = $_REQUEST['state'];
                    echo 'Deletion of file: ' . $delete . '<br>';
                    
                }
            
                $servername = '';
                $username = '';
                $password = '';
                $dbname = '';
        
                $mysql = mysql_connect($servername, $username, $password);
                mysql_select_db($dbname);
                
                echo 'STATUS: CONNECTED TO DATABASE<br>';
                $result = mysql_query("SELECT * FROM exceptions ORDER BY package ASC, time ASC", $mysql);
                
                if($result === FALSE) { 
                    die(mysql_error()); // TODO: better error handling
                }
                $total_records = mysql_num_rows($result);
                if($total_records == 0){
                    ?>
                    <tr >
                        <td ><?php echo 'No errors yet'?></td>
                        
                    </tr>
                    <?php
                }
                
                while($row = mysql_fetch_assoc($result)) {
                    $id = $row['time'];
               ?>
               
                    <tr>
                        
                        <td><?php echo $row['time'];?></td>
                        <td><?php echo $row['newest_report'];?></td>
                        <td><?php echo $row['issue_id'];?></td>
                        <td ><?php echo $row['android_version'];?></td>
                        <td ><?php echo $row['device_id'];?></td>
                        <td ><?php echo $row['app_version'];?></td>
                        <td ><?php echo $row['stacktrace'];?></td>
                        <td ><?php echo $row['package'];?></td>
                       <td> <?php echo $row['recorded_events'];?></td>
                        <?php echo "<td> <a href=\"delete.php?time=$id\">Delete</a></td>"?>
                       
                    </tr>
    
    
    
                <?php
                }
                
                
                
                
                ?>
                </tbody>
            </table>
    </body>
</html>
   