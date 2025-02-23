<?php  
// check login status
if($_SESSION['login_sip'] == true){
    header('Location: dasbor');
    exit();
}
include "admin/database/connMySQLClass.php";
include "admin/database/userTableClass.php";

$userTableClass = new userTableClass();

$emailInput = "";
$v = "";
if(isset($_GET['email']) && isset($_GET['v'])){
    $emailInput = trim(htmlspecialchars($_GET['email']));
    $v = $_GET['v'];
    if(!validasiEmail($emailInput)){
        header('Location: index');
        exit();
    }else{
        $checkEmail = $userTableClass->selectUser(
            fields: "user_code_verif",
            key: "email = '$emailInput' LIMIT 1"
        );
        if($checkEmail['row'] == 0){
            header('Location: index');
            exit();
        }else{
            $code = $checkEmail['data'][0]['user_code_verif'];
            if($code == ""){
                header('Location: index');
                exit();
            }else{
                if(!password_verify($code, $v)){
                    header('Location: index');
                    exit();
                }
            }
        }
    }
}else{
    header('Location: index');
    exit();
}
$alertError = "";
if(isset($_POST['resetPass'])){
    $passwordBaru = trim(htmlspecialchars($_POST['pass']));
    $passwordKonfir = trim(htmlspecialchars($_POST['passConfirm']));

    if($passwordBaru == "" || $passwordKonfir == ""){
        sleep(2);
        $alertError = "Data tidak boleh kosong!";
    }else{
        if($passwordBaru != $passwordKonfir){
            sleep(2);
            $alertError = "Password tidak sesuai";
        }else{
            $passToHash = password_hash($passwordBaru, PASSWORD_DEFAULT);
            $updatePass = $userTableClass->updateUser(
                dataSet: "password = '$passToHash'",
                key: "email = '$emailInput'"
            );
            if($updatePass){
                sleep(2);
                $_SESSION["alertSuccess"] = "Password berhasil diubah! Silahkan Login.";
                header('Location: index');
                exit();
            }
        }
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