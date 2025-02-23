<?php  
// check login status
if($_SESSION['login_sip'] != true){
    header('Location: index');
    exit();
}
include "admin/database/connMySQLClass.php";
include "admin/database/userTableClass.php";
include "admin/database/profileUserTableClass.php";
include "admin/database/packageTableClass.php";
include "admin/database/adminBankTableClass.php";
include "admin/database/userBankTableClass.php";
include "admin/database/pinTableClass.php";
include "admin/database/ujrohTableClass.php";
include "admin/database/jariyahTableClass.php";
include "admin/database/reportBonusesUjrohTableClass.php";
include "admin/database/reportBonusesJariyahTableClass.php";
include "admin/database/reportPoinTableClass.php";
include "admin/database/voucherTableClass.php";

$userTableClass = new userTableClass();
$profileUserTableClass = new profileUserTableClass();
$packageTableClass = new packageTableClass();
$adminBankTableClass = new adminBankTableClass();
$userBankTableClass = new userBankTableClass();
$pinTableClass = new pinTableClass();
$ujrohTableClass = new ujrohTableClass();
$jariyahTableClass = new jariyahTableClass();
$reportBonusesUjrohTableClass = new reportBonusesUjrohTableClass();
$reportBonusesJariyahTableClass = new reportBonusesJariyahTableClass();
$reportPoinTableClass = new reportPoinTableClass();
$voucherTableClass = new voucherTableClass();

$dataLogin = dataLogin();

$dateNowMilis = round(microtime(true) * 1000);
$idUpline = isset($_GET['upline']) ? $_GET['upline'] : $_SESSION["id_user"];
$dataTable = dataTable();
$lvlJaringan = isset($_GET['level']) ? $_GET['level'] : 1;
$pass = "SIP2025";
$alertError = "";

if(isset($_POST['cari'])){
    $usernameEmailFilter = trim(htmlspecialchars($_POST['usernameEmailFilter']));

    $checkUserFilter = $userTableClass->selectUser(fields: "id_user", key: "username = '$usernameEmailFilter' OR email = '$usernameEmailFilter'");
    if($checkUserFilter['row'] == 0){
        sleep(2);
        $alertError = "Data tidak ditemukan atau berada pada jaringan lain!";
    }else{
        $uplineFilter = $checkUserFilter['data'][0]['id_user'];
        if(!isMyJaringan($uplineFilter)){
            sleep(2);
            $alertError = "Data tidak ditemukan atau berada pada jaringan lain!";
        }else{
            $lvlFilter = calculateShaf($uplineFilter);
            header("Location: jaringan?level=$lvlFilter&upline=$uplineFilter");
            exit;
        }
    }
}

function calculateShaf($upline, $lvl = 1){
    $idUser = $_SESSION["id_user"];

    if($upline == $idUser){
        return $lvl;
    }else{
        global $userTableClass; 
        $getUpline = $userTableClass->selectUser(
            fields: "upline",
            key: "id_user = '$upline'"
        );
        $upline = $getUpline['data'][0]['upline'];
        return calculateShaf($upline, $lvl+1);
    }
}

