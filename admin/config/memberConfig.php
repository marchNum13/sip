<?php  
// check login status
if($_SESSION['login_admin_sip'] != true){
    header('Location: index');
    exit();
}

include "database/connMySQLClass.php";
include "database/userTableClass.php";
include "database/profileUserTableClass.php";
include "database/reportPoinTableClass.php";

$userTableClass = new userTableClass();
$profileUserTableClass = new profileUserTableClass();
$reportPoinTableClass = new reportPoinTableClass();

$page = isset($_GET['page']) ? $_GET['page'] : '1'; // number page
$filter = isset($_GET['filter']) ? $_GET['filter'] : "";

function totalPoin($idUser){
    global $reportPoinTableClass;

    $query = "id_user = '$idUser'";

    $data = $reportPoinTableClass->selectReportPoin(
        fields: "SUM(total) AS total_poin",
        key: "$query"
    )['data'][0]['total_poin'];

    return $data;
}

function dataTable($page){
    global $userTableClass;
    global $filter;

    $query = "1";
    if($filter != ""){
        $query = "username = '$filter' OR email = '$filter'";
    }
    $start = 5 * ($page - 1);

    $data = $userTableClass->selectUser(
        fields: "
            id_user, 
            username, 
            email, 
            package, 
            regist_by, 
            upline, 
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(regist_date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i') AS date_time
        ",
        key: "$query ORDER BY regist_date DESC LIMIT $start, 5
        "
    );

    return $data;
}

function countDataTable(){
    global $userTableClass;
    global $filter;

    $query = "1";
    if($filter != ""){
        $query = "username = '$filter' OR email = '$filter'";
    }
    $data = $userTableClass->selectUser(
        fields: "COUNT(id_user) AS total",
        key: " $query"
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