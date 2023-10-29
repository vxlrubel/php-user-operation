
<?php 

require_once __DIR__ . '/header.php'; 

?>

<section class="clearfix">
    <div class="container">
        <div class="p-form app-title"><h1>Application Form</h1></div>
        <div class="p-form">

            <?php
                if( isset( $_GET['success'] ) )
                    printf( '<div class="success-message">%s</div>', $_GET['success'] );
             ?>
            <form class="register-form" action="<?php echo htmlspecialchars( 'inc/core-add-user.php'); ?>" method="POST">

                <div class="item-box">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="user-name">
                    <?php
                        if( isset( $_GET['error-user'] ) )
                            printf('<div class="error-message"> %s </div>', $_GET['error-user']);
                        ?>
                </div>
                <div class="item-box">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="user-email">
                    <?php
                        if( isset( $_GET['error-email'] ) )
                            printf('<div class="error-message"> %s </div>', $_GET['error-email']);
                        if( isset( $_GET['error-exists-email'] ) )
                            printf('<div class="error-message"> %s </div>', $_GET['error-exists-email']);
                        ?>
                </div>
                <div class="item-box">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="user-phone">
                    <?php
                        if( isset( $_GET['error-phone'] ) )
                            printf('<div class="error-message"> %s </div>', $_GET['error-phone']);
                        ?>
                </div>
                <div class="item-box message">
                    <label for="address">Address:</label>
                    <textarea name="user-address" id="address"></textarea>
                    <?php
                        if( isset( $_GET['error-address'] ) )
                            printf('<div class="error-message"> %s </div>', $_GET['error-address']);
                        ?>
                </div>
                <div class="item-box">
                    <input type="submit" value="Add a new record" name="user-submit-form">
                </div>
                
            </form>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>