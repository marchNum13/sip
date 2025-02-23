<?php  
// check login status
if($_SESSION['login_sip'] != true){
    header('Location: index');
    exit();
}
include "admin/database/connMySQLClass.php";
include "admin/database/userTableClass.php";
include "admin/database/profileUserTableClass.php";
include "admin/database/userBankTableClass.php";

$userTableClass = new userTableClass();
$profileUserTableClass = new profileUserTableClass();
$userBankTableClass = new userBankTableClass();

$dataLogin = dataLogin();

$dataBank = dataBank();
$namaPemilik = $dataBank['nama'];
$bank = $dataBank['bank'];
$noRek = $dataBank['rek'];

if(isset($_POST['submitData'])){
    $idUser = $_SESSION["id_user"];

    $namaPemilik = trim(htmlspecialchars($_POST['namaPemilik']));
    $bank = trim(htmlspecialchars($_POST['bank']));
    $noRek = trim(htmlspecialchars($_POST['noRek']));

    if($namaPemilik == "" || $bank == "" || $noRek == ""){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        $updateRek = $userBankTableClass->updateUserBank(
            dataSet: "atas_nama = '$namaPemilik', nama_bank = '$bank', no_rek = '$noRek'",
            key: "id_user = '$idUser'"
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
    global $userBankTableClass;

    $idUser = $_SESSION["id_user"];

    $getBank = $userBankTableClass->selectUserBank(
        fields: "atas_nama, nama_bank, no_rek",
        key: "id_user = '$idUser'"
    )['data'][0];

    return [
        "nama" => $getBank['atas_nama'],
        "bank" => $getBank['nama_bank'],
        "rek" => $getBank['no_rek']
    ];
}

function dataLogin(){
    global $userTableClass;
    global $profileUserTableClass;

    $idUser = $_SESSION["id_user"];

    $getUser = $userTableClass->selectUser(
        fields: "username, email, package",
        key: "id_user = '$idUser'"
    )['data'][0];

    $getProfile = $profileUserTableClass->selectProfileUser(
        fields: "full_name, number_whatsapp",
        key: "id_user = '$idUser'"
    )['data'][0];

    return [
        "username" => $getUser['username'],
        "email" => $getUser['email'],
        "package" => $getUser['package'],
        "full_name" => $getProfile['full_name'],
        "number_whatsapp" => $getProfile['number_whatsapp'],
    ];
}

function sensorEmail($email) {
    // Pecah email menjadi bagian nama pengguna dan domain
    list($username, $domain) = explode('@', $email);
    
    $panjangUsername = strlen($username);
    $jumlahSensor = ceil($panjangUsername * 0.6); // 60% panjang username akan disensor
    $jumlahAwal = floor(($panjangUsername - $jumlahSensor) / 2); // Bagian awal yang tidak disensor
    $jumlahAkhir = $panjangUsername - $jumlahSensor - $jumlahAwal; // Bagian akhir yang tidak disensor

    // Buat username yang disensor
    $usernameSensor = substr($username, 0, $jumlahAwal)
                     . "****"
                     . substr($username, -$jumlahAkhir);

    // Gabungkan kembali dengan domain
    return $usernameSensor . '@' . $domain;
}