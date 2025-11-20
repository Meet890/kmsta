<?php
// session_start();
if (isset($_SESSION["user_id"]) && !$_SESSION["acc_id"]) {
   header("Location:../show_account.php");
//    echo '<pre>';
//    var_dump($_SESSION);
//    echo '</pre>';
}   
elseif (!(isset($_SESSION["acc_id"]) && $_SESSION["user_id"])) {
    header("Location:../login.php");
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';

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