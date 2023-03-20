<?php

include_once '../config/config.php';
include_once '../helper/helpers.php';

$klub1 = [
    'nama' => [],
    'ma' => 1,
    'gm' => $_POST['skor1'],
    'gk' => $_POST['skor2'],
    'me' => 0,
    's' => 0,
    'k' => 0
];

$klub2 = [
    'nama' => [],
    'ma' => 1,
    'gm' => $_POST['skor2'],
    'gk' => $_POST['skor1'],
    'me' => 0,
    's' => 0,
    'k' => 0
];

// validasi data klub 1
foreach ($_POST['klub1'] as $value) {
    $data = validation($value);
    array_push($klub1['nama'], $data);
}

// validasi data klub 2
foreach ($_POST['klub2'] as $value) {
    $data = validation($value);
    array_push($klub2['nama'], $data);
}

// mengecek apakah ada data yang sama antara klub 1 dan klub 2
if (array_intersect($klub1['nama'], $klub2['nama'])) {
    header('Content-Type: application/json');
    http_response_code(400);
    $response = [
        'status' => false,
        'message' => 'Data tidak boleh sama!'
    ];
    echo json_encode($response);
    exit();
}

// mengecek apakah ada value duplikat antara klub 1 atau klub 2
if (count($klub1['nama']) > count(array_unique($klub1['nama'])) || count($klub2['nama']) > count(array_unique($klub2['nama']))) {
    header('Content-Type: application/json');
    http_response_code(400);
    $response = [
        'status' => false,
        'message' => 'Data tidak boleh sama!'
    ];
    echo json_encode($response);
    exit();
}

foreach ($klub1['nama'] as $index => $values) {
    update($conn, $klub1['nama'][$index], $klub1['gm'][$index], $klub1['gk'][$index]);
    update($conn, $klub2['nama'][$index], $klub2['gm'][$index], $klub2['gk'][$index]);
}

header('Content-Type: application/json');
$response = [
    'status' => true,
    'message' => 'Data berhasil ditambahkan!'
];
echo json_encode($response);

function validation($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}