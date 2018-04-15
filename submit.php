<?php

date_default_timezone_set('America/Chicago');

function unserializeForm($str) {
    $strArray = explode("&", $str);
    foreach($strArray as $item) {
        $array = explode("=", $item);
        $returndata[] = $array;
    }
    return $returndata;
}

$string = '<p><strong>' . $_POST['instructor'] . '</strong> demonstrated the following <strong>' . $_POST['quadrant'] . '</strong> points on ' . $today = date("D F j, Y, g:i a") . ':';
$string .= '<ul>';
foreach(unserializeForm($_POST['grade']) as $point){
    $point[1] = str_replace('%20', ' ', $point[1]);
    $point[1] = str_replace('%2C', ',', $point[1]);
    $string .= '<li>' . $point[1] . '</li>';
}
$string .= '</ul>';

//$to  = 'polarismartialarts@gmail.com';
$to = 'daniel@danieltclancy.com';

$subject = 'Someone had graded an instructor!';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'To: Polaris Martial Arts <daniel@danieltclancy.com>' . "\r\n";
$headers .= 'From: Instructor Accountability App <noreply@danieltclancy.com' . "\r\n";

mail($to, $subject, $string, $headers);
//echo $string;



?>