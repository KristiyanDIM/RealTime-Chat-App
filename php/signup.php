<?php
session_start();
include_once "config.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);


// Проверка дали `config.php` работи
if (!isset($conn)) {
    die("Database connection failed!");
}

$fname = mysqli_real_escape_string($conn, $_POST['fname'] ?? '');
$lname = mysqli_real_escape_string($conn, $_POST['lname'] ?? '');
$email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
$password = mysqli_real_escape_string($conn, $_POST['password'] ?? '');

// Проверка дали всички полета са попълнени
if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Проверка за съществуващ email
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'") or die(mysqli_error($conn));
        if (mysqli_num_rows($sql) > 0) {
            echo "$email - This email already exists";
        } else {
            if (isset($_FILES['image'])) {
                $img_name = $_FILES['image']['name'];
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];

                $img_explode = explode('.', $img_name);
                $img_ext = strtolower(end($img_explode));

                $allowed_extensions = ["jpeg", "png", "jpg"];
                $allowed_types = ["image/jpeg", "image/png", "image/jpg"];

                if (in_array($img_ext, $allowed_extensions) && in_array($img_type, $allowed_types)) {
                    $time = time();
                    $new_img_name = $time . "_" . $img_name;

                    if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                        $ran_id = rand(time(), 100000000);
                        $status = "Online";
                        $encrypt_pass = password_hash($password, PASSWORD_DEFAULT);

                        // Вмъкване на потребител
                        $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                            VALUES ('{$ran_id}', '{$fname}', '{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$status}')");

                        if ($insert_query) {
                            $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'") or die(mysqli_error($conn));

                            if (mysqli_num_rows($select_sql2) > 0) {
                                $result = mysqli_fetch_assoc($select_sql2);
                                $_SESSION['unique_id'] = $result['unique_id'];
                                echo "success";
                            } else {
                                echo "This email address does not exist";
                            }
                        } else {
                            die("Error inserting user: " . mysqli_error($conn));
                        }
                    } else {
                        die("Error moving uploaded file");
                    }
                } else {
                    echo "Please upload an image file - jpeg, png, jpg";
                }
            } else {
                echo "Please upload an image";
            }
        }
    } else {
        echo "$email is not a valid email!";
    }
} else {
    echo "All input fields are required!";
}
?>