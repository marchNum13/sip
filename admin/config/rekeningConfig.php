<?php  
// check login status
if($_SESSION['login_admin_sip'] != true){
    header('Location: index');
    exit();
}

include "database/connMySQLClass.php";
include "database/adminBankTableClass.php";

$adminBankTableClass = new adminBankTableClass();

$dataBank = dataBank();
$namaPemilik = $dataBank['nama'];
$bank = $dataBank['bank'];
$noRek = $dataBank['rek'];

$alertError = "";

if(isset($_POST['submitData'])){
    $namaPemilik = trim(htmlspecialchars($_POST['namaPemilik']));
    $bank = trim(htmlspecialchars($_POST['bank']));
    $noRek = trim(htmlspecialchars($_POST['noRek']));

    if($namaPemilik == "" || $bank == "" || $noRek == ""){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        $updateRek = $adminBankTableClass->updateAdminBank(
            dataSet: "atas_nama = '$namaPemilik', nama_bank = '$bank', no_rek = '$noRek'",
            key: "1 LIMIT 1"
        );
        if($updateRek){
            sleep(2);
            $_SESSION["alertSuccess"] = "Data berhasil diubah";
            header('Location: rekening');
            exit();
        }
    }
}

function dataBank(){
    global $adminBankTableClass;

    $getBank = $adminBankTableClass->selectAdminBank(
        fields: "atas_nama, nama_bank, no_rek",
        key: "1 LIMIT 1"
    )['data'][0];

    return [
        "nama" => $getBank['atas_nama'],
        "bank" => $getBank['nama_bank'],
        "rek" => $getBank['no_rek']
    ];
}