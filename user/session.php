<?php
session_start();
//if need than uncomment it ..
// $_SESSION["user_name"] = "Meet";
// $_SESSION["user_id"] = "1";
// if (isset($_SESSION["user_id"]) && !$_SESSION["acc_id"]) {
// //    header("Location:show_account.php");
// //    echo '<pre>';
// //    var_dump($_SESSION);
// //    echo '</pre>';
// }   
// elseif (!(isset($_SESSION["acc_id"]) && $_SESSION["user_id"])) {
//     header("Location:login.php");
//     // echo '<pre>';
//     // var_dump($_SESSION);
//     // echo '</pre>';

// }
//  elseif (isset($_SESSION["acc_id"]) && $_SESSION["user_id"]) {
//     header("Location:logged/home.php");
// // echo '<pre>';
// //     var_dump($_SESSION);
// //     echo '</pre>';

// }
// else{
//     echo '<pre>';
//     var_dump($_SESSION);
//     echo '</pre>';
// }

$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$request_uri = $_SERVER['REQUEST_URI'];

// echo $request_uri;



if (isset($_SESSION["user_id"]) && isset($_SESSION["acc_id"])) {

    header("Location:logged/home.php");
} elseif (isset($_SESSION["user_id"]) && !isset($_SESSION["acc_id"])) {
    if ($request_uri != '/kmsta/user/show_account.php') {
        header("Location:show_account.php");
    }
    //    
//    echo '<pre>';
//    var_dump($_SESSION);
//    echo '</pre>';
} elseif (!(isset($_SESSION["acc_id"]) && $_SESSION["user_id"])) {
    if ($request_uri != '/kmsta/user/login.php') {
        header("Location:login.php");
    }
    
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';

}



?>