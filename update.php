
<?php 
if( ! isset($_REQUEST['user-update']) ) {
    header('Location: index.php');
    exit;
}

if( ! isset( $_REQUEST['user-update'] ) || empty( $_REQUEST['user-update'] ) || $_REQUEST['user-update'] == '' || $_REQUEST['user-update'] == null ){
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/header.php'; 

// get updateble user id
$user_id = $_REQUEST['user-update'];

$get_result_sql = "SELECT * FROM app_users WHERE id = :user_id";

$result = $pdo->prepare( $get_result_sql );

$result->bindParam(':user_id', $user_id, PDO::PARAM_INT);

$result->execute();

if( $result->rowCount() !== 1 ){
    header('Location: index.php');
    exit;
}

while( $row = $result->fetch(PDO::FETCH_ASSOC)): ?>

<section class="clearfix">
    <div class="container">
        <div class="p-form app-title"><h1>User Update Form</h1></div>
        <div class="p-form">
            <form class="register-form" action="<?php echo htmlspecialchars( 'inc/core-update-user.php'); ?>" method="POST">

                <div class="item-box">

                    <label for="name">Name:</label>
                    <input type="text" id="name" name="user-name" value="<?php echo $row['full_name']; ?>">
                    
                </div>
                <div class="item-box">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="user-email" value="<?php echo $row['email_address']; ?>">
                    
                </div>
                <div class="item-box">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="user-phone" value="<?php echo $row['phone_number']; ?>">
                    
                </div>
                <div class="item-box message">
                    <label for="address">Address:</label>
                    <textarea name="user-address" id="address"><?php echo $row['user_address']; ?></textarea>
                </div>
                <div class="item-box">
                    <input type="hidden" name="user-id" value="<?php echo $row['id']; ?>">
                    <input type="submit" value="Add a new record" name="user-submit-update">
                </div>
                
            </form>
        </div>
    </div>
</section>

<?php endwhile;

require_once __DIR__ . '/footer.php';
