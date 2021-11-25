<?php
echo count((array)$rows) == 0 ? "No posts" : null;
foreach(array_reverse($rows) as $post):
    $sql = "SELECT `fullname`, `username`, id FROM `users` WHERE `id` = '$post->user_id'";
    $row = $db->row($sql);

    // get post_id for like
    $liked_class = '';
    $sql = 'SELECT `date` FROM posts_likes WHERE post_id = ? AND user_id = ?';
    $params = array($post->id, $_SESSION['user']);
    $like = $db->row($sql, $params);
    if(isset($like->date)){
        $liked_class = 'liked';
    }

    // get comments info
    $sql = "SELECT `id`, `user_id`, `message`, `date_created` FROM `posts` WHERE `parent_id` = ?";
    $params = array($post->id);
    $rows = $db->fetch($sql, $params);?>
    <div class="feed" data-id="<?php echo $post->id ?>">
        <div class="feed-info">
            <div class="post-header">

                <?php echo "<h4>".ucwords($row->fullname)."<a href='../public/profile.php?id=".$row->id."'><span> @$row->username</span></a></h4>"; 
                echo $_SESSION['user'] === $post->user_id ?  "<i class='far fa-trash-alt delete-feed' data-id='$post->id'></i>" : null; ?>
            </div>
                <span><small><?php echo date("d/m/Y", strtotime($post->date_created)) ?></small></span>
            <hr>
        </div> <!-- end feed-info -->

        <div class="feed-message">
            <p class="post-msg"><?php echo $post->message ?></p>
            <hr>
            <span class="fas fa-heart <?php echo $liked_class?>">
                <small class="likes"><?php echo $post->total_likes?></small>
            </span>
            <span class="fas fa-comment" id="<?php echo $post->id ?>">
                    <small class="comment"><?php echo $post->total_comments?></small>
                    <div class="comment-info hide-comments" data-id="<?php echo $post->id ?>">
                        <div class="post-comments">
                            <?php
                            foreach($rows as $comment){
                                $sql = "SELECT `username` FROM `users` WHERE `id` = $comment->user_id";
                                $row = $db->row($sql)
                                ?>
                                <div class="comment" data-id='<?php echo $comment->id ?>'>
                                    <h4>
                                        <?php echo $row->username;
                                        echo $_SESSION['user'] === $comment->user_id ?  "<i class='far fa-trash-alt delete-comment'></i>" : null;?>
                                    </h4>
                                    <small><?php echo date("d/m/Y", strtotime($comment->date_created)) ?></small>
                                    <p><?php echo $comment->message ?></p>
                                    <hr>
                                </div>
                            <?php
                            }
                            ?>
                        </div> <!--end post-comments -->
                        <input type="text" name="comment" class="comment-field" autocomplete="off" placeholder="Add a comment" required>
                        <small class="new-comment">Comment</small>
                    </div> <!--end comment-info -->
                </span>
                
                
        </div> <!-- end feed-message -->

    </div>
<?php endforeach; ?>