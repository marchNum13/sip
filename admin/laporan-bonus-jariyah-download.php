<?php  
session_start();
error_reporting(0);
// check login status
if($_SESSION['login_admin_sip'] != true){
    header('Location: index');
    exit();
}
if(!isset($_GET['dari']) || !isset($_GET['sampai'])){
    header('Location: laporan-bonus-jariyah');
    exit();

}

include "database/connMySQLClass.php";
include "database/userTableClass.php";
include "database/userBankTableClass.php";

$userTableClass = new userTableClass();
$userBankTableClass = new userBankTableClass();

$dari = $_GET['dari'];
$sampai = $_GET['sampai'];

require_once('tcpdf/tcpdf.php');

// Inisialisasi TCPDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PT. Syiar Insan Prima');
$pdf->SetTitle('Laporan Bonus Jariyah');
$pdf->SetHeaderData('', 0, 'Laporan Bonus Jariyah', 'Periode: ' . $dari . ' 00:00 wita - ' . $sampai . ' 23:59 wita');
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetMargins(10, 20, 10);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->AddPage();

$html = '
    <h2 style="text-align: center; font-family: Arial, sans-serif; color: #4CAF50;">Laporan Bonus Jariyah</h2>
    <table border="1" cellpadding="3" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 10pt;">
        <thead>
            <tr style="background-color: #0b6e45; color: #fff;">
                <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Member</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Rekening</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: center;">Total Bonus</th>
            </tr>
        </thead>
        <tbody>
';

$dataTable = dataTable($page);
if($dataTable['row'] == 0){
    $html .= '
        <tr>
            <td colspan="3" style="text-align: center; padding: 20px; color: #ff0000;">Tidak ada data untuk periode ini.</td>
        </tr>
    ';
} else {
    foreach($dataTable['data'] as $row){
        $bank = dataBank($row['id']);
        $atasNama = $bank['nama'];
        $namaBank = $bank['bank'];
        $noRek = $bank['rek'];

        $html .= '
            <tr>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center; align-items: center;">
                    <div style="line-height: 1.2;">' . $row['username'] . '</div>
                    <div style="line-height: 1.2; color: #666;">' . $row['email'] . '</div>
                </td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: center; align-items: center;">
                    <div style="line-height: 1.2;">' . $atasNama . '</div>
                    <div style="line-height: 1.2; font-weight: bold;">' . $namaBank . '</div>
                    <div style="line-height: 1.2;">' . $noRek . '</div>
                </td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: right; align-items: center;">Rp' . number_format(($row['total_reward']-($row['total_reward']*0.025))) . '</td>
            </tr>
        ';
    }
}

$html .= '
        </tbody>
    </table>
';


// Tambahkan ke PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output file PDF dan unduh
$pdf->Output('laporan_bonus_jariyah.pdf', 'D');

function dataTable(){
    global $userTableClass;
    global $dari;
    global $sampai;

    $data = $userTableClass->selectUserJoin(
        fields: "
            user.id_user AS id,
            user.username AS username,
            user.email AS email,
            SUM(report_bonuses_jariyah.reward) AS total_reward
        ",
        join: "
            JOIN report_bonuses_jariyah ON user.id_user = report_bonuses_jariyah.id_user_upline
        ",
        key: "
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(report_bonuses_jariyah.date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i:%s') >= '$dari 00:00:00' AND 
            DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(report_bonuses_jariyah.date / 1000), '+00:00', '+08:00'), '%Y-%m-%d %H:%i:%s') <= '$sampai 23:59:59'
            GROUP BY 
                user.id_user, 
                user.username, 
                user.email
            HAVING
                total_reward IS NOT NULL AND total_reward > 0
            ORDER BY 
                total_reward DESC
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