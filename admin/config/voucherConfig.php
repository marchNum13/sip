<?php  
// check login status
if($_SESSION['login_admin_sip'] != true){
    header('Location: index');
    exit();
}

include "database/connMySQLClass.php";
include "database/userTableClass.php";
include "database/profileUserTableClass.php";
include "database/voucherTableClass.php";

$userTableClass = new userTableClass();
$profileUserTableClass = new profileUserTableClass();
$voucherTableClass = new voucherTableClass();

$alertError = "";
if(isset($_POST['claim'])){
    $codeVoucher = trim(htmlspecialchars($_POST['codeVoucher']));
    $emailOrUsername = trim(htmlspecialchars($_POST['emailOrUsername']));

    if($codeVoucher == "" || $emailOrUsername == ""){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        $getMember = $userTableClass->selectUser(
            fields: "id_user",
            key: "username = '$emailOrUsername' OR email = '$emailOrUsername'"
        );
        if($getMember['row'] == 0){
            sleep(2);
            $alertError = "Member tidak ditemukan!";
        }else{
            $IdMember = $getMember['data'][0]['id_user'];
            $checkVoucher = $voucherTableClass->selectVoucher(
                fields: "code",
                key: "id_user = '$IdMember' AND status = 'Belum Terpakai' AND code = '$codeVoucher'"
            );
            if($checkVoucher['row'] == 0){
                sleep(2);
                $alertError = "Voucher tidak valid!";
            }else{
                $dateNowMilis = round(microtime(true) * 1000);
                $update = $voucherTableClass->updateVoucher(
                    dataSet: "status = 'Terpakai', date_update = '$dateNowMilis'",
                    key: "id_user = '$IdMember' AND status = 'Belum Terpakai' AND code = '$codeVoucher'"
                );
                if($update){
                    sleep(2);
                    $_SESSION["alertSuccess"] = "Voucher berhasil dicalim.";
                    header('Location: voucher');
                    exit();
                }
            }
        }
    }

}

$page = isset($_GET['page']) ? $_GET['page'] : '1'; // number page
$filter = isset($_GET['filter']) ? $_GET['filter'] : "";

function dataTable($page){
    global $voucherTableClass;
    global $filter;

    $query = "";
    if($filter != ""){
        global $userTableClass;
        $getMember = $userTableClass->selectUser(
            fields: "id_user",
            key: "username = '$filter' OR email = '$filter'"
        );
        if($getMember['row'] > 0){
            $IdUSER = $getMember['data'][0]['id_user'];
            $query = " AND id_user = '$IdUSER'";
        }else{
            $query = " AND id_user = 'admin'";
        }
    }

    $start = 5 * ($page - 1);

    $data = $voucherTableClass->selectVoucher(
        fields: "
            id_user,
            code,
            nominal,
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date_update / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i') AS date_time
        ",
        key: "status = 'Terpakai'$query ORDER BY date_update DESC LIMIT $start, 5"
    );

    return $data;
}

function countDataTable(){
    global $voucherTableClass;
    global $filter;

    $query = "";
    if($filter != ""){
        global $userTableClass;
        $getMember = $userTableClass->selectUser(
            fields: "id_user",
            key: "username = '$filter' OR email = '$filter'"
        );
        if($getMember['row'] > 0){
            $IdUSER = $getMember['data'][0]['id_user'];
            $query = " AND id_user = '$IdUSER'";
        }else{
            $query = " AND id_user = 'admin'";
        }
    }

    $data = $voucherTableClass->selectVoucher(
        fields: "COUNT(code) AS total",
        key: "status = 'Terpakai'$query"
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
