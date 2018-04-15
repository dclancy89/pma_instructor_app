<?php
//Pulls the data from db and returns it via JSON



$mysqli = new mysqli($server, $username, $password, $database);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

}


/************** INSTRUCTOR DATA **************/

$result = $mysqli->query("SELECT instructor_name, instructor_level FROM instructors");



$instructors = array();
while($row = $result->fetch_assoc()) {
    
    $instructors[] = $row;
}


$instructors = json_encode($instructors);


/************** END INSTRUCTOR DATA **************/


/************************************* LEGACY DATA *************************************/

/************** EMOTION DATA **************/

$result = $mysqli->query("SELECT * FROM legacy_content WHERE quadrant = 'emotion'");



$emotion = array();
$i = 0;
while($row = $result->fetch_assoc()) {
    $emotion[$i]["content_id"] = $row["content_id"];
    $emotion[$i]["quadrant"] = $row["quadrant"];
    $emotion[$i]["point_number"] = $row["point_number"];
    $emotion[$i]["instructor_point"] = $row["instructor_point"];
    $emotion[$i]["description"] = $row["description"];
    $i++;
}

$emotion = json_encode($emotion);

/************** END EMOTION DATA **************/


/************** STRUCTURE DATA **************/

$result = $mysqli->query("SELECT * FROM legacy_content WHERE quadrant = 'knowledge'");

//var_dump($result->fetch_assoc());


$knowledge = array();
$i = 0;
while($row = $result->fetch_assoc()) {
    $knowledge[$i]["content_id"] = $row["content_id"];
    $knowledge[$i]["quadrant"] = $row["quadrant"];
    $knowledge[$i]["point_number"] = $row["point_number"];
    $knowledge[$i]["instructor_point"] = $row["instructor_point"];
    // $knowledge[$i]["description"] = mysqli_real_escape_string($mysqli, $row["description"]);
    $knowledge[$i]["description"] = $row["description"];
    $i++;
}
//var_dump($knowledge);
$knowledge = json_encode($knowledge);


/************** END STRUCTURE DATA **************/

/************************************* END LEGACY DATA *************************************/







$output = '{"instructors": ' . $instructors . ',';
$output .= '"emotion": ' . $emotion . ',';
$output .= '"knowledge": ' . $knowledge . '}';

echo($output);

?>