# The-Simplest-ACRA-PHP-SQL-Backend

# Setup:

## Server side:

For full functionality, you need a PHP MySQL server. Because of the simplicify of all this you can use webhosts like one.com. We're using 
that and we cannot use any other backends because of the complexity(of the other backends). (NOTE: No SQL database is needed. Do not use 
index.php or tosql.php in
errors/ if you do not have a database)

Once you have the requirements above, simply add the files to your website. Nothing else is required all though we recommend adding 
password protection in the errors folder. If you protect report.php you will need a password in the Java class.

If you are not using one.com, do not use the long link, in .htaccess instead say(if it is in the same folder): .htpasswd

## Client side:

In the ACRA class that extends Application:

    @ReportsCrashes(

        formUri = "..../report.php",//Non-password protected.
        customReportContent = { /* */ReportField.APP_VERSION_NAME, ReportField.PACKAGE_NAME,ReportField.ANDROID_VERSION,
        ReportField.PHONE_MODEL,ReportField.LOGCAT },
        mode = ReportingInteractionMode.TOAST,
        resToastText = R.string.crash_toast_text

    )

Permissions required in your app:

    <uses-permission android:name="android.permission.INTERNET" /><br>
    <uses-permission android:name="android.permission.READ_LOGS"/>

If you want to use other fields in the custom report content remember to add the fields in the database and you also have to customize
the tosql class. Changing content changes the order of the content. 

For the setup of ACRA, <a href="https://github.com/ACRA/acra/wiki/BasicSetup">see this link</a>.


# Using it:

Link to the file called "report.php" in the first directory in your java file.
Edit the file with your email(if you want to recieve emails) and set the boolean to "true".

You will only recieve mails if the directory is empty. Which means you will only be informed about new crashes since you emptied the logs folder.
SQL is required.

When you are on your computer open crash/tosql.php. This file will transfer all .txt files in logs to the SQL database.

Remember, for 100% functionality, name the table 'exceptions'. It relies on that being the name. There is no install.php because we aimed for functionality durring use than useless space to a file used **once**

In index.php and tosql.php, remember to add:
* Database name
* Database host
* Database username
* Database password
 
And finally, there now are issue ID's which means reports will merge together of the content is the same

## Proguard:

If your app is using Proguard, no need to worry! We have tested our app with release and Proguard activated and it works. The file is not 
scrabled and the StackTrace is accurate to the error we caused. We have been testing with a crash we have been triggering ourselves and 
the Stacktrace matches the one of a non-scrambled text file(in terms of the error and location of the error. Times are not the same. 
StackTrace may change from error to error but the error pinpointing is the same.)

So you can both have ACRA and Proguard with this backend!


## IMPORTANT!

Some places the table is set fixed to 'exceptions', for an instance in the tosql file there is a method that converts all the strings to 
SQL insert command. That is why it is a good idea to call the table exceptions. Here is the fields.(NOTE: All should have utf8_general_ci.
The package field is set to latin1_swedish_ci by default for some reason. utf8_general_ci is the correct to use.)

<img src="http://gamers-cave-world.com/publicimg/tables.png"></img>


**NOTE!**
<br>This project uses MySQL which means your PHP version has to be 5.6 or lower. PHP 7 removes MySQL functions from it making this 
software useless. Avoid PHP 7 if you are to use this project. However, we are working on either creating a secondary project in which we 
upload MySQLi or remove MySQL from this project. MySQLi project is created successfully on our website and is now going through bug checks


# Features:

* Simple setup
* Easy to use
* You can manually transfer all .txt files into an sql database
* You can view all the entries in the SQL database.
* You can view all .txt files without entering them into the SQL database(very important if your server does not support MySQL.
* If your website does not have databases, remove the database dependant files in errors/


# Notes:

No .htaccess or .htpasswd is created. Create them yourself.

A good idea is to **not** password protect 'submit.php' as that would require you to add password and username in the Java code. Java code 
isn't really that save, even inside the APK. There are multiple ways to break into the APK source code and see it and then your password 
and username would be out in the open. And passwords and username can be exploited.


This project is licenced under Creative Commons 4.0 Attribution Licence.
Feel free to support the project by adding design or improving the PHP code. Keep the links in a simple format so they don't screw up the 
code.

So this is the simplest PHP SQL backend there is. We can say that on accounts of the few lines of code, the simple install(which really is
just to add the files to your website). Remember to create the table 'exceptions'!!

P.S: If we forgot something, open an issue and we will answer and add it to this file.

ENJOY!
Gamers Cave
