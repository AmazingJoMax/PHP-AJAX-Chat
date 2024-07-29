<?php
session_start();

require('./db_config.php');
require('./queries.php');

if (isset($_POST['search']) && isset($_SESSION['unique_id'])) {
    // Get filtered users
    $search = '%' . htmlspecialchars($_POST['search']) . '%';
    $unique_id = $_SESSION['unique_id'];

    $stmt = $pdo->prepare($search_sql);
    $stmt->execute(['search' => $search, 'unique_id' => $unique_id]);
    if ($stmt->rowCount() > 0) {
        $users = $stmt->fetchAll();
        foreach ($users as $user) {
            // Get last message
            $stmt2 = $pdo->prepare($last_msg_sql);
            $stmt2->execute(['outgoing_id' => $unique_id, 'incoming_id' => $user['unique_id']]);
            if ($stmt2->rowCount() > 0) {
                $last_msg = $stmt2->fetch();
                // Check if the message is sent by the authenticated user
                if ($last_msg['outgoing_id'] == $unique_id) {
                    $last_msg['message'] = '<b>You:</b> ' . $last_msg['message'];
                }
            } else {
                $last_msg['message'] = '<i>No messages</i>';
            }
            // Check user status to display status-dot
            $status = '';
            if ($user['status'] == 'online') {
                $status = "<div class='status-dot'></div>";
            }
            echo "
            <a href='./chat.php?id=" . $user['unique_id'] . "' class='user'>
            <div class='user-inner-cont'>
                <div class='avatar'>
                    <img src='../resources/images/profile_images/" . $user['image'] . "' alt''>
                </div>
                <div class='details'>
                    <span class='name'>" . $user['fname'] . ' ' . $user['lname'] . "</span>
                    <small class='msg-preview'>" . $last_msg['message'] . "</small>
                </div>
            </div>
            
            ".$status."
        </a>
            ";
        }
    } else {
        echo 'No users with the name ' . $search;
    }
} else {
    // get all users in the database
    $stmt2 = $pdo->prepare($get_all_users);
    $stmt2->execute(['unique_id' => $_SESSION['unique_id']]);
    if ($stmt2->rowCount() > 0) {
        $users = $stmt2->fetchAll();
        foreach ($users as $user) {
            var_dump($user);
            echo "
            <a href='./chat.php?id=" . $user['unique_id'] . "' class='user'>
            <div class='user-inner-cont'>
                <div class='avatar'>
                    <img src='../resources/images/profile_images/" . $user['image'] . "' alt''>
                </div>
                <div class='details'>
                    <span class='name'>" . $user['fname'] . ' ' . $user['lname'] . "</span>
                    <small class='msg-preview'>message</small>
                </div>
            </div>
            <div class='status-dot'></div>
        </a>
            ";
        }
    }
}
