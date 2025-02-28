<?php 
session_start();

if(!isset($_SESSION['unique_id'])) {
    header("location: login.php");  // Редирект към логин страницата ако няма сесия
    exit();
}

include_once "config.php";
$outgoing_id = $_SESSION['unique_id'];
$incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
$output = "";

// SQL заявка за получаване на съобщенията
$sql = "SELECT * FROM messages 
        LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id 
        WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id}) 
        OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) 
        ORDER BY msg_id";
$query = mysqli_query($conn, $sql);

if(mysqli_num_rows($query) > 0){
    while($row = mysqli_fetch_assoc($query)){
        if($row['outgoing_msg_id'] === $outgoing_id){
            $output .= '<div class="chat outgoing">
                        <div class="details">
                        <p>'.$row['msg'].'</p>
                        </div>
                    </div>';
        } else {
            $output .= '<div class="chat incoming">
                        <img src="php/images/'.$row['img'].'" alt="">
                        <div class="details">
                            <p>'.$row['msg'].'</p>
                        </div>
                    </div>';
        }
    }
} else {
    $output .= '<div class="text">No message are available. Once you send message they will appear here.</div>';
}

echo $output;

?>