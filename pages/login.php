<?php
include('../includes/header.php');
?>

<div class="container login">
    <h2>Login</h2>
    <div class="error">This is an error</div>
    <form action="" method="post">
        <div class="form-control">
            <label for="">Email</label>
            <input type="email" name="email">
        </div>
        <div class="form-control">
            <label for="">Password</label>
            <div class="password-field">
                <input type="password" name="password">
                <i></i>
            </div>
        </div>
        <button type="submit">Login</button>
        <a href="signup.php">don't have an account?</a>

    </form>
</div>
<script src="../auth/auth.js"></script>

<?php
include('../includes/footer.php');
?>