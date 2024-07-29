<?php 
session_start();

require('../requires/db_config.php');
require('../requires/queries.php');

$session_id = $_SESSION['unique_id'];
$reciepient_id = $_POST['incoming_id'];

// Get messages
$output = "";
if(isset($session_id)){
    $incoming_id = $reciepient_id;
    $outgoing_id = $session_id;
    
    $chats_stmt = $pdo->prepare($get_msg_sql);
    $chats_stmt->execute(['incoming_id' => $incoming_id, 'outgoing_id' => $outgoing_id]);
    if($chats_stmt->rowCount() > 0){
        $chats = $chats_stmt->fetchAll();
        foreach($chats as $chat){
            if($chat['outgoing_id'] == $outgoing_id){
                $output .="<div class='chat-bubble outgoing'>".$chat['message']."</div>";
            }else{
                $output .="<div class='chat-bubble incoming'>".$chat['message']."</div>";
            }
        }
    }else{
        echo '<div class="no-messages">No messages </div>';
    }

    echo $output;
}

?>
