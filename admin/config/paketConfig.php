<?php  
// check login status
if($_SESSION['login_admin_sip'] != true){
    header('Location: index');
    exit();
}

include "database/connMySQLClass.php";
include "database/packageTableClass.php";

$packageTableClass = new packageTableClass();

$dataPackage = dataPackage();
$namePackage = [];
$feePackage = [];
foreach($dataPackage as $pack){
    $namePackage[] = $pack['name'];
    $feePackage[] = $pack['fee'];
}
$alertError = "";
if(isset($_POST['submitData'])){
    $feePackage = $_POST['package'];
    $empty = 0;
    foreach($feePackage as $row){
        if($row == "" || $row == 0){
            ++$empty;
        }
    }
    if($empty > 0){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        foreach($namePackage as $key => $pack){
            $fee = $feePackage[$key];

            $updatePackage = $packageTableClass->updatePackage(
                dataSet: "fee = '$fee'",
                key: "name = '$pack'"
            );
        }
        
        sleep(2);
        $_SESSION["alertSuccess"] = "Data berhasil diubah";
        header('Location: paket');
        exit();
    }
}

function dataPackage(){
    global $packageTableClass;

    $getPackage = $packageTableClass->selectPackage(
        fields: "name, fee",
        key: "1 ORDER BY id ASC"
    )['data'];

    return $getPackage;
}