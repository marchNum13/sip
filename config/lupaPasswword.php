<?php  
// check login status
if($_SESSION['login_sip'] == true){
    header('Location: dasbor');
    exit();
}
include "admin/database/connMySQLClass.php";
include "admin/database/userTableClass.php";

$userTableClass = new userTableClass();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require "vendor/autoload.php";

$alertError = "";
$alertSuccess = "";

if(isset($_POST['kirimOTP'])){
    $emailInput = trim(htmlspecialchars($_POST['emailInput']));
    if(
        $emailInput == ""
        
    ){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        if(!validasiEmail($emailInput)){
            sleep(2);
            $alertError = "Alamat email tidak valid";
        }else{
            $checkEmail = $userTableClass->selectUser(
                fields: "email",
                key: "email = '$emailInput' LIMIT 1"
            );
            if($checkEmail['row'] == 0){
                sleep(2);
                $alertError = "Email belum terdaftar!";
            }else{
                $codeOTP = createCode();
                $updateCode = $userTableClass->updateUser(
                    dataSet:"user_code_verif = '$codeOTP'",
                    key:"email = '$emailInput'"
                );
                if($updateCode){
                    $sendEmail = sendEmail($emailInput, $codeOTP);
                    if($sendEmail){
                        $alertSuccess = "Check email anda sekarang untuk meng-reset password!";
                    }else{
                        sleep(2);
                        $alertError = "OTP code failed to send.";
                    }
                }
            }
        }
    }

}

function sendEmail($emailDestination, $codeOTP){
    $memberName = explode("@", $emailDestination)[0];
    $url = "https://app.syiarinsanprima.com/reset-password?email=" . $emailDestination . "&v=" . password_hash($codeOTP, PASSWORD_DEFAULT);
    $subject = 'Reset Password Akun SIP!';
    $message = '<html>
                    <body>
                    <h2>Pesan penting!</h2>
                    <h4>Jangan bagikan pesan ini ke siapapun!</h4>
                    <p>Kunjungi Link untuk mengubah password: ' . $url . '</p>
                    </body>
                </html>';

 
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    
    // $mail->Host = "smtp.hostinger.com";
    $mail->Host = "smtp.hostinger.com";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->Username = "admin@syiarinsanprima.com";
    $mail->Password = "@Sip2025";

    $mail->setFrom("admin@syiarinsanprima.com", "PT. Syiar Insan Prima");
    $mail->addAddress($emailDestination, $memberName);
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $message;

    return $mail->send();
}

// Fungsi untuk membuat kode refferal unik
function createCode() {
    global $userTableClass;

    $user_code_verif = substr(md5(uniqid(rand(), true)), 0, 7);

    $check = $userTableClass->selectUser(
        fields:"user_code_verif",
        key:"user_code_verif = '$user_code_verif' LIMIT 1"
    );

    if($check['row'] > 0){
        return createCode();
    }else{
        return $user_code_verif;
    }
}

function validasiEmail($email) {
    // Gunakan filter_var untuk memvalidasi email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true; // Format email valid
    } else {
        return false; // Format email tidak valid
    }
}