<?php

namespace App;
use PDO;

/**
 * create a class called User which is allow to delete, update , add user and soone.
 * class User;
 * 
 * @link github.com/vxlrubel
 * @package User
 * @version 1.0
 * @since 1.0
 * @return void
 */
final class User {
    
    /**
     * Add new user
     *
     * @return void
     */
    public static function add(){

        global $pdo;
        if( ! isset($_GET['user-submit-form']) && $_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $user_name    = $_POST['user-name'];
        $user_email   = $_POST['user-email'];
        $user_phone   = $_POST['user-phone'];
        $user_address = $_POST['user-address'];
        $error        = '';
        if( empty( $user_name ) ){
            $error = 'error-user=Type username again.&';
        }
        if( empty( $user_email ) ){
            $error .= 'error-email=Enter valid email address.&';
        }
        if( empty( $user_phone ) ){
            $error .= 'error-phone=Enter the phone number.&';
        }
        if( empty( $user_address ) ){
            $error .= 'error-address=Enter  the address.';
        }
        if( $error != '' ){
            header('Location: ../register.php?'.$error);
            exit;
        }
        $check_sql = "SELECT * FROM app_users WHERE email_address = :email";

        $check_statement  = $pdo->prepare( $check_sql );
        $check_statement->bindParam( ':email', $user_email );
        $check_statement->execute();

        if( $check_statement->rowCount() !== 0 ){
            header('Location: ../register.php?error-exists-email=Email already exits.');
            exit;
        }

        $insert_query = "INSERT INTO app_users(full_name, email_address,phone_number,user_address) VALUES(:val_name, :val_email, :val_phone, :val_address)";

        $stetment = $pdo->prepare( $insert_query );

        $stetment->bindParam(':val_name', $user_name, PDO::PARAM_STR);
        $stetment->bindParam(':val_email', $user_email, PDO::PARAM_STR);
        $stetment->bindParam(':val_phone', $user_phone, PDO::PARAM_STR);
        $stetment->bindParam(':val_address', $user_address, PDO::PARAM_STR);

        $stetment->execute();

        header('Location: ../register.php?success=Add new record successfully.');

        exit;
    }
    /**
     * update resutl using id
     * @package Submit
     * @return void
     */
    public static function update() {
        global $pdo;
        $user_name    = $_REQUEST['user-name'];
        $user_email   = $_REQUEST['user-email'];
        $user_phone   = $_REQUEST['user-phone'];
        $user_address = $_REQUEST['user-address'];
        $user_id      = $_REQUEST['user-id'];

        if( !isset($_REQUEST['user-submit-update']) ){
            header( 'Location: ../update.php?user-update=' . $_REQUEST['user-id'] );
            exit;
        }

        if( $_SERVER['REQUEST_METHOD'] !== 'POST' ){
            header( 'Location: ../update.php?user-update=' . $user_id );
            exit;
        }

        $update_sql = "UPDATE app_users SET full_name = :name, email_address = :email, phone_number = :phone, user_address = :address WHERE id = :id";

        $result = $pdo->prepare( $update_sql );

        $result->bindParam( ':name', $user_name, PDO::PARAM_STR );
        $result->bindParam( ':email', $user_email, PDO::PARAM_STR );
        $result->bindParam( ':phone', $user_phone, PDO::PARAM_STR );
        $result->bindParam( ':address', $user_address, PDO::PARAM_STR );
        $result->bindParam( ':id', $user_id, PDO::PARAM_INT );

        $result->execute();

        header('Location: ../index.php?update-result=Update successfully.');

        exit;
    }

    /**
     * delete existing user if id is match
     *
     * @return void
     */
    public static function delete() {
        global $pdo;
        if( ! isset( $_REQUEST['delete-query']) ) exit();

        if( $_REQUEST['delete-query'] == '' || $_REQUEST['delete-query'] == null || empty( $_REQUEST['delete-query']) ) exit();

        // retrive the id from url
        $data_id = $_REQUEST['delete-query'];

        $del_sql = "DELETE FROM app_users WHERE id = :user_id";

        $statement = $pdo->prepare( $del_sql );
        $statement->bindParam(':user_id', $data_id, PDO::PARAM_INT);
        $statement->execute();

        header('Location: ../index.php?delete-success=You have Delete Successfully.');
        exit;

    }


    /**
     * create pagination
     *
     * @param [type] $current_page
     * @param [type] $total_page
     * @return void
     */
    public function pagination( $current_page, $total_page ) {

        self::paginate_before();

        // create previous page link
        if( $current_page > 1 ){
            printf( '<li><a href="?page=%d">&lt;</a></li>', $current_page -1 );
        }
        for ($i=1; $i <= $total_page ; $i++) { 
            if( $i == $current_page ){
                printf( '<li class="active"><a href="?page=%d">%d</a></li>', $i, $i );
            }else{
                printf( '<li><a href="?page=%d">%d</a></li>', $i, $i );
            }
        }

        // create next page link
        if( $current_page < $total_page ){
            printf( '<li><a href="?page=%d">&gt;</a></li>', $current_page + 1 );
        }
        
        self::paginate_after();
        
    }


    /**
     * paginate before elements
     *
     * @return void
     */
    public static function paginate_before(){
        echo "<nav class=\"pagination\"><ul>\n";
    }

    /**
     * paginate after elements
     *
     * @return void
     */
    public static function paginate_after(){
        echo "</ul>\n</nav>\n";
    }
    
}

$user = new User;