<?php
include "conn.php";
// session_start();

$me = $_SESSION['acc_id'];
$other = $_GET['user'];

// Load user profile
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM accounts WHERE acc_id='$other'"));
?>

<?php


$me = $_SESSION['acc_id'];
$other = $_GET['user'];

$sql = "SELECT * FROM messages 
        WHERE (sender_id='$me' AND receiver_id='$other')
           OR (sender_id='$other' AND receiver_id='$me')
        ORDER BY created_at ASC";
$result = mysqli_query($conn, $sql);

// mark messages as read
mysqli_query($conn, "UPDATE messages SET is_read=1 
                     WHERE sender_id='$other' AND receiver_id='$me'");
?>

<?php while ($msg = mysqli_fetch_assoc($result)) { ?>

    <?php if ($msg['sender_id'] == $me) { ?>
        <div class="my-msg"><?php echo $msg['message_text']; ?></div>
    <?php } else { ?>
        <div class="their-msg"><?php echo $msg['message_text']; ?></div>
    <?php } ?>

<?php } ?>



<!DOCTYPE html>
<html>
<head>
<title>Chat</title>

<style>
body { background:#0f0f0f; color:white; font-family:Poppins; margin:0; }

/* Chat Header */
.chat-header {
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px;
    background:#111;
    border-bottom:1px solid #333;
}
.chat-header img {
    width:45px; height:45px; border-radius:50%; object-fit:cover;
}

/* Chat Box */
#chatBox {
    height:75vh;
    overflow-y:auto;
    padding:15px;
    background:#000;
}

/* My Message */
.my-msg {
    background:#007bff;
    color:white;
    padding:10px;
    border-radius:12px 12px 0 12px;
    margin-left:auto;
    margin-bottom:10px;
    max-width:60%;
}

/* Their Message */
.their-msg {
    background:#222;
    color:white;
    padding:10px;
    border-radius:12px 12px 12px 0;
    margin-bottom:10px;
    max-width:60%;
}

/* Send Box */
.send-box {
    display:flex;
    padding:12px;
    background:#111;
}
.send-box input {
    flex:1; padding:10px; border-radius:8px;
    background:#222; border:none; color:white;
}
.send-box button {
    margin-left:10px; padding:10px 16px;
    background:#007bff; color:white;
    border:none; border-radius:8px;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>

<!-- Header -->
<div class="chat-header">
    <img src="uploads/<?php echo $user['acc_profile_photo']; ?>">
    <b>@<?php echo $user['acc_username']; ?></b>
</div>

<!-- Chat Messages -->
<div id="chatBox"></div>

<!-- Send Message -->
<div class="send-box">
    <input type="text" id="message" placeholder="Type a message...">
    <button onclick="sendMessage()">Send</button>
</div>

<script>
// Load chat every 1 second
setInterval(loadChat, 1000);
loadChat();

// Load chat messages
function loadChat() {
    $("#chatBox").load("load_messages.php?user=<?php echo $other; ?>");
}

// Send message
function sendMessage() {
    let msg = $("#message").val();
    if(msg.trim() === "") return;

    $.post("send_message.php", {
        receiver_id: "<?php echo $other; ?>",
        message: msg
    });

    $("#message").val("");
}
</script>

</body>
</html>
