<?php
session_start();
include_once "config.php";

$outgoing_id = $_SESSION['unique_id'];
$searchTerm = isset($_POST['searchTerm']) ? mysqli_real_escape_string($conn, $_POST['searchTerm']) : "";

// Променлива за резултата
$output = "";

// Масив за проследяване на уникални потребители
$uniqueUsers = [];

// SQL заявка за извличане на потребители, които имат съобщения с текущия потребител
$sql = "SELECT DISTINCT u.unique_id, u.fname, u.lname, u.status, u.img 
        FROM users u 
        LEFT JOIN messages m 
        ON (m.incoming_msg_id = u.unique_id OR m.outgoing_msg_id = u.unique_id)
        WHERE u.unique_id != {$outgoing_id} 
        AND (u.fname LIKE '%{$searchTerm}%' OR u.lname LIKE '%{$searchTerm}%')";

$query = mysqli_query($conn, $sql);

// Проверяваме дали има резултати
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        // Проверка дали потребителят вече е добавен
        if (!in_array($row['unique_id'], $uniqueUsers)) {
            $uniqueUsers[] = $row['unique_id']; // Добавяне на потребителя в масива за уникални

            // SQL заявка за последното съобщение между потребителя и текущия
            $sql2 = "SELECT msg, outgoing_msg_id 
                     FROM messages 
                     WHERE (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']})
                     AND (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id})
                     ORDER BY msg_id DESC LIMIT 1";

            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);

            // Обработка на съобщението
            if (mysqli_num_rows($query2) > 0) {
                $result = $row2['msg'];
            } else {
                $result = "No messages available";
            }

            // Изрязване на съобщението, ако е твърде дълго
            $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;

            // Определяне на предходно съобщение, което е изпратил потребителя
            $you = "";
            if (isset($row2['outgoing_msg_id'])) {
                $you = ($outgoing_id == $row2['outgoing_msg_id']) ? "You: " : "";
            }

            $offline = ($row['status'] == "Offline now") ? "offline" : "";
            $hid_me = ($outgoing_id == $row['unique_id']) ? "hide" : "";

            // Път към изображението на потребителя
            $imagePath = "/REALTIME CHAT APP/php/images/" . $row['img'];

            // Извеждане на резултата
            $output .= '
            <a href="chat.php?user_id=' . $row['unique_id'] . '">
                <div class="content">
                    <img src="' . $imagePath . '" alt="">
                    <div class="details">
                        <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                        <p>' . $you . $msg . '</p>
                    </div>
                </div>
            </a>';
        }
    }
} else {
    // Ако няма резултати
    $output .= "❌ Няма резултати!";
}

// Извеждаме резултата
echo empty($output) ? "❌ Няма резултати!" : $output;
?>