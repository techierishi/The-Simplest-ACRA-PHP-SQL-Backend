<?php
/**
WARNING! THis class is not done. It has been added in order to get help getting it to work.
Thanks.
*/

listFiles();

function listFiles(){
    if ($handle = opendir('errors/')) {
    
        while (false !== ($entry = readdir($handle))) {
            replaceStrings($entry);
        }
    
        closedir($handle);
    }
}


function replaceStrings($file){
    
    $logcat = "LOGCAT =";
    $app_version = "APP_VERSION_NAME =";
    $phone = "PHONE_MODEL =";
    $android = "ANDROID_VERSION =";
    $replacer = 'TH12124D3L1M1TOR';
    
    file_put_contents($file,str_replace($logcat,$replacer,file_get_contents($file)));
    file_put_contents($file,str_replace($app_version,$replacer,file_get_contents($file)));
    file_put_contents($file,str_replace($phone,$replacer,file_get_contents($file)));
    file_put_contents($file,str_replace($android,$replacer,file_get_contents($file)));
        
    echo $file , " Completed";
}
?>
