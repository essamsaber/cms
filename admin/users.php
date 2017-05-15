<?php require_once "includes/admin-header-html.php"; ?>
    <div id="wrapper">

        <!-- Navigation -->
<?php require_once "includes/admin-navigation-html.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome admin   
                            <small><?=$_SESSION['username'];?></small>                         
                        </h1>
                        <?php  // Print the response to add user proceess 
                            if(isset($_SESSION['add_user'])) {
                                echo $_SESSION['add_user'];
                                unset($_SESSION['add_user']);
                            }
                        ?>  
                        <?php  
                            if(isset($_GET['source'])) {
                                $source = $_GET['source'];
                            } else {
                                $source = '';
                            }
                            switch ($source) {
                                case 'add-user':
                                    require_once "includes/admin-add-user-html.php";
                                break;
                                case 'delete-user':
                                    if($_SESSION['user_role'] !== 'admin') die('You don\'t have permission to access this page <a href="../index.php>Goto home page</a>"');
                                    $user_id = $_GET['id'];
                                    $delete_user_sql = "DELETE FROM users WHERE user_id = $user_id";
                                    mysqli_query($connect, $delete_user_sql);
                                    header("Location: users.php");
                                break;
                                case 'edit-user':
                                    require_once "includes/admin-edit-user-html.php";
                                break;
                                default:
                                    require_once "./includes/admin-view-all-users.php";
                                break;
                            }
                        ?>            
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php require_once "includes/admin-footer-html.php"; ?>