<?php
// session_start();

$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$request_uri = $_SERVER['REQUEST_URI'];



if (isset($_SESSION["user_id"]) && !$_SESSION["acc_id"]) {
    if ($request_uri != '/kmsta/user/show_account.php') {
         header("Location:../show_account.php");
    }
  
//    echo '<pre>';
//    var_dump($_SESSION);
//    echo '</pre>';
}   
elseif (!(isset($_SESSION["acc_id"]) && $_SESSION["user_id"])) {
    if ($request_uri != '/kmsta/user/login.php') {
        header("Location:../login.php");
    }
    
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';
    
}elseif(!isset($_SESSION["role"]) || $_SESSION["role"] != "user") {
    header("Location: ../login.php");
    exit();
}
elseif (isset($_SESSION["acc_id"]) && $_SESSION["user_id"]) {
    
    
    
    // header("Location:home.php");
    // echo '<pre>';
    //     var_dump($_SESSION);
    //     echo '</pre>';
    
}
else{
    echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>';
}





?>