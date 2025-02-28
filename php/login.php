<?php 
session_start();
include_once "config.php";

// Проверка дали връзката с базата данни работи
if (!$conn) {
    die("❌ Database connection error: " . mysqli_connect_error());
}

// Проверяваме дали заявката е POST и дали полетата са попълнени
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['email']) && isset($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
    } else {
        echo "All input fields are required!";
        exit();
    }
} else {
    echo "Invalid request!";
    exit();
}

// Търсим потребителя в базата
$sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");

if(mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    $enc_pass = $row['password'];

    // Проверяваме паролата
    if(password_verify($password, $enc_pass)) {  
        $status = 'online';
        $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");

        if($sql2) {
            $_SESSION['unique_id'] = $row['unique_id'];
            session_write_close();
            echo "success";
        } else {
            echo "Something went wrong. Please try again!";
        }
    } else {
        echo "Email or Password is not correct!";
    }
} else {
    echo "$email - This email does not exist!";
}
?>
