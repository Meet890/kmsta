<?php
session_start();
//     [acc_id] => 107
//     [acc_username] => Meet890
//     [acc_profile_photo] => 
//     [acc_bio] => Hello i am meet 
$keys = ["acc_id", "acc_username", "acc_profile_photo", "acc_bio"];

// foreach ($keys as $key) {
//     unset($_SESSION[$key]);
// }
echo"<pre>";
print_r($_SESSION);
echo"</pre>";

header("Location:./show_account.php");
?>