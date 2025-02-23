<?php  
// check login status
if($_SESSION['login_sip'] != true){
    header('Location: index');
    exit();
}
include "admin/database/connMySQLClass.php";
include "admin/database/userTableClass.php";
include "admin/database/profileUserTableClass.php";
include "admin/database/pinTableClass.php";

$userTableClass = new userTableClass();
$profileUserTableClass = new profileUserTableClass();
$pinTableClass = new pinTableClass();

$dataLogin = dataLogin();

$page = isset($_GET['page']) ? $_GET['page'] : '1'; // number page

function dataTable($page){
    $idUser = $_SESSION["id_user"];
    global $pinTableClass;

    $start = 5 * ($page - 1);

    $data = $pinTableClass->selectPin(
        fields: "
            code_pin,
            package,
            status, 
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i') AS date_time
        ",
        key: "id_user = '$idUser' ORDER BY date DESC LIMIT $start, 5"
    );

    return $data;
}

function countDataTable(){
    $idUser = $_SESSION["id_user"];
    global $pinTableClass;

    $data = $pinTableClass->selectPin(
        fields: "COUNT(code_pin) AS total",
        key: "id_user = '$idUser'"
    );

    return [
        "total" => $data['data'][0]['total']
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