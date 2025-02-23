<?php  
// check login status
if($_SESSION['login_sip'] != true){
    header('Location: index');
    exit();
}
include "admin/database/connMySQLClass.php";
include "admin/database/userTableClass.php";
include "admin/database/profileUserTableClass.php";
include "admin/database/paymentTableClass.php";

$userTableClass = new userTableClass();
$profileUserTableClass = new profileUserTableClass();
$paymentTableClass = new paymentTableClass();

$dataLogin = dataLogin();
if($dataLogin['package'] != "Hamdalah"){
    header('Location: dasbor');
    exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : '1'; // number page
$dateNowMilis = round(microtime(true) * 1000);
$date = fromUTC(currentmillisdate: $dateNowMilis); // localtime
$dari = isset($_GET['dari']) ? $_GET['dari'] : $date['firstDayOfMonth'];
$sampai = isset($_GET['sampai']) ? $_GET['sampai'] : $date['lastDayOfMonth'];
$statusFil = isset($_GET['statusFilter']) ? $_GET['statusFilter'] : 'Semua';

function dataTable($page){
    global $paymentTableClass;
    global $dari;
    global $sampai;
    global $statusFil;

    $addQuery = "";
    if($statusFil != "Semua"){
        $addQuery .= " AND status = '$statusFil'";
    }

    $idUser = $_SESSION["id_user"];
    $start = 5 * ($page - 1);

    $data = $paymentTableClass->selectPayment(
        fields: "
            code_payment,
            id_user,
            package,
            fee, 
            category, 
            transaction_photo, 
            status, 
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date_payment / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i') AS date_time,
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date_update / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i') AS date_confirm
        ",
        key: "
            regist_by = '$idUser'$addQuery AND (
                DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date_payment / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i:%s') >= '$dari 00:00:00' AND 
                DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date_payment / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i:%s') <= '$sampai 23:59:59'
            ) ORDER BY date_payment DESC LIMIT $start, 5
        "
    );

    return $data;
}

function countDataTable(){
    global $paymentTableClass;
    global $dari;
    global $sampai;
    global $statusFil;

    $addQuery = "";
    if($statusFil != "Semua"){
        $addQuery .= " AND status = '$statusFil'";
    }

    $idUser = $_SESSION["id_user"];

    $data = $paymentTableClass->selectPayment(
        fields: "COUNT(code_payment) AS total",
        key: "
            regist_by = '$idUser'$addQuery AND (
                DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date_payment / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i:%s') >= '$dari 00:00:00' AND 
                DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date_payment / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i:%s') <= '$sampai 23:59:59'
            )
        "
    );

    return [
        "total" => $data['data'][0]['total']
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
