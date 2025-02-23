<?php  
// check login status
if($_SESSION['login_admin_sip'] != true){
    header('Location: index');
    exit();
}

include "database/connMySQLClass.php";
include "database/userTableClass.php";
include "database/profileUserTableClass.php";
include "database/pinTableClass.php";

$userTableClass = new userTableClass();
$profileUserTableClass = new profileUserTableClass();
$pinTableClass = new pinTableClass();

$alertError = "";

if(isset($_POST['tf'])){
    $kodePin = trim(htmlspecialchars($_POST['kodePin']));
    $paketTf = trim(htmlspecialchars($_POST['paketTf']));
    $pemilikPin = trim(htmlspecialchars($_POST['pemilikPin']));
    $penerimaPin = trim(htmlspecialchars($_POST['penerimaPin']));
    if($kodePin == "" || $pemilikPin == "" || $penerimaPin == ""){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        $getPemilik = $userTableClass->selectUser(
            fields: "id_user",
            key: "username = '$pemilikPin' OR email = '$pemilikPin'"
        );
        if($getPemilik['row'] == 0){
            sleep(2);
            $alertError = "Pemilik tidak ditemukan!";
        }else{
            $idPemilik = $getPemilik['data'][0]['id_user'];
            $checkPin = $pinTableClass->selectPin(
                fields: "status",
                key: "id_user = '$idPemilik' AND code_pin = '$kodePin' AND package = '$paketTf'"
            );
            if($checkPin['row'] == 0){
                sleep(2);
                $alertError = "Pin tidak ditemukan!";
            }else{
                $statusPin = $checkPin['data'][0]['status'];
                if($statusPin == "Terpakai"){
                    sleep(2);
                    $alertError = "Kode PIN sudah digunakan!";
                }else{
                    $getPenerima = $userTableClass->selectUser(
                        fields: "id_user, package",
                        key: "username = '$penerimaPin' OR email = '$penerimaPin'"
                    );
                    if($getPenerima['row'] == 0){
                        sleep(2);
                        $alertError = "Penerima tidak ditemukan!";
                    }else{
                        $packagePenerima = $getPenerima['data'][0]['package'];
                        if($packagePenerima == "Hamdalah" && ($paketTf == "Upgrade" || $paketTf == "Upgrade 100 Hari")){
                            sleep(2);
                            $alertError = "Paket upgrade hanya untuk member basmalah!";
                        }else{
                            $idPenerima = $getPenerima['data'][0]['id_user'];
                            $updatePin = $pinTableClass->updatePin(
                                dataSet: "id_user = '$idPenerima'",
                                key: "id_user = '$idPemilik' AND code_pin = '$kodePin' AND package = '$paketTf'"
                            );
                            $_SESSION["alertSuccess"] = "PIN berhasil dikirim";
                            header('Location: pin');
                            exit();
                        }
                    }
                }
            }
        }
    }
}

if(isset($_POST['kirim'])){
    $jumlah = trim(htmlspecialchars($_POST['jumlah']));
    $memberinput = trim(htmlspecialchars($_POST['memberinput']));
    $paket = trim(htmlspecialchars($_POST['paket']));

    if(($jumlah == "" || $jumlah == 0) || $memberinput == "" || $paket == ""){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        $getMember = $userTableClass->selectUser(
            fields: "id_user, package",
            key: "username = '$memberinput' OR email = '$memberinput'"
        );
        if($getMember['row'] == 0){
            sleep(2);
            $alertError = "Member tidak ditemukan!";
        }else{
            $packageMember = $getMember['data'][0]['package'];
            if($packageMember == "Hamdalah" && ($paket == "Upgrade" || $paket == "Upgrade 100 Hari")){
                sleep(2);
                $alertError = "Paket upgrade hanya untuk member basmalah!";
            }else{
                $IdMember = $getMember['data'][0]['id_user'];
                for($j = 0; $j < $jumlah; $j++){
                    $dateNowMilis = round(microtime(true) * 1000);
                    $codePIN = generatePinCode(6);
                    $pinTableClass->insertPin(
                        fields: "code_pin, id_user, package, date",
                        value: "'$codePIN','$IdMember','$paket','$dateNowMilis'"
                    );
                }
                $_SESSION["alertSuccess"] = "PIN berhasil dikirim";
                header('Location: pin');
                exit();
            }
        }
    }
}

function generatePinCode($length = 6) {
    global $pinTableClass;
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // Huruf besar dan angka
    $charactersLength = strlen($characters);
    $randomCode = '';

    for ($i = 0; $i < $length; $i++) {
        $randomCode .= $characters[rand(0, $charactersLength - 1)];
    }

    $check = $pinTableClass->selectPin(fields: "code_pin", key: "code_pin = '$randomCode'")['row'];

    if($check > 0){
        return generatePinCode(6);
    }else{
        return $randomCode;
    }

}

$page = isset($_GET['page']) ? $_GET['page'] : '1'; // number page
function dataTable($page){
    global $pinTableClass;

    $start = 5 * ($page - 1);

    $data = $pinTableClass->selectPin(
        fields: "
            code_pin,
            id_user,
            package,
            status, 
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i') AS date_time
        ",
        key: "1 ORDER BY date DESC LIMIT $start, 5"
    );

    return $data;
}

function countDataTable(){
    global $pinTableClass;

    $data = $pinTableClass->selectPin(
        fields: "COUNT(code_pin) AS total",
        key: "1"
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