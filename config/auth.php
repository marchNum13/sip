<?php  
// check login status
if($_SESSION['login_sip'] == true){
    header('Location: dasbor');
    exit();
}
include "admin/database/connMySQLClass.php";
include "admin/database/userTableClass.php";

$userTableClass = new userTableClass();

$alertError = "";

if(isset($_POST['loginSip'])){
    $usernameEmail = trim(htmlspecialchars($_POST['usernameEmail']));
    $password = trim(htmlspecialchars($_POST['password']));

    if($usernameEmail == "" || $password == ""){
        sleep(2);
        $alertError = "Email / usernama atau password anda salah";
    }else{
        $passHash = "";
        $statusUser = "";
        $id_user = "";
        $nextLogin = false;
        $logInWithEmail = $userTableClass->loginMember($usernameEmail, "email");
        if($logInWithEmail['num'] > 0){
            $passHash = $logInWithEmail['password'];
            $statusUser = $logInWithEmail['status'];
            $id_user = $logInWithEmail['id_user'];
            $nextLogin = true;
        }else{
            $logInWithUsername = $userTableClass->loginMember($usernameEmail, "username");
            if($logInWithUsername['num'] > 0){
                $passHash = $logInWithUsername['password'];
                $statusUser = $logInWithUsername['status'];
                $id_user = $logInWithUsername['id_user'];
                $nextLogin = true;
            }else{
                sleep(2);
                $alertError = "Email / usernama atau password anda salah";
            }
        }

        if($nextLogin){
            if(!password_verify($password, $passHash)){
                sleep(2);
                $alertError = "Email / usernama atau password anda salah";
            }else{
                if($statusUser == "Tidak Aktif"){
                    sleep(2);
                    $alertError = "Akun anda belum diaktifkan!";
                }else{
                    sleep(2);
                    $_SESSION["alertSuccess"] = "Login berhasil";
                    $_SESSION["login_sip"] = true;
                    $_SESSION["id_user"] = $id_user;
                    header('Location: dasbor');
                    exit();
                }
            }
        }
    }
}
?>