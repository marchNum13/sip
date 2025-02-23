<?php  
// check login status
if($_SESSION['login_admin_sip'] != true){
    header('Location: index');
    exit();
}

include "database/connMySQLClass.php";
include "database/userTableClass.php";

$userTableClass = new userTableClass();

$countUser = countUser();

function countUser(){
    global $userTableClass;

    $data = $userTableClass->selectUser(
        fields: "COUNT(id) AS total",
        key: "1"
    )['data'][0]['total'];

    return $data;
}