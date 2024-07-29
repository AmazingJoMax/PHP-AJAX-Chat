<?php
session_start();
if(!isset($_SESSION['unique_id'])){
    header('location: ./signup.php');
}

require('../requires/db_config.php');
require('../requires/queries.php');

$session_id = $_SESSION['unique_id'];

// Get recipient user
$reciepient_id = $_GET['id'];
$user_stmt = $pdo->prepare($get_user_by_id);
$user_stmt->execute(['id' => $reciepient_id]);
$user = $user_stmt->fetch();

require('../requires/store_chats.php');
// require('../requires/get_chats.php');
include('../includes/header.php');


?>

<div class="container chats">
    <header class="chats-header">
        <a href="users.php"><</a>

        <div class="avatar">
            <img src="../resources/images/profile_images/<?php echo $user['image'] ?>" alt="">
        </div>
        <div class="details">
            <span class="name"><?php echo $user['fname'].' '.$user['lname'] ?></span>
            <small class="status"><?php echo $user['status'] ?></small>
        </div>
    </header>
    <div class="chat-box">
        
    </div>
    <div class="message-input">
        <form action="">
            <input type="text" name="outgoing_id" value="<?php echo $session_id ?>" hidden>
            <input type="text" name="incoming_id" value="<?php echo $user['unique_id'] ?>" hidden>
            <input type="text" name="message" id="message" placeholder="Message">
            <button>GO</button>
        </form>
    </div>
</div>
<script src="../chat.js"></script>

<?php
include('../includes/footer.php');
?>