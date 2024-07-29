<?php
session_start();
require_once('../requires/db_config.php');
require_once('../requires/queries.php');

$extensions = ['png', 'jpeg', 'jpg'];

if ($pdo) {
    if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_FILES['image'])) {
        $fname = htmlspecialchars($_POST['fname']);
        $lname = htmlspecialchars($_POST['lname']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        // $image_type = $_FILES['image']['type'];
        $image_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $exploded_img = explode('.', $image_name);
        $img_ext = end($exploded_img);

        $stmt = $pdo->prepare($get_email_sql);
        $stmt->execute(['email' => $email]);
        $email_rows = $stmt->rowCount();
        // validate email and ensure it doesn't already exist
        if(!filter_var($email, FILTER_VALIDATE_EMAIL) ){
            echo 'Use a valid email';
            exit();
        }elseif ($email_rows > 0){
            echo 'Email already exists!';
            exit();
        }
        //    Check if uploaded image matches with accepted extensions
        if (in_array($img_ext, $extensions)) {
            // use timestamp to create unique file names for uploaded image
            $new_img_name = time().$image_name;

            // upload image
            if (move_uploaded_file($tmp_name, "../resources/images/profile_images/" . $new_img_name)) {
                // change user's status to active once signed up
                $status = "Online";
                // create unique id for the user
                $unique_id = rand(time(), 1000);

                $stmt = $pdo->prepare($signup_sql);
                $data_bind = [
                    'unique_id' => $unique_id,
                    'fname' => $fname,
                    'lname' => $lname,
                    'email' => $email,
                    'password' => $password,
                    'image' => $new_img_name,
                    'status' => $status
                ];
            
                // check if data has been inserted then login user
                if($stmt->execute($data_bind)){
                 
                    $stmt = $pdo->prepare($login_sql);
                    $stmt->execute(['email' => $email, 'password' => $password]);
                    if($stmt->rowCount() > 0){
                        $row = $stmt->fetch();
                        $_SESSION['unique_id'] = $row['unique_id'];
                        echo 'success';
                    }
                }
            }else{
                echo 'error saving image. Please try again';
            }
        }else{
            echo 'Please use a valid image format - png, jpg or jpeg';
        }





        // header('Location: ../users.php');

    } else {
        echo 'All fields are required';
    }
} else {
    echo 'error';
}
