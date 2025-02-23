<?php  
// check login status
if($_SESSION['login_sip'] != true){
    header('Location: index');
    exit();
}
include "admin/database/connMySQLClass.php";
include "admin/database/userTableClass.php";
include "admin/database/profileUserTableClass.php";
include "admin/database/reportPoinTableClass.php";
include "admin/database/rewardTableClass.php";
include "admin/database/reportRewardTableClass.php";

$userTableClass = new userTableClass();
$profileUserTableClass = new profileUserTableClass();
$reportPoinTableClass = new reportPoinTableClass();
$rewardTableClass = new rewardTableClass();
$reportRewardTableClass = new reportRewardTableClass();

$dataLogin = dataLogin();
$dataPoin = dataPoin();
$totalTim = totalTim();

$countAllPoin = totalPoin();
$counttimA = totalPoin("A");
$counttimB = totalPoin("B");
$counttimC = totalPoin("C");

$allTimPoin = [$counttimA, $counttimB, $counttimC];

$alertError = "";
if(isset($_POST['klaim'])){
    $codeReward = trim(htmlspecialchars($_POST['codeReward']));

    if($codeReward == ""){
        sleep(2);
        $alertError = "terjadi kesalahan!";
    }else{
        $checkReward = $rewardTableClass->selectReward(fields: "poin, reward, desk", key: "code = '$codeReward'");
        if($checkReward['row'] == 0){
            sleep(2);
            $alertError = "terjadi kesalahan!";
        }else{
            if(isCheckList($codeReward)){
                sleep(2);
                $alertError = "terjadi kesalahan!";
            }else{
                if($totalTim < 3){
                    sleep(2);
                    $alertError = "Anda harus memiliki minimal 3 tim!";
                }else{
                    $rewardPoin = $checkReward['data'][0]['poin'];
                    if($countAllPoin < $rewardPoin){
                        sleep(2);
                        $alertError = "Jumlah poin anda tidak cukup!";
                    }else{
                        $tigaPuluhPersen = $rewardPoin*0.3;
                        if(timLemah($tigaPuluhPersen) < $tigaPuluhPersen){
                            sleep(2);
                            $alertError = "Jumlah poin tim lemah anda tidak cukup!";
                        }else{
                            $rewardNominal = $checkReward['data'][0]['reward'];
                            $rewardDesk = $checkReward['data'][0]['desk'];
                            $idUser = $_SESSION["id_user"];
                            $dateNowMilis = round(microtime(true) * 1000);

                            $saveReport = $reportRewardTableClass->insertReportReward(
                                fields: "
                                    code,
                                    id_user,
                                    poin,
                                    reward,
                                    desk,
                                    date_request
                                ",
                                value: "
                                    '$codeReward',
                                    '$idUser',
                                    '$rewardPoin',
                                    '$rewardNominal',
                                    '$rewardDesk',
                                    '$dateNowMilis'
                                "
                            );
                            if($saveReport){    
                                sleep(2);
                                $_SESSION["alertSuccess"] = "Reward berhasil diklaim, admin akan segera menghubungi anda!";
                                header('Location: poin-tim');
                                exit();
                            }
                        }
                    }
                }


            }
        }
    }
}

function timLemah($term){
    global $allTimPoin;

    sort($allTimPoin);

    $total = $allTimPoin[0]+$allTimPoin[1];

    if($total > $term){
        return $term;
    }else{
        return $total;
    }
}

function totalTim(){
    global $userTableClass;

    $idUser = $_SESSION["id_user"];

    $data = $userTableClass->selectUser(
        fields: "COUNT(id_user) AS total",
        key: "upline = '$idUser'"
    )['data'][0]['total'];

    return $data;
}

function isCheckList($code){
    global $reportRewardTableClass;

    $idUser = $_SESSION["id_user"];

    $data = $reportRewardTableClass->selectReportReward(
        fields: "code",
        key: "code = '$code' AND id_user = '$idUser'"
    );

    if($data['row'] > 0){
        return true;
    }else{
        return false;
    }
}

function dataPoin(){
    global $rewardTableClass;

    $getPoin = $rewardTableClass->selectReward(
        fields: "code, poin, reward, desk",
        key: "1 ORDER BY id ASC"
    )['data'];

    return $getPoin;
}

function totalPoin($param = "all"){
    global $reportPoinTableClass;
    $idUser = $_SESSION["id_user"];

    $query = "id_user = '$idUser'";
    if($param != "all"){
        $query .= " AND team = '$param'";
    }

    $data = $reportPoinTableClass->selectReportPoin(
        fields: "SUM(total) AS total_poin",
        key: "$query"
    )['data'][0]['total_poin'];

    return $data;
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