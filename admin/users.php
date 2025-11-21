<?php
require 'conn.php';

$selectuser = "SELECT * FROM user_details";
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

<table>
    <tr>
        <th>User Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Phone</th>
        <th>Email</th>
        <th>DOB</th>
        <th>Action</th>
    </tr>

    <?php
    while ($row = $res->fetch_assoc()) {
        echo "<tr>
                <td>{$row['user_name']}</td>
                <td>{$row['user_age']}</td>
                <td>{$row['user_gender']}</td>
                <td>{$row['user_ph']}</td>
                <td>{$row['user_email']}</td>
                <td>{$row['user_dob']}</td>
                <td>
                    <a class='btn update' href='update_user.php?id={$row['user_id']}'>Update</a>
                    <a class='btn delete' href='delete_user.php?id={$row['user_id']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                </td>
              </tr>";
    }
    ?>

</table>

</body>
</html>
