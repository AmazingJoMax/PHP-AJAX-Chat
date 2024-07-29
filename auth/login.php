<?php 

session_start();
require_once('../requires/db_config.php');
require_once('../requires/queries.php');

$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

if($pdo){
    if(!empty($email) && !empty($password)){
        $stmt = $pdo->prepare($login_sql);
        if($stmt->execute(['email' => $email, 'password' => $password]) && $stmt->rowCount() > 0){
            $user = $stmt->fetch();
            $_SESSION['unique_id'] = $user['unique_id'];
            $stmt2 = $pdo->prepare($update_status_sql);
            $stmt2->execute(['unique_id' => $_SESSION['unique_id'], 'status' => 'online']);
            echo 'success';
        }else{
            echo 'Incorrect username or password';
        }
    }else{
        echo 'All fields are required';
    }
}else{
    echo 'Error connecting to database';
}

?>