<?php
include "conn.php";
//session_start();

$me = $_SESSION['acc_id'];
$other = $_GET['user'];

// Load user profile
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM accounts WHERE acc_id='$other'"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Chat</title>

<style>
body {
    background: #0f0f0f;
    color: white;
    font-family: 'Poppins', sans-serif;
    margin: 0;
}

/* Chat Header */
.chat-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px;
    background: rgba(17,17,17,0.9);
    border-bottom: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(8px);
    position: sticky;
    top: 0;
    z-index: 100;
}
.chat-header img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ff004c;
    box-shadow: 0 0 10px #ff004c7c;
}

/* Chat Box */
#chatBox {
    height: 75vh;
    overflow-y: auto;
    padding: 15px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    background: #0a0a0a;
}

/* My Message */
.my-msg {
    background: linear-gradient(135deg, #ff004c, #ffae00);
    color: #fff;
    padding: 12px 16px;
    border-radius: 20px 20px 4px 20px;
    margin-left: auto;
    margin-bottom: 10px;
    max-width: 65%;
    word-wrap: break-word;
    font-size: 14px;
    line-height: 1.4;
}

/* Their Message */
.their-msg {
    background: rgba(255,255,255,0.05);
    color: #fff;
    padding: 12px 16px;
    border-radius: 20px 20px 20px 4px;
    margin-bottom: 10px;
    max-width: 65%;
    word-wrap: break-word;
    font-size: 14px;
    line-height: 1.4;
    border: 1px solid rgba(255,255,255,0.1);
}

/* Send Box */
.send-box {
    display: flex;
    padding: 12px;
    background: rgba(17,17,17,0.9);
    backdrop-filter: blur(8px);
    gap: 10px;
    border-top: 1px solid rgba(255,255,255,0.1);
    position: sticky;
    bottom: 0;
}
.send-box input {
    flex: 1;
    padding: 12px 15px;
    border-radius: 25px;
    background: rgba(255,255,255,0.1);
    border: none;
    color: white;
    outline: none;
}
.send-box input::placeholder {
    color: #ccc;
}
.send-box button {
    background: linear-gradient(135deg, #ff004c, #ffae00);
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 25px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.3s;
}
.send-box button:hover {
    transform: scale(1.05);
}

/* Scrollbar */
#chatBox::-webkit-scrollbar {
    width: 6px;
}
#chatBox::-webkit-scrollbar-thumb {
    background: rgba(255,0,76,0.6);
    border-radius: 3px;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>

<!-- Header -->
<div class="chat-header">
    <img src="uploads/<?php echo ($user['acc_profile_photo'] ?? 'default2.png'); ?>">
    <b>@<?php echo $user['acc_username']; ?></b>
</div>

<!-- Chat Messages -->
<div id="chatBox">
    <?php
    // Load initial messages inside the chat box
    $sql = "SELECT * FROM messages 
            WHERE (sender_id='$me' AND receiver_id='$other')
               OR (sender_id='$other' AND receiver_id='$me')
            ORDER BY created_at ASC";
    $result = mysqli_query($conn, $sql);

    // mark messages as read
    mysqli_query($conn, "UPDATE messages SET is_read=1 
                         WHERE sender_id='$other' AND receiver_id='$me'");

    while ($msg = mysqli_fetch_assoc($result)) {
        if ($msg['sender_id'] == $me) {
            echo '<div class="my-msg">' . htmlspecialchars($msg['message_text']) . '</div>';
        } else {
            echo '<div class="their-msg">' . htmlspecialchars($msg['message_text']) . '</div>';
        }
    }
    ?>
</div>

<!-- Send Message -->
<div class="send-box">
    <input type="text" id="message" placeholder="Type a message...">
    <button onclick="sendMessage()">Send</button>
</div>

<script>
// Load chat every 1 second
setInterval(loadChat, 1000);
loadChat();

function loadChat() {
    $("#chatBox").load("load_messages.php?user=<?php echo $other; ?>", function() {
        var chatBox = document.getElementById("chatBox");
        chatBox.scrollTop = chatBox.scrollHeight; // scroll to bottom
    });
}

function sendMessage() {
    let msg = $("#message").val();
    if(msg.trim() === "") return;

    $.post("send_message.php", {
        receiver_id: "<?php echo $other; ?>",
        message: msg
    }, function() {
        $("#message").val("");
        var chatBox = document.getElementById("chatBox");
        chatBox.scrollTop = chatBox.scrollHeight; // scroll to bottom after sending
    });
}

// Press Enter to send
$("#message").keypress(function(e) {
    if(e.which == 13) {
        sendMessage();
        return false;
    }
});
</script>

</body>
</html>
