<?php  
// check login status
if($_SESSION['login_admin_sip'] != true){
    header('Location: index');
    exit();
}

include "database/connMySQLClass.php";
include "database/rewardTableClass.php";

$rewardTableClass = new rewardTableClass();
$dataPoin = dataPoin();
$poinJum = [];
$rewardPoin = [];
$deskPoin = [];
foreach($dataPoin as $poin){
    $poinJum[] = $poin['poin'];
    $rewardPoin[] = $poin['reward'];
    $deskPoin[] = $poin['desk'];
}

$alertError = "";
if(isset($_POST['submitData'])){
    $rewardPoin = $_POST['reward'];
    $deskPoin = $_POST['ket'];
    $empty = 0;
    foreach($rewardPoin as $key => $row){
        if(($row == "" || $row == 0) || $deskPoin[$key] == ""){
            ++$empty;
        }
    }
    if($empty > 0){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        foreach($poinJum as $key => $jumpoin){
            $fee = $rewardPoin[$key];
            $desk = $deskPoin[$key];

            $update = $rewardTableClass->updateReward(
                dataSet: "reward = '$fee', desk = '$desk'",
                key: "poin = '$jumpoin'"
            );
        }
        
        sleep(2);
        $_SESSION["alertSuccess"] = "Data berhasil diubah";
        header('Location: poin');
        exit();
    }
}

function dataPoin(){
    global $rewardTableClass;

    $getPoin = $rewardTableClass->selectReward(
        fields: "poin, reward, desk",
        key: "1 ORDER BY id ASC"
    )['data'];

    return $getPoin;
}

