<?php
// check that all POST variables have been set
if(!isset($_POST['method']) || !$method = $_POST['method']) exit;
if(!isset($_POST['value']) || !$value = $_POST['value']) exit;
if(!isset($_POST['target']) || !$target = $_POST['target']) exit;

if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $value)){
    $passed = true;
    if($_COOKIE['language'] === 'Deutsch'){
        $retval = 'Diese Email hat ein korrektes Format';
    }
    else {
        $retval = ' valid email';
    }
}
else {
    $passed = false;
    if($_COOKIE['language'] === 'Deutsch'){
        $retval = 'Diese Email ist ungültig';
    }
    else {
        $retval = 'invalid email';
    }
}

include "xmlResponse.php";
$xml = new xmlResponse();
$xml->start();

// set the response text
$xml->command('setcontent',
    array('target' => "rsp_$target", 'content' => htmlentities($retval))
);

if($passed) {
    // set the message colour to green

    $xml->command('setstyle',
        array('target' => "rsp_$target", 'property' => 'color', 'value' => 'green')
    );


} else {
    // set the message colour to red and focus back on the field

    $xml->command('setstyle',
        array('target' => "rsp_$target", 'property' => 'color', 'value' => 'red')
    );

    $xml->command('focus', array('target' => $target));

}

$xml->end();
?>