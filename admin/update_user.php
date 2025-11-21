<!DOCTYPE html>
<html>

<head>
    <title>Update User Details</title>
</head>

<body>
    <h2>Update Your Details</h2>
    <form action="" method="post">
        
        <label>Name:</label><br>
        <input type="text" name="user_name" required><br><br>

        <label>Age:</label><br>
        <input type="number" name="user_age" required><br><br>

        <label>Gender:</label><br>
        <select name="user_gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br><br>

        <label>Phone:</label><br>
        <input type="text" name="user_ph" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="user_email" required><br><br>

        <label>Date of Birth:</label><br>
        <input type="date" name="user_dob" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="user_password" required><br><br>

        <input type="submit" name="submit" value="Update">
    </form>
</body>

</html>
<?php
require 'conn.php';
$user_id = $_GET['id'];
if(isset($_POST['submit'])){

$sql = "select* from user_details where user_id = $user_id ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    $user_name = $_POST['user_name'];
    $user_age = $_POST['user_age'];
    $user_gender = $_POST['user_gender'];
    $user_phno = $_POST['user_ph'];
    $user_email = $_POST['user_email'];
    $user_dob = $_POST['user_dob'];
    $user_password = $_POST['user_password'];


}





$sql_up = "update user_details set 
user_name = '$user_name',
user_age = '$user_age',
user_gender = '$user_gender',
user_ph = '$user_phno',
user_email = '$user_email',
user_dob = '$user_dob',
user_password = '$user_password' where user_id = '$user_id' ";

if ($conn->query($sql_up) === true) {
    echo "updated";
} else {
    echo "error";
}
}
$conn->close();
?>