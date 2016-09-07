<?php
    $sendMail = true;//Should send email to inform?
    
    date_default_timezone_set("Europe/Berlin");
    $date = date('d-m-Y_H-i-s');
    if(is_dir_empty("crash/errors/")){
        if($sendMail){
            /**
             * The point of the email informative system is to inform you when crashes occur. This allows you to clear the SQL database.
             */
            $mail = 'address';
            $subj = "Crash";
            $msg = "A crash occured in one of your apps. This happened at " . $date . ". Move it over to the SQL database https://gamers-cave-world.com/android/crash/tosql.php now>
            
            With love from your trusty ACRA backend!
            
            Github: https://github.com/GamersCave/ACRA-Simplest-Backend-With-Alterations
            
            Our website: https://gamers-cave-world.com>gamers-cave-world.com
            ";
            mail($mail, $subj, $msg);
        }
    }
    $fileName = $date .'.txt';
    $file = fopen('crash/errors/' . $fileName,'w') or die("An error occured writing to " . $fileName);
    foreach($_POST as $key => $value) {
        $reportLine = $key." = ".$value."\n";
        fwrite($file, $reportLine) or die ('Could not write to report file ' . $reportLine);
    }
    fclose($file);
    
    
    /*
     * Used to check if the directory is empty or not.
     * In its own function in case we need it somewhere
     * else, it is just to include this class.
     */
    function is_dir_empty($dir) {
        if (!is_readable($dir)) return NULL; 
            $handle = opendir($dir);
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                return FALSE;
                }   
        }
        return TRUE;
    }
    
    

?>