if(isset($_POST['submitData'])){
    $idUser = $_SESSION["id_user"];

    $paket = trim(htmlspecialchars($_POST['paket']));
    $codePIN = trim(htmlspecialchars($_POST['codePIN']));
    $fullname = trim(htmlspecialchars($_POST['fullname']));
    $wa = formatNumber(trim(htmlspecialchars($_POST['wa'])));
    $email = trim(htmlspecialchars($_POST['email']));
    $username = trim(htmlspecialchars($_POST['username']));
    $pass = trim(htmlspecialchars($_POST['pass']));

    if(
        $paket == "" ||
        $codePIN == "" ||
        $fullname == "" ||
        $wa == "" ||
        $email == "" ||
        $username == "" ||
        $pass == ""
        
    ){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        $checkPin = $pinTableClass->selectPin(
            fields: "status",
            key: "id_user = '$idUser' AND code_pin = '$codePIN' AND package = '$paket'"
        );
        if($checkPin['row'] == 0){
            sleep(2);
            $alertError = "Kode PIN invalid!";
        }else{
            $statusPIN = $checkPin['data'][0]['status'];
            if($statusPIN == "Terpakai"){
                sleep(2);
                $alertError = "Kode PIN sudah digunakan!";
            }else{
                if(!isMyJaringan($idUpline)){
                    sleep(2);
                    $alertError = "Member ini, berada diluar jaringan anda!";
                }else{
                    if($dataTable['row'] >= 3){
                        sleep(2);
                        $alertError = "Jaringan sudah terisi!";
                    }else{
                        if(!validasiEmail($email)){
                            sleep(2);
                            $alertError = "Alamat email tidak valid";
                        }else{
                            if(!validasiUsername($username)){
                                sleep(2);
                                $alertError = "Username tidak valid";
                            }else{
                                $checkEmail = $userTableClass->selectUser(
                                    fields: "email",
                                    key: "email = '$email' LIMIT 1"
                                );
                                if($checkEmail['row'] > 0){
                                    sleep(2);
                                    $alertError = "Email sudah terdaftar!";
                                }else{
                                    $checkUsername = $userTableClass->selectUser(
                                        fields: "username",
                                        key: "username = '$username' LIMIT 1"
                                    );
                                    if($checkUsername['row'] > 0){
                                        sleep(2);
                                        $alertError = "Username sudah terdaftar!";
                                    }else{
                                        $jumlahUserNow = $dataTable['row'];
                                        $team = "A";
                                        $registMember = true;
                                        if($jumlahUserNow == 2){
                                            $team = "C";
                                        }elseif($jumlahUserNow == 1){
                                            $team = "B";
                                        }elseif($jumlahUserNow >= 3){
                                            $registMember = false;
                                        }
                                        if($registMember){
                                            $newIdUser = generateIDUser();
                                            $passHash = password_hash($pass, PASSWORD_DEFAULT);
                                            $InsertUser = $userTableClass->insertUser(
                                                fields: "
                                                    id_user,
                                                    username,
                                                    email,
                                                    password,
                                                    package,
                                                    team,
                                                    regist_by,
                                                    upline,
                                                    regist_date
                                                ",
                                                value: "
                                                    '$newIdUser',
                                                    '$username',
                                                    '$email',
                                                    '$passHash',
                                                    '$paket',
                                                    '$team',
                                                    '$idUser',
                                                    '$idUpline',
                                                    '$dateNowMilis'
                                                "
                                            );
                                            if($InsertUser){
                                                $inserProfile = $profileUserTableClass->insertProfileUser(
                                                    fields: "
                                                        id_user,
                                                        full_name,
                                                        number_whatsapp
                                                    ",
                                                    value: "
                                                        '$newIdUser',
                                                        '$fullname',
                                                        '$wa'
                                                    "
                                                );
                                                if($inserProfile){
                                                    $insertBank = $userBankTableClass->insertUserBank(
                                                        fields: "id_user",
                                                        value: "'$newIdUser'"
                                                    );
                                                    if($insertBank){
                                                        $updatePin = $pinTableClass->updatePin(
                                                            dataSet: "status = 'Terpakai'",
                                                            key: "id_user = '$idUser' AND code_pin = '$codePIN' AND package = '$paket'"
                                                        );
                                                        if($updatePin){
                                                            // berikan bonus dan potongan automain atau admin
                                                            giftBonusUjroh($newIdUser, $paket, $idUser);

                                                            if($paket != "Basmalah"){
                                                                giftBonusJariyah($newIdUser, "Buy Package", $idUser, 1);
                                                                // pin
                                                                giftPoin($newIdUser, $idUpline, $team);
                                                            }
                                                            
                                                            // vouhcer
                                                            createVoucher($paket, $newIdUser);
                                                            sleep(2);
                                                            $_SESSION["alertSuccess"] = "Data berhasil disimpan!";
                                                            header('Location: jaringan');
                                                            exit();
                                                        }
                                                    }else{
                                                        sleep(2);
                                                        $alertError = "Gagal menyimpan akun bank!";
                                                    }
                                                }else{
                                                    sleep(2);
                                                    $alertError = "Gagal menyimpan profil!";
                                                }
                                            }else{
                                                sleep(2);
                                                $alertError = "Gagal menyimpan data akun!";
                                            }
                                        }else{
                                            sleep(2);
                                            $alertError = "Jaringan sudah terisi!";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

}

function createVoucher($package, $idUser){
    global $voucherTableClass;

    if($package == "Hamdalah"){
        $nominalVoucher = array("5000000", "3000000");
    }elseif($package == "Basmalah"){
        $nominalVoucher = array("3000000");
    }elseif($package == "AutoMain"){
        $nominalVoucher = array("3000000");
    }

    foreach($nominalVoucher as $voucher){
        $code = generateVoucherCode(7);
        $date = round(microtime(true) * 1000);
        $voucherTableClass->insertVoucher(
            fields: "id_user, code, nominal, date_update",
            value: "'$idUser', '$code', '$voucher', '$date'"
        );
    }
}

function generateVoucherCode($length = 7) {
    global $voucherTableClass;
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // Huruf besar dan angka
    $charactersLength = strlen($characters);
    $randomCode = '';

    for ($i = 0; $i < $length; $i++) {
        $randomCode .= $characters[rand(0, $charactersLength - 1)];
    }

    $check = $voucherTableClass->selectVoucher(fields: "code", key: "code = '$randomCode'")['row'];

    if($check > 0){
        return generateVoucherCode(7);
    }else{
        return $randomCode;
    }

}

function giftPoin($downline, $upline, $team){
    if($upline == "admin"){
        return true;
    }else{
        global $userTableClass;
        $selectUpline = $userTableClass->selectUser(
            fields: "upline, team",
            key: "id_user = '$upline'"
        );
        if($selectUpline['row'] == 0){
            return true;
        }else{
            global $reportPoinTableClass;
            $date = round(microtime(true) * 1000);

            $savePoin = $reportPoinTableClass->insertReportPoin(
                fields: "id_user, from_user, total, team, date_poin",
                value: "
                    '$upline',
                    '$downline',
                    '1',
                    '$team',
                    '$date'
                "
            );
            if($savePoin){
                $teams = $selectUpline['data'][0]['team'];
                $uplines = $selectUpline['data'][0]['upline'];

                return giftPoin($downline, $uplines, $teams);
            }
        }
    }
}

function giftBonusUjroh($member, $category, $registBy){
    global $ujrohTableClass;

    $query = "name_package = 'Hamdalah'";
    if($category == "Basmalah"){
        $query = "name_package = 'Basmalah'";
    }
    $getReward = $ujrohTableClass->selectUjroh(fields: "reward", key: "$query")['data'][0]['reward'];

    global $reportBonusesUjrohTableClass;
    $date = round(microtime(true) * 1000);
    $saveReport = $reportBonusesUjrohTableClass->insertReportUjroh(
        fields: "id_user_recruiter, id_user_recruited, category, reward, date",
        value: "
            '$registBy',
            '$member',
            '$category',
            '$getReward',
            '$date'
        "
    );
    if($saveReport){
        // JANGAN LUPA BAGI SALDO AUTO MAIN DAN ADMIN
        return true;
    }
}

function giftBonusJariyah($downline, $category, $registBy, $lvl){
    if($registBy == "admin" || $lvl >= 16){
        return true;
    }else{
        global $userTableClass;
        $selectUpline = $userTableClass->selectUser(
            fields: "regist_by, package",
            key: "id_user = '$registBy'"
        );
        if($selectUpline['row'] == 0){
            return true;
        }else{
            $package = $selectUpline['data'][0]['package'];
            $regist_by = $selectUpline['data'][0]['regist_by'];
            if($package == "Basmalah"){
                return giftBonusJariyah($downline, $category, $regist_by, $lvl+1);
            }else{
                global $jariyahTableClass;
                $getReward = $jariyahTableClass->selectJariyah(
                    fields: "reward", key: "lvl = '$lvl'"
                )['data'][0]['reward'];

                global $reportBonusesJariyahTableClass;
                $date = round(microtime(true) * 1000);
                $saveReport = $reportBonusesJariyahTableClass->insertReportJariyah(
                    fields: "
                        id_user_upline,
                        id_user_dowline,
                        lvl,
                        category,
                        reward,
                        date
                    ",
                    value: "
                        '$registBy',
                        '$downline',
                        '$lvl',
                        '$category',
                        '$getReward',
                        '$date'
                    "
                );
                if($saveReport){
                    // JANGAN LUPA BAGI SALDO AUTO MAIN DAN ADMIN
                    return giftBonusJariyah($downline, $category, $regist_by, $lvl+1);
                }else{
                    return true;
                }
            }
        }
    }
}

function isMyJaringan($upline){
    $idUser = $_SESSION["id_user"];

    if($upline == $idUser){
        return true;
    }else{
        if($upline == "admin"){
            return false;
        }else{
            global $userTableClass; 
            $getUpline = $userTableClass->selectUser(
                fields: "upline",
                key: "id_user = '$upline'"
            );
            if($getUpline['row'] > 0){
                $upline = $getUpline['data'][0]['upline'];
                return isMyJaringan($upline);
            }else{
                return false;
            }
        }
    }
}

function generateIDUser(){
    global $userTableClass;
    $id = substr(md5(uniqid(rand(), true)), 0, 11);
    $checkId = $userTableClass->selectUser(fields: "id_user", key: "id_user = '$id'");
    if($checkId['row'] > 0){
        return generateIDUser();
    }else{
        return $id;
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


function dataTable(){
    global $userTableClass;
    global $idUpline;

    $data = $userTableClass->selectUser(
        fields: "
            id_user, 
            username, 
            email, 
            package, 
            team, 
            regist_by, 
            upline, 
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(regist_date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i') AS date_time, 
            status
        ",
        key: "upline = '$idUpline' ORDER BY team ASC"
    );

    return $data;
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

function dataUser($idUser){
    global $userTableClass;
    global $profileUserTableClass;

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

function dataBank(){
    global $adminBankTableClass;

    $data = $adminBankTableClass->selectAdminBank(
        fields: "atas_nama, nama_bank, no_rek",
        key: "1 LIMIT 1"
    );

    return $data['data'][0];
}

function dataPackage(){
    global $packageTableClass;

    $data = $packageTableClass->selectPackage(
        fields: "name, fee",
        key: "1"
    );

    return $data['data'];
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

// UTC TO LOCAL TIME FORMAT
function fromUTC($currentmillisdate){
        
    // Mengatur zona waktu lokal Jakarta
    date_default_timezone_set('Asia/Makassar');

    // Konversi waktu UTC ke format tanggal dan waktu
    $datetime = date("Y-m-d H:i:s", $currentmillisdate / 1000);
    // Konversi waktu UTC ke format tanggal
    $date = date("Y-m-d", $currentmillisdate / 1000);
    // Dapatkan nama hari dalam bahasa Inggris
    $day = date("l", $currentmillisdate / 1000);
    // Dapatkan tanggal terakhir dari bulan saat ini
    $lastDayOfMonth = date("Y-m-t", $currentmillisdate / 1000);
    $firstDayOfMonth = date("Y-m", $currentmillisdate / 1000) . "-01";

    return [
        "datetime" => $datetime,
        "date" => $date,
        "day" => $day,
        "lastDayOfMonth" => $lastDayOfMonth,
        "firstDayOfMonth" => $firstDayOfMonth,
    ];
}

function toUTCorIndo($tanggal) {
    // Konversi string tanggal ke objek DateTime
    $date = new DateTime($tanggal, new DateTimeZone('Asia/Makassar')); // Sesuaikan timezone lokal jika diperlukan

    // Format UTC
    $dateUTC = clone $date;
    $dateUTC->setTimezone(new DateTimeZone('UTC'));
    $formatUTC = $dateUTC->getTimestamp() * 1000; // Konversi detik ke milidetik

    // Format '15 Apr 2024, 21:05'
    $formatIndo = $date->format('d M Y, H:i'); // Format sesuai kebutuhan

    // Kembalikan dua format dalam array
    return [
        'utc' => $formatUTC,
        'indo' => $formatIndo
    ];
}

function formatNumber($number){
    if (preg_match('/^(62|0)/', $number)) {
        $number = preg_replace('/^(62|0)/', '', $number);
    }
    return $number;
}