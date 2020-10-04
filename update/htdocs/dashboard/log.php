<?php
date_default_timezone_set('PH/Manila ');
//A PHP array containing the data that we want to log.
$dataToLog = array(
    date("Y-m-d h:i A"), //Date and time
    $_SERVER['REMOTE_ADDR'], //IP address
    'Clicked on item 4', //Custom text
    'Date is <br>' //More custom text
);
 
//Turn array into a delimited string using
//the implode function
$data = implode(" - ", $dataToLog);
 
//Add a newline onto the end.
$data .= PHP_EOL;
 
//The name of your log file.
//Modify this and add a full path if you want to log it in 
//a specific directory.
$pathToFile = 'mylogname.log';
 
//Log the data to your file using file_put_contents.
file_put_contents($pathToFile, $data, FILE_APPEND);
?>