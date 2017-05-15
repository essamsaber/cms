<?php  
if(isset($_GET['delete'])) {
    $post_id_to_delete = $_GET['delete'];
    $delete_post_sql = "DELETE FROM posts WHERE post_id = {$post_id_to_delete}";
    $execute_delete_post = mysqli_query($connect, $delete_post_sql);
}
?>
<table class="text-center table table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Username</th>
            <th class="text-center">Firstname</th>
            <th class="text-center">Lastname</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
            <th class="text-center" style="width:100px;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php  
            $get_users_sql = "SELECT * FROM users";
            $execute_users_sql = mysqli_query($connect, $get_users_sql);
            // Begin the first loop
            while($user = mysqli_fetch_object($execute_users_sql)): ?>
                <tr>
                    <td><?= $user->user_id; ?></td>
                    <td><?= $user->username; ?></td>
                    <td><?= $user->user_firstname; ?></td>
                    <td><?= $user->user_lastname; ?></td>
                    <td><?= $user->user_email; ?></td>
                    <td><?= $user->role; ?></td>
                    <td><a href='users.php?source=edit-user&amp;id=<?=$user->user_id;?>'>Edit</a> - <a onClick='javascript: return confirm("Are use sure that you want to delete it?");' href='users.php?source=delete-user&amp;id=<?= $user->user_id;?>'>Delete</a></td>
                </tr>  
        
        <?php
            endwhile; // End the first loop
        ?>                                    
    </tbody>
</table>
