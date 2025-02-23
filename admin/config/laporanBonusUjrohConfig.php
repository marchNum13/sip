<?php  
// check login status
if($_SESSION['login_admin_sip'] != true){
    header('Location: index');
    exit();
}

include "database/connMySQLClass.php";
include "database/userTableClass.php";
include "database/profileUserTableClass.php";
include "database/reportBonusesUjrohTableClass.php";
include "database/userBankTableClass.php";

$userTableClass = new userTableClass();
$profileUserTableClass = new profileUserTableClass();
$reportBonusesUjrohTableClass = new reportBonusesUjrohTableClass();
$userBankTableClass = new userBankTableClass();

$page = isset($_GET['page']) ? $_GET['page'] : '1'; // number page
$dateNowMilis = round(microtime(true) * 1000);
$date = fromUTC(currentmillisdate: $dateNowMilis); // localtime
$dari = isset($_GET['dari']) ? $_GET['dari'] : $date['firstDayOfMonth'];
$sampai = isset($_GET['sampai']) ? $_GET['sampai'] : $date['lastDayOfMonth'];
// $rekap = isset($_GET['rekap']) ? $_GET['rekap'] : "Detail";

function dataTable($page){
    global $reportBonusesUjrohTableClass;
    global $dari;
    global $sampai;

    $start = 5 * ($page - 1);

    $data = $reportBonusesUjrohTableClass->selectReportUjroh(
        fields: "
            id_user_recruiter, 
            id_user_recruited, 
            category, 
            reward, 
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i') AS date_time
        ",
        key: "
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i:%s') >= '$dari 00:00:00' AND 
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i:%s') <= '$sampai 23:59:59'
            ORDER BY date DESC LIMIT $start, 5
        "
    );

    return $data;
}

function dataBank($idUser){
    global $userBankTableClass;

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

function countDataTable(){
    global $reportBonusesUjrohTableClass;
    global $dari;
    global $sampai;

    $data = $reportBonusesUjrohTableClass->selectReportUjroh(
        fields: "COUNT(id) AS total, SUM(reward) AS jumlah",
        key: "
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i:%s') >= '$dari 00:00:00' AND 
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i:%s') <= '$sampai 23:59:59'
        "
    );

    return [
        "total" => $data['data'][0]['total'],
        "jumlah" => $data['data'][0]['jumlah']
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
    $date = new DateTime($tanggal); // Sesuaikan timezone lokal jika diperlukan
    // Format '15 Apr 2024, 21:05'
    $formatIndo = $date->format('d M Y, H:i'); // Format sesuai kebutuhan

    // Format UTC
    $dateUTC = clone $date;
    $dateUTC->setTimezone(new DateTimeZone('UTC'));
    $formatUTC = $dateUTC->getTimestamp() * 1000; // Konversi detik ke milidetik

    

    // Kembalikan dua format dalam array
    return [
        'utc' => $formatUTC,
        'indo' => $formatIndo
    ];
}