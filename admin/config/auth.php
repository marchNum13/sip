<?php  
// check login status
if($_SESSION['login_admin_sip'] == true){
    header('Location: dasbor');
    exit();
}

$usernameAdmin = "adminSip2024";
$passAdmin = password_hash("adminSip2024", PASSWORD_DEFAULT);

$alertError = "";

if(isset($_POST['loginAdmin'])){
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));

    if($username == "" || $password == ""){
        sleep(2);
        $alertError = "Usernama atau password anda salah";
    }else{
        if($username != $usernameAdmin || !password_verify($password, $passAdmin)){
            sleep(2);
            $alertError = "Usernama atau password anda salah";
        }else{
            sleep(2);
            $_SESSION["alertSuccess"] = "Login berhasil";
            $_SESSION["login_admin_sip"] = true;
            header('Location: dasbor');
            exit();
        }
    }
}