
<?php 

require_once __DIR__ . '/header.php'; 

?>

<section class="clearfix">
    <div class="container">

        <div class="login-form-parent">
            <h2 class="login-title">
                <img src="./assets/img/logo-image.png" alt="logo image">
            </h2>
            <form action="<?php echo htmlspecialchars( 'inc/core-login.php'); ?>" method="POST">

                <div class="login-field">
                    <label for="username">Username</label>
                    <input type="text" id="username">
                </div>

                <div class="login-field">
                    <label for="password">Password</label>
                    <input type="password" id="password">
                </div>

                <div class="login-field">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember me.</label>
                    <input type="submit" value="Login Now">
                    <a href="javascript:void(0)" class="forget-password">Forget Password</a>
                </div>

            </form>
        </div>
        
    </div>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>