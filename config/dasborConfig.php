<?php  
// check login status
if($_SESSION['login_sip'] != true){
    header('Location: index');
    exit();
}
include "admin/database/connMySQLClass.php";
include "admin/database/userTableClass.php";
include "admin/database/profileUserTableClass.php";
include "admin/database/reportBonusesUjrohTableClass.php";
include "admin/database/reportBonusesJariyahTableClass.php";
include "admin/database/reportPoinTableClass.php";
include "admin/database/voucherTableClass.php";
include "admin/database/pinTableClass.php";
include "admin/database/ujrohTableClass.php";
include "admin/database/jariyahTableClass.php";

$userTableClass = new userTableClass();
$profileUserTableClass = new profileUserTableClass();
$reportBonusesUjrohTableClass = new reportBonusesUjrohTableClass();
$reportBonusesJariyahTableClass = new reportBonusesJariyahTableClass();
$voucherTableClass = new voucherTableClass();
$pinTableClass = new pinTableClass();
$ujrohTableClass = new ujrohTableClass();
$jariyahTableClass = new jariyahTableClass();
$reportPoinTableClass = new reportPoinTableClass();

$dataLogin = dataLogin();

$dateNowMilis = round(microtime(true) * 1000);
$dateNow = fromUTC($dateNowMilis)['date'];
$minggu = fromUTC($dateNowMilis)['weekDates']['Sunday'];
$sabtu = fromUTC($dateNowMilis)['weekDates']['Saturday'];

$sumBonusUjroh = sumBonusUjroh();
if($dataLogin['package'] == "Hamdalah"){
    $sumBonusJariyah = sumBonusJariyah();
}
$sumZis = sumZis();

if(isset($_POST['req'])){
    $codePIN = trim(htmlspecialchars($_POST['codePIN']));
    $idUser = $_SESSION["id_user"];
    $package = $dataLogin['package'];
    $registDate = $dataLogin['regist_date'];

    $disconDay = $registDate + (100*24*60*60*1000);

    $packagePin = "Upgrade";
    if($dateNowMilis <= $disconDay){
        $packagePin = "Upgrade 100 Hari";
    }
    if($codePIN == ""){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        $checkPin = $pinTableClass->selectPin(
            fields: "status",
            key: "id_user = '$idUser' AND code_pin = '$codePIN' AND package = '$packagePin'"
        );
        if($checkPin['row'] == 0){
            sleep(2);
            $alertError = "Kode PIN invalid, hubungi Admin SIP!";
        }else{
            $statusPIN = $checkPin['data'][0]['status'];
            if($statusPIN == "Terpakai"){
                sleep(2);
                $alertError = "Kode PIN sudah digunakan!";
            }else{
                if($package == "Hamdalah"){
                    sleep(2);
                    $alertError = "Anda sudah aktif sebagai member Hamdalah!";
                }else{
                    $updatePackage = $userTableClass->updateUser(
                        dataSet: "package = 'Hamdalah'", 
                        key: "id_user = '$idUser' AND package = 'Basmalah'"
                    );
                    if($updatePackage){
                        $updatePin = $pinTableClass->updatePin(
                            dataSet: "status = 'Terpakai'",
                            key: "id_user = '$idUser' AND code_pin = '$codePIN' AND package = '$packagePin'"
                        );
                        if($updatePin){
                            $regoistBy = $dataLogin['regist_by'];
                            $uplinesss = $dataLogin['upline'];
                            $teams = $dataLogin['team'];
                            // berikan bonus dan potongan automain atau admin
                            giftBonusUjroh($idUser, $packagePin, $regoistBy);

                            giftBonusJariyah($idUser, "Buy Package", $regoistBy, 1);
                            // vouhcer
                            createVoucher("Hamdalah ".$packagePin, $idUser);
                            // pin
                            giftPoin($idUser, $uplinesss, $teams);
                            $_SESSION["alertSuccess"] = "Paket berhasil diupgrade!";
                            header('Location: dasbor');
                            exit();
                        }
                    }
                }
            }
        }
    }
}

function sumBonusUjroh(){
    global $reportBonusesUjrohTableClass;

    global $dateNow;

    $idUser = $_SESSION["id_user"];

    $data = $reportBonusesUjrohTableClass->selectReportUjroh(
        fields: "SUM(reward) AS jumlah",
        key: "
            id_user_recruiter = '$idUser' AND (
                DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i:%s') >= '$dateNow 00:00:00' AND 
                DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i:%s') <= '$dateNow 23:59:59'
            )
        "
    )['data'][0]['jumlah'];

    return $data;
}

function sumBonusJariyah(){
    global $reportBonusesJariyahTableClass;

    global $minggu;
    global $sabtu;

    $idUser = $_SESSION["id_user"];

    $data = $reportBonusesJariyahTableClass->selectReportJariyah(
        fields: "SUM(reward) AS jumlah",
        key: "
            id_user_upline = '$idUser' AND (
                DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i:%s') >= '$minggu 00:00:00' AND 
                DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i:%s') <= '$sabtu 23:59:59'
            )
        "
    )['data'][0]['jumlah'];

    return $data;
}

function sumZis(){
    global $reportBonusesUjrohTableClass;
    global $reportBonusesJariyahTableClass;

    $ujroh = $reportBonusesUjrohTableClass->selectReportUjroh(
        fields: "SUM(reward) AS jumlah",
        key: "1"
    )['data'][0]['jumlah'];
    
    $jariyah = $reportBonusesJariyahTableClass->selectReportJariyah(
        fields: "SUM(reward) AS jumlah",
        key: "1"
    )['data'][0]['jumlah'];

    return $ujroh+$jariyah;
}

function fromUTC($currentmillisdate) {
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

    // Hitung tanggal dari Minggu hingga Sabtu
    $currentDayOfWeek = date("w", $currentmillisdate / 1000); // 0 (Minggu) - 6 (Sabtu)
    $startOfWeek = strtotime("-$currentDayOfWeek days", $currentmillisdate / 1000); // Tanggal Minggu
    $endOfWeek = strtotime("+" . (6 - $currentDayOfWeek) . " days", $currentmillisdate / 1000); // Tanggal Sabtu

    $weekDates = [];
    for ($i = 0; $i <= 6; $i++) {
        $weekDates[date("l", strtotime("+$i days", $startOfWeek))] = date("Y-m-d", strtotime("+$i days", $startOfWeek));
    }

    return [
        "datetime" => $datetime,
        "date" => $date,
        "day" => $day,
        "lastDayOfMonth" => $lastDayOfMonth,
        "firstDayOfMonth" => $firstDayOfMonth,
        "weekDates" => $weekDates,
    ];
}

function dataLogin(){
    global $userTableClass;
    global $profileUserTableClass;

    $idUser = $_SESSION["id_user"];

    $getUser = $userTableClass->selectUser(
        fields: "username, email, package, team, regist_by, upline, regist_date",
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
        "team" => $getUser['team'],
        "regist_by" => $getUser['regist_by'],
        "upline" => $getUser['upline'],
        "regist_date" => $getUser['regist_date'],
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

function createVoucher($package, $idUser){
    global $voucherTableClass;

    if($package == "Hamdalah Upgrade"){
        $nominalVoucher = array("5000000", "3000000");
    }elseif($package == "Hamdalah Upgrade 100 Hari"){
        $nominalVoucher = array("5000000");
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
    if($category == "Upgrade 100 Hari"){
        $getReward = "500000";
    }
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