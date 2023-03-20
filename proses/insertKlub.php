<?php

include_once '../config/config.php';

$namaKlub = validation(ucfirst($_POST['klub']));
$kotaKlub = validation(ucfirst($_POST['kota']));
$response = [];

// mengecek apakah form kosong
if(empty($namaKlub)){
    header('Content-Type: application/json');
    http_response_code(400);
    $response = [
        'message' => 'Form tidak boleh kosong!'
    ];
    echo json_encode($response);
}

// mengecek apakah data sama
$row = $conn->prepare("SELECT * FROM klub WHERE nama = '$namaKlub'");
$row->execute();
if($row->rowCount()){
    header('Content-Type: application/json');
    http_response_code(400);
    $response = [
        'status' => false,
        'message' => 'Data tidak boleh sama!'
    ];
    echo json_encode($response);
}else{
    $insert = $conn->prepare("INSERT INTO klub (nama, kota) VALUES('$namaKlub', '$kotaKlub')");
    $insert->execute();
    $insert = $conn->prepare("INSERT INTO klasemen (klub) VALUES('$namaKlub')");
    $insert->execute();
    header('Content-Type: application/json');
    $response = [
        'status' => true,
        'message' => 'Data berhasil ditambahkan!'
    ];
    echo json_encode($response);
}


function validation($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}