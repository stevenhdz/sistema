<?php

$db = new mysqli("localhost","prueba","hacker2012.L","chat");

if($db->connect_error){
    die("Connection failed " . $db->connect_error);
}

$result = array();
$message = isset($_POST['message']) ? $_POST['message'] : null;
$from = isset($_POST['from']) ? $_POST['from'] : null;
$image = isset($_POST['image']) ? $_POST['image'] : null;

if(!empty($message) && !empty($from) && !empty($image)){
    $sql = "INSERT INTO `chat` (`message`,`from`,`image`) VALUES ('".$message."','".$from."','".$image."')";
    $result['send_status'] = $db->query($sql);
}

//TODO: imprimir mensajes
$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
$items = $db->query("SELECT * FROM `chat` WHERE `id` > ".$start);

while($row = $items->fetch_assoc()){
    $result['items'][]=$row;
}

$db->close();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

echo json_encode($result);

?>