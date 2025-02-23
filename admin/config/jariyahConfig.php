<?php  
// check login status
if($_SESSION['login_admin_sip'] != true){
    header('Location: index');
    exit();
}

include "database/connMySQLClass.php";
include "database/jariyahTableClass.php";

$jariyahTableClass = new jariyahTableClass();

$dataJariyah = dataJariyah();
$lvlBonus = [];
$rewardLvl = [];
foreach($dataJariyah as $jariyah){
    $lvlBonus[] = $jariyah['lvl'];
    $rewardLvl[] = $jariyah['reward'];
}

$alertError = "";
if(isset($_POST['submitData'])){
    $rewardLvl = $_POST['reward'];
    $empty = 0;
    foreach($rewardLvl as $row){
        if($row == "" || $row == 0){
            ++$empty;
        }
    }
    if($empty > 0){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        foreach($lvlBonus as $key => $lvl){
            $fee = $rewardLvl[$key];

            $updateJariyah = $jariyahTableClass->updateJariyah(
                dataSet: "reward = '$fee'",
                key: "lvl = '$lvl'"
            );
        }
        
        sleep(2);
        $_SESSION["alertSuccess"] = "Data berhasil diubah";
        header('Location: jariyah');
        exit();
    }
}

function dataJariyah(){
    global $jariyahTableClass;

    $getJariyah = $jariyahTableClass->selectJariyah(
        fields: "lvl, reward",
        key: "1 ORDER BY id ASC"
    )['data'];

    return $getJariyah;
}