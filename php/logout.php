<?php
session_start();
include_once "config.php";

if (isset($_SESSION['unique_id'])) {
    $unique_id = $_SESSION['unique_id'];

    echo "Unique ID: " . $unique_id . "<br>"; // Тестови изход

    $sql = mysqli_query($conn, "UPDATE users SET status = 'offline now' WHERE unique_id = '{$unique_id}'");

    if ($sql) {
        echo "Status updated successfully.<br>"; // Тестови изход
        session_unset();
        session_destroy();
        header("Location: ../login.php");
    } else {
        echo "❌ Error updating status: " . mysqli_error($conn); // Покажи евентуална грешка
    }
} else {
    header("location: ../login.php");
    exit();
}
?>