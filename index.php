<?php 

require_once __DIR__ . '/header.php';

?>
<section class="clearfix">
    <div class="container">
        <?php
            if( isset( $_GET['delete-success'] ) )
                printf( '<div class="success-message">%s</div>', $_GET['delete-success'] );
            if( isset( $_GET['update-result'] ) )
                printf( '<div class="success-message">%s</div>', $_GET['update-result'] );
         ?>
        <h1>Application Form</h1>
        <div class="table-parent">
            <table class="table">
                <thead>
                    <tr align="right">
                        <td colspan="6">
                            <form action="" class="search-form">
                                <input type="search" name="search-result">
                                <input type="submit" value="Search" name="get-search-result">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    
                    <?php
            
                        $table_name = "{$prefix}users";
                        $table = $pdo->query("SELECT id FROM $table_name ORDER BY 'full_name' DESC");

                        if( $table->rowCount() > 0 ){
                            
                            $sql = "SELECT id, full_name, email_address, phone_number, user_address FROM $table_name";
                            $statment = $pdo->prepare( $sql );
                            $statment->execute();

                            // $results = $statment->fetch(PDO::FETCH_ASSOC);
                            $count_value = 1;
                            while ($results = $statment->fetch(PDO::FETCH_ASSOC)) {
                                printf(
                                    '<tr><td class="text-center">%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td class="action-link-parent"><a href="%s" class="action-link" onclick="confirm(\'Are you sure?\');"><img src="./assets/img/delete.png" /></a><a href="%s" class="action-link"><img src="./assets/img/edit.png" /></a></td></tr>',
                                    $count_value ++,
                                    $results['full_name'],
                                    $results['email_address'],
                                    $results['phone_number'],
                                    $results['user_address'],
                                    get_home_url( '/inc/core-delete-user.php?delete-query='. $results['id'] ),
                                    get_home_url( '/update.php?user-update='. $results['id'] ),

                                );
                            }

                        }else{
                            printf('<tr><td colspan="5">%s</td></tr>', 'No Result Found.');
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>