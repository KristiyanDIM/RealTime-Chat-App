<?php
session_start();
include_once "php/config.php";

if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
    exit();
}
?>

<?php
include_once "header.php";
?>

<body>

    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">

                    <?php
                    if (isset($_SESSION['unique_id'])) {
                        $unique_id = $_SESSION['unique_id'];
                        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = '{$unique_id}'") or die(mysqli_error($conn));

                        if (mysqli_num_rows($sql) > 0) {
                            $row = mysqli_fetch_assoc($sql);
                        } else {
                            die("⚠️ No user found with this ID! Please log in again.");
                        }
                    } else {
                        die("⚠️ Session expired. Please log in again.");
                    }
                    ?>

                    <img src="php/images/<?php echo $row['img'];  ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname'] . " " . $row['lname']; ?></span>
                        <p><?php echo $row['status']; ?></p>
                    </div>
                </div>

                <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search... ">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
            </div>
        </section>
    </div>

    <script type="text/javascript" src="js/users.js"></script>
</body>

</html>