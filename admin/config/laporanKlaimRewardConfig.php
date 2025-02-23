<?php  
// check login status
if($_SESSION['login_admin_sip'] != true){
    header('Location: index');
    exit();
}

include "database/connMySQLClass.php";
include "database/userTableClass.php";
include "database/profileUserTableClass.php";
include "database/reportRewardTableClass.php";

$userTableClass = new userTableClass();
$profileUserTableClass = new profileUserTableClass();
$reportRewardTableClass = new reportRewardTableClass();

$page = isset($_GET['page']) ? $_GET['page'] : '1'; // number page
$dateNowMilis = round(microtime(true) * 1000);

$alertError = "";
if(isset($_POST['confirmReward'])){
    $idReport = $_POST['idReport'];

    if(!isset($_POST['confirCheck'])){
        sleep(2);
        $alertError = "Centang checkbox!";
    }else{
        $checkReport = $reportRewardTableClass->selectReportReward(
            fields: "id",
            key: "id = '$idReport' AND status = 'Pending'"
        );
        if($checkReport['row'] == 0){
            sleep(2);
            $alertError = "Data tidak ditemukan!";
        }else{
            $updateStatus = $reportRewardTableClass->updateReportReward(
                dataSet: "status = 'Diterima', date_confirm = '$dateNowMilis'",
                key: "id = '$idReport' AND status = 'Pending'"
            );
            if($updateStatus){
                sleep(2);
                $_SESSION["alertSuccess"] = "Data berhasil disimpan!";
                header('Location: laporan-klaim-reward');
                exit();
            }
        }
    }
}

function dataTable($page){
    global $reportRewardTableClass;

    $start = 5 * ($page - 1);

    $data = $reportRewardTableClass->selectReportReward(
        fields: "
            id, 
            code, 
            id_user, 
            poin, 
            reward, 
            desk, 
            status, 
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date_request / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i') AS date_time,
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date_confirm / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i') AS date_confirm
        ",
        key: "1 ORDER BY date_request DESC LIMIT $start, 5"
    );

    return $data;
}

function countDataTable(){
    global $reportRewardTableClass;

    $data = $reportRewardTableClass->selectReportReward(
        fields: "COUNT(id_user) AS total",
        key: "1"
    );

    return $data['data'][0]['total'];
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

