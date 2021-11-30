<?php 

    session_start();
    require_once "../../model/settings.php";
    if(isset($_POST["postId"])){
        $db -> delete("posts_likes", array('post_id'=>$_POST["postId"]));
        $db -> delete("posts", array('parent_id'=>$_POST["postId"]));
        $data = $db -> delete("posts", array('id'=>$_POST["postId"]));
        echo json_encode($data);
        exit();
    }
    if(isset($_POST["commentId"])){
        // get comment info
        $sql = "SELECT parent_id as post_id FROM posts WHERE id = ?";
        $params = array($_POST['commentId']);
        $row = $db->row($sql, $params);

        $data = $db -> delete("posts", array('id'=>$_POST["commentId"]));
        $postId = $row->post_id;
        
        $sql = 'SELECT COUNT(`id`) as `total` FROM `posts` WHERE `parent_id` = ?';
        $params = array($row->post_id);
        $row = $db->row($sql, $params);
        $db->update('posts', array('total_comments'=>$row->total), array('id'=>$_POST["feedId"]));
        $data =  array('total'=>$row->total);
        echo json_encode($data);
        exit();
    }

?>