<?php
$servername = "";
$username = "";
$password = "";
$dbname = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE exceptions (
stacktrace LONGTEXT NOT NULL, 
time TEXT NOT NULL,
android_version TEXT NOT NULL,
device_id TEXT NOT NULL,
app_version TEXT NOT NULL,
package TEXT NOT NULL, 
issue_id TEXT NOT NULL,
recorded_events INT(11) NOT NULL,
newest_report TEXT  NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
