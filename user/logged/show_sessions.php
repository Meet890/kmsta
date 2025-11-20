<?php
session_start();
include "check_sessions.php";
echo"<pre>";
print_r($_SESSION);
echo"</pre>";

?>