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
                        <?php  
                            if(isset($_GET['source'])) {
                                $source = $_GET['source'];
                            } else {
                                $source = '';
                            }
                            switch ($source) {
                                case 'delete-comment':
                                    $comment_id_to_delete = $_GET['id'];
                                    $delete_comment_sql = "DELETE FROM comments WHERE comment_id = {$comment_id_to_delete}";
                                    $execute_delete_post = mysqli_query($connect, $delete_comment_sql);
                                    header("Location: comments.php");
                                    break;
                                case 'approve':
                                    $comment_id = $_GET['id'];
                                    $approve_sql = "UPDATE comments SET comment_status = 1 WHERE comment_id = {$comment_id}";
                                    mysqli_query($connect, $approve_sql);
                                    header("Location: comments.php");
                                    break;
                                case 'unapprove':
                                    $comment_id = $_GET['id'];
                                    $unapprove_sql = "UPDATE comments SET comment_status = 0 WHERE comment_id = {$comment_id}";
                                    mysqli_query($connect, $unapprove_sql);
                                    header("Location: comments.php");
                                    break;
                                default:
                                    require_once "./includes/admin-view-all-comments.php";
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