<?php  
if(isset($_GET['delete-comment'])) {

}
?>
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Email</th>
            <th>In response to</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php  
        $get_comments_sql = "SELECT * FROM comments";
        $execute_comments_sql = mysqli_query($connect, $get_comments_sql);

        while($comment = mysqli_fetch_object($execute_comments_sql)): // Begin the first loop
            $get_post_by_id = "SELECT * FROM posts WHERE post_id = '{$comment->comment_post_id}'";
            $execute_get_post = mysqli_query($connect, $get_post_by_id);
            while($post = mysqli_fetch_object($execute_get_post)): // Begin the second loop ?>
            <tr>
                <td><?= $comment->comment_id ;?></td>
                <td><?= $comment->comment_author ;?></td>
                <td><?= $comment->comment_email ;?></td>
                <td><a href="posts.php?source=edit-post&amp;id=<?=$post->post_id;?>"><?= $post->post_title ;?></a></td>
                <td><?= $comment->comment_content ;?></td>
                <td>
                <a href="comments.php?source=<?php if($comment->comment_status == 0) echo 'approve'; else echo 'unapprove'; ?>&amp;id=<?=$comment->comment_id;?>">
               <?php if($comment->comment_status == 0) echo 'Approve'; else echo 'Unapprove'; ?></a>
               </td>
                <td><?= $comment->comment_date ;?></td>
                <td><a onClick='javascript: return confirm("Are use sure that you want to delete it?");' href='comments.php?source=delete-comment&amp;id=<?=$comment->comment_id;?>'>Delete</a></td>  
            </tr>
        <?php endwhile; // End the second loop

            endwhile; // End the first loop
        ?>                                    
    </tbody>
</table>
