<?php

include_once '../config/config.php';

function update($conn, string $klub, int $golMenang = 0, int $golKalah = 0): bool{
    $main = 1;
    $menang = 0;
    $seri = 0;
    $kalah = 0;
    $point = 0;

    if($golMenang > $golKalah){
        $menang++;
        $point += 3;
    }elseif($golMenang < $golKalah){
        $kalah++;
    }else{
        $seri++;
        $point++;
    }

    $update = $conn->prepare("UPDATE klasemen SET gm = gm + ?, gk = gk + ?, s = s + ?, ma = ma + ?, me = me + ?, k = k + ?, point = point + ? WHERE klub = ?");
    $update->bindParam(1, $golMenang);
    $update->bindParam(2, $golKalah);
    $update->bindParam(3, $seri);
    $update->bindParam(4, $main);
    $update->bindParam(5, $menang);
    $update->bindParam(6, $kalah);
    $update->bindParam(7, $point);
    $update->bindParam(8, $klub);
    $update->execute();
    $update = null;
    return true;
}