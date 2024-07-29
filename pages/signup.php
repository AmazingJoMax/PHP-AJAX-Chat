<?php
include('../includes/header.php');
?>

<div class="container signup">
    <h2>Sign Up</h2>
    <div class="error">This is an error</div>
    <form method="post" enctype="multipart/form-data">
        <div class="name-group">
            <div class="form-control">
                <label for="">First Name</label>
                <input type="text" name="fname">
            </div>
            <div class="form-control">
                <label for="">Last Name</label>
                <input type="text" name="lname">
            </div>
        </div>
        <div class="form-control">
            <label for="">Email</label>
            <input type="email" name="email">
        </div>
        <div class="form-control">
            <label for="">Password</label>
            <div class="password-field">
                <input type="password" name="password">
                <i class=""></i>
            </div>
        </div>
        <div class="form-control">
            <label for="">Profile Image</label>
            <input type="file" name="image">
        </div>
        <button type="submit">Sign Up</button>
        <a href="login.php">already have an account?</a>

    </form>
</div>
<script src="../auth/auth.js"></script>

<?php
include('../includes/footer.php');
?>