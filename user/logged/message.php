<?php
include "conn.php";
session_start();

$me = $_SESSION['acc_id'];

$sql = "SELECT DISTINCT 
            IF(sender_id=$me, receiver_id, sender_id) AS user_id
        FROM messages
        WHERE sender_id=$me OR receiver_id=$me";

$result = mysqli_query($conn, $sql);
?>
<div>
<h2>Messages</h2>
<?php while ($u = mysqli_fetch_assoc($result)) {
    $uid = $u['user_id'];
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM accounts WHERE user_id='$uid'"));
?>
    <a href="chat.php?user=<?php echo $uid; ?>">
        <div style="display:flex;gap:10px;margin:10px;">
            <img src="uploads/<?php echo $user['acc_profile_photo']; ?>" width="50">
            <b>@<?php echo $user['acc_username']; ?></b>
        </div>
    </a>
<?php } ?>
</div>
