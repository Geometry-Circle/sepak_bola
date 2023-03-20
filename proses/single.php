<?php

include_once '../config/config.php';
include_once '../helper/helpers.php';

$klub1 = [
    'nama' => validation(ucfirst($_POST['klub1'])),
    'gm' => $_POST['skor1'],
    'gk' => $_POST['skor2']
];

$klub2 = [
    'nama' => validation(ucfirst($_POST['klub2'])),
    'gm' => $_POST['skor2'],
    'gk' => $_POST['skor1']
];

$response = [];

// mengecek apakah form kosong
if (empty($klub1['nama']) || empty($klub2['nama'])) {
    header('Content-Type: application/json');
    http_response_code(400);
    $response = [
        'status' => false,
        'message' => 'Form tidak boleh kosong!'
    ];
    echo json_encode($response);
    exit();
}

// mengecek apakah form kosong
if ($klub1['nama'] == $klub2['nama']) {
    header('Content-Type: application/json');
    http_response_code(400);
    $response = [
        'status' => false,
        'message' => 'Data tidak boleh sama!'
    ];
    echo json_encode($response);
    exit();
}

$existDataKlub1 = $conn->prepare("SELECT * FROM klub WHERE nama = '{$klub1['nama']}'");
$existDataKlub1->execute();
$existDataKlub2 = $conn->prepare("SELECT * FROM klub WHERE nama = '{$klub2['nama']}'");
$existDataKlub2->execute();

// mengecek apakah data klub tersedia
if($existDataKlub1->rowCount() == 0 || $existDataKlub2->rowCount() == 0){
    header('Content-Type: application/json');
    http_response_code(400);
    $response = [
        'status' => false,
        'message' => 'Data klub tidak tersedia!'
    ];
    echo json_encode($response);
    exit();
}

if(update($conn, $klub1['nama'], $klub1['gm'], $klub1['gk']) && update($conn, $klub2['nama'], $klub2['gm'], $klub2['gk'])) {
    header('Content-Type: application/json');
    $response = [
        'status' => true,
        'message' => 'Data berhasil ditambahkan!'
    ];
    echo json_encode($response);
}

function validation($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}