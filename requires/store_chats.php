<?php 


// Store messages
if(isset($_POST['message']) && !empty($_POST['message'])){
    $incoming_id = $_POST['incoming_id'];
    $outgoing_id = $_POST['outgoing_id'];
    $message = $_POST['message'];
    
    $chat_stmt = $pdo->prepare($save_msg_sql);
    $chat_stmt->execute(['incoming_id' => $incoming_id, 'outgoing_id' => $outgoing_id, 'message' => $message]);
}




?>