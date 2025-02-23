<?php  
// check login status
if($_SESSION['login_sip'] != true){
    header('Location: index');
    exit();
}
include "admin/database/connMySQLClass.php";
include "admin/database/userTableClass.php";
include "admin/database/profileUserTableClass.php";

$userTableClass = new userTableClass();
$profileUserTableClass = new profileUserTableClass();

$dataLogin = dataLogin();

$alertError = "";

if(isset($_POST['submitData'])){
    $idUser = $_SESSION["id_user"];

    $password = trim(htmlspecialchars($_POST['password']));
    $passwordBaru = trim(htmlspecialchars($_POST['passwordBaru']));
    $passwordKonfir = trim(htmlspecialchars($_POST['passwordKonfir']));

    if($password == "" || $passwordBaru == "" || $passwordKonfir == ""){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        $passHash = $dataLogin['password'];
        if(!password_verify($password, $passHash)){
            sleep(2);
            $alertError = "Password anda salah";
        }else{
            if($passwordBaru != $passwordKonfir){
                sleep(2);
                $alertError = "Password tidak sesuai";
            }else{
                $passToHash = password_hash($passwordBaru, PASSWORD_DEFAULT);
                $updatePass = $userTableClass->updateUser(
                    dataSet: "password = '$passToHash'",
                    key: "id_user = '$idUser'"
                );
                if($updatePass){
                    sleep(2);
                    $_SESSION["alertSuccess"] = "Data berhasil diubah";
                    header('Location: ubah-password');
                    exit();
                }
            }
        }
    }
}

function dataLogin(){
    global $userTableClass;
    global $profileUserTableClass;

    $idUser = $_SESSION["id_user"];

    $getUser = $userTableClass->selectUser(
        fields: "username, email, password, package",
        key: "id_user = '$idUser'"
    )['data'][0];

    $getProfile = $profileUserTableClass->selectProfileUser(
        fields: "full_name, number_whatsapp",
        key: "id_user = '$idUser'"
    )['data'][0];

    return [
        "username" => $getUser['username'],
        "email" => $getUser['email'],
        "password" => $getUser['password'],
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