<?php
require 'conn.php';

$selectuser = "SELECT * FROM accounts";
$res = $conn->query($selectuser);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Table</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }
        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #1f2937;
            color: #fff;
            font-size: 16px;
        }
        tr:hover {
            background: #f1f1f1;
        }
        .btn {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            color: white;
        }
        .update {
            background: #3498db;
        }
        .delete {
            background: #e74c3c;
        }
    </style>
</head>

<body>
    <h2 style="text-align:center;">User Details Table</h2>
    <form action="index.php" method="post">
    <button class="edit-btn" name="follow_btn" style="background:#0095f6;">Back</button>
    </form>

<table>
    <tr>
        <th>Account Id </th>
        <th>User Id </th>
        <th>Account profile photo </th>
        <th>Account Bio </th>
        <th>Account username</th>
        <th>Account Password</th>
        <th>Action</th>
    </tr>

    <?php
    while ($row = $res->fetch_assoc()) {
        echo "<tr>
                <td>{$row['acc_id']}</td>
                <td>{$row['user_id']}</td>
                <td>{$row['acc_profile_photo']}</td>
                <td>{$row['acc_bio']}</td>
                <td>{$row['acc_username']}</td>
                <td>{$row['acc_password']}</td>
                <td>

                    <a class='btn update' href='view_profile.php?id={$row['acc_id']}'>View</a>
                    <a class='btn update' href='update_account.php?id={$row['acc_id']}'>Update</a>
                    <a class='btn delete' href='delete_account.php?id={$row['acc_id']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                </td>
              </tr>";
    }
    ?>

</table>

</body>
</html>
