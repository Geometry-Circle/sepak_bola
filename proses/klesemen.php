<?php

include_once '../config/config.php';

$data = $conn->prepare("SELECT * FROM klasemen");
$data->execute();
$results = $data->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($results);
header('Content-Type: application/json');
echo $json;