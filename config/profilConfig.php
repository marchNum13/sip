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
$username = $dataLogin['username'];
$email = $dataLogin['email'];
$fullname = $dataLogin['full_name'];
$wa = $dataLogin['number_whatsapp'];

$alertError = "";

if(isset($_POST['submitData'])){
    $idUser = $_SESSION["id_user"];

    $username = trim(htmlspecialchars($_POST['username']));
    $email = trim(htmlspecialchars($_POST['email']));
    $fullname = trim(htmlspecialchars($_POST['fullname']));
    $wa = formatNumber(trim(htmlspecialchars($_POST['wa'])));

    if($username == "" || $email == "" || $fullname == "" || $wa == ""){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        if(!validasiEmail($email)){
            sleep(2);
            $alertError = "Alamat email tidak valid";
        }else{
            if(!validasiUsername($username)){
                sleep(2);
                $alertError = "Username tidak valid";
            }else{
                $checkUsername = $userTableClass->selectUser(
                    fields: "username",
                    key: "id_user <> '$idUser' AND username = '$username'"
                );
                if($checkUsername['row'] > 0){
                    sleep(2);
                    $alertError = "Username sudah terdaftar!";
                }else{
                    $checkEmail = $userTableClass->selectUser(
                        fields: "email",
                        key: "id_user <> '$idUser' AND email = '$email'"
                    );
                    if($checkEmail['row'] > 0){
                        sleep(2);
                        $alertError = "Email sudah terdaftar!";
                    }else{
                        $updateUser = $userTableClass->updateUser(
                            dataSet: "username = '$username', email = '$email'",
                            key: "id_user = '$idUser'"
                        );
                        if($updateUser){
                            $updateProfile = $profileUserTableClass->updateProfileUser(
                                dataSet: "full_name = '$fullname', number_whatsapp = '$wa'",
                                key: "id_user = '$idUser'"
                            );
                            if($updateProfile){
                                sleep(2);
                                $_SESSION["alertSuccess"] = "Data berhasil diubah";
                                header('Location: profil');
                                exit();
                            }
                        }
                    }
                }
            }
        }
    }
}

function validasiEmail($email) {
    // Gunakan filter_var untuk memvalidasi email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true; // Format email valid
    } else {
        return false; // Format email tidak valid
    }
}

function validasiUsername($username) {
    // Periksa apakah username hanya mengandung huruf kecil dan angka tanpa spasi
    if (preg_match('/^[a-z0-9]+$/', $username)) {
        return true; // Valid
    }
    return false; // Tidak valid
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

function formatNumber($number){
    if (preg_match('/^(62|0)/', $number)) {
        $number = preg_replace('/^(62|0)/', '', $number);
    }
    return $number;
}