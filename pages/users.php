<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header('location: ./signup.php');
}

require('../requires/db_config.php');
require('../requires/queries.php');
include('../includes/header.php');

// get authenticated user data
$stmt = $pdo->prepare($get_auth_user_info);
$stmt->execute(['unique_id' => $_SESSION['unique_id']]);
if($stmt->rowCount() > 0){
    $auth_user_info = $stmt->fetch();
    $fname = $auth_user_info['fname'];
    $lname = $auth_user_info['lname'];
    $image = $auth_user_info['image'];
    $status = $auth_user_info['status'];
}

?>

<div class="container users">
    <div class="auth-user">
        <div class="user-info">
            <div class="avatar">
                <img src="../resources/images/profile_images/<?php echo $image ?>" alt="">
            </div>
            <div class="details">
                <span class="name"><?php echo $fname.' '.$lname ?></span>
                <small class="status"><?php echo $status ?></small>
            </div>
        </div>
        <form action="../auth/logout.php" method="post">
            <button name="logout">Logout</button>
        </form>
    </div>
    <hr>
    <form method="post" class="search-bar">
        <input type="text" name="search" placeholder="Search users...">
        <!-- <button>Search</button> -->
    </form>
    <div class="users-list">
       
    </div>
</div>
<script src="../users.js"></script>
<?php
include('../includes/footer.php');
?>