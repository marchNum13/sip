<?php  
// check login status
if($_SESSION['login_admin_sip'] != true){
    header('Location: index');
    exit();
}

include "database/connMySQLClass.php";
include "database/ujrohTableClass.php";

$ujrohTableClass = new ujrohTableClass();

$dataUjroh = dataUjroh();
$namePackage = [];
$rewardPackage = [];
foreach($dataUjroh as $ujroh){
    $namePackage[] = $ujroh['name_package'];
    $rewardPackage[] = $ujroh['reward'];
}

$alertError = "";
if(isset($_POST['submitData'])){
    $rewardPackage = $_POST['rewardRekrut'];
    $empty = 0;
    foreach($rewardPackage as $row){
        if($row == "" || $row == 0){
            ++$empty;
        }
    }
    if($empty > 0){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        foreach($namePackage as $key => $pack){
            $fee = $rewardPackage[$key];

            $updateUjroh = $ujrohTableClass->updateUjroh(
                dataSet: "reward = '$fee'",
                key: "name_package = '$pack'"
            );
        }
        
        sleep(2);
        $_SESSION["alertSuccess"] = "Data berhasil diubah";
        header('Location: ujroh');
        exit();
    }
}

function dataUjroh(){
    global $ujrohTableClass;

    $getUjroh = $ujrohTableClass->selectUjroh(
        fields: "name_package, reward",
        key: "1 ORDER BY id ASC"
    )['data'];

    return $getUjroh;
}
