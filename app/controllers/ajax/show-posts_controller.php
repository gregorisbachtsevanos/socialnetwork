<?php 
    session_start();
    require_once '../../model/settings.php';
    // header('Content-Type: application/json; charset=utf-8');

    if(isset($_POST["userId"])){
        // get all posts
        $sql = "SELECT * FROM posts WHERE parent_id is Null  ";
        $rows = $db->fetch($sql);
        $response = array($totalPosts = Count($rows),'posts'=>array());
        foreach(array_reverse($rows) as $post){
           
            $sql = "SELECT `fullname`, `username`, id FROM `users` WHERE `id` = '$post->user_id'";
            $row = $db->row($sql);
            $date = date("d/m/Y", strtotime($post->date_created));
            $time = date("H:m:s", strtotime($post->date_created));
            $data = array(
                "post_id" => $post->id,
                "user_id" => $post->user_id,
                "parent_id" => $post->parent_id,
                "message" => $post->message,
                "video" => $post->video,
                "image" => $post->images,
                "audio" => $post->audio,
                "date_created" => $date,
                "total_views" => $post->total_views,
                "total_reposts" => $post->total_reposts,
                "total_likes" => $post->total_likes,
                "total_comments" => $post->total_comments,
                "mentions" => $post->mentions,
                "hashtags" => $post->hashtags,
                "repost_id" => $post->repost_id,
                "username" => $row->username,
                "fullname" => $row->fullname
            );

            $data["liked"] = '';
            $sql = "SELECT `date` FROM posts_likes WHERE user_id = ? AND post_id = ?";
            $params = array($_POST["userId"], $post->id);
            $row = $db -> row($sql, $params);
            if($row){
                $data["liked"] = "liked";
            }
            array_push($response['posts'], $data);
        }
        echo json_encode(($response));
        
    }

?>