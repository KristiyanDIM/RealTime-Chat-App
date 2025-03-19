<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . "/RealTime Chat App/php/config.php";

if (!isset($_SESSION['unique_id'])) {
    header("location: php/login.php");
    exit();
}

include_once "../header.php";

$unique_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'") or die(mysqli_error($conn));

if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
} else {
    die("⚠️ No user found with this ID! Please log in again.");
}

if (isset($_POST['update'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Ако потребителят е въвел нова парола
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
        $password = $row['password'];  // Ако не е въведена нова парола, оставяме старата
    }

    // Обработка на каченото изображение
    if (!empty($_FILES['image']['name'])) {
        $img_name = $_FILES['image']['name'];
        $img_tmp = $_FILES['image']['tmp_name'];
        $img_size = $_FILES['image']['size'];
        $img_error = $_FILES['image']['error'];

        // Определяне на пътя за запис
        $target_dir = "php/images/";
        $target_file = $target_dir . basename($img_name);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Проверка дали изображението е от правилния тип
        $allowed_types = array('jpg', 'jpeg', 'png');
        if (!in_array($imageFileType, $allowed_types)) {
            echo "Грешка: Подкрепят се само изображения с разширение .jpg, .jpeg или .png.";
        } elseif ($img_size > 5000000) { // 5MB ограничение за размер на изображението
            echo "Грешка: Файлът е твърде голям. Максимален размер е 5MB.";
        } elseif ($img_error !== 0) {
            echo "Грешка: Проблем при качването на снимката.";
        } else {
            // Опитваме се да преместим файла в целевата директория
            if (move_uploaded_file($img_tmp, $target_file)) {
                $img_name = basename($img_name);  // Ако качването е успешно
            } else {
                echo "Грешка: Не можем да преместим снимката в папката за качване.";
            }
        }
    } else {
        // Ако няма ново изображение, запазваме старото
        $img_name = $row['img'];
    }

    // Изпълнение на SQL заявката за актуализация
    $update_query = "UPDATE users SET fname='{$fname}', lname='{$lname}', email='{$email}', password='{$password}', img='{$img_name}' WHERE unique_id='{$unique_id}'";
    
    if (mysqli_query($conn, $update_query)) {
        header("Location: ../users.php");
        exit();
    } else {
        echo "❌ Грешка при актуализирането на профила.";
    }
}
?>

<?php include_once "../header.php"; ?>

<body>
    <div class="wrapper">
        <section class="form edit-profile">
            <header>Редактиране на профил</header>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="field input">
                    <label>Име</label>
                    <input type="text" name="fname" value="<?php echo $row['fname']; ?>" required>
                </div>
                <div class="field input">
                    <label>Фамилия</label>
                    <input type="text" name="lname" value="<?php echo $row['lname']; ?>" required>
                </div>
                <div class="field input">
                    <label>Имейл</label>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
                </div>
                <div class="field input">
                    <label>Нова парола (по желание)</label>
                    <input type="password" name="password">
                </div>
                <div class="field image">
                    <label>Нова снимка (по желание)</label>
                    <input type="file" name="image" accept="image/*">
                </div>
                <div class="field button">
                    <input type="submit" name="update" value="Запази промените">
                </div>
            </form>
        </section>
    </div>
</body>
</html>
