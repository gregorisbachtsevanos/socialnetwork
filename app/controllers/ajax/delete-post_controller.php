<?php 

    session_start();
    require_once "../../model/settings.php";
    if(isset($_POST["postId"])){
        $db -> delete("posts_likes", array('post_id'=>$_POST["postId"]));
        $db -> delete("posts", array('parent_id'=>$_POST["postId"]));
        $data = $db -> delete("posts", array('id'=>$_POST["postId"]));
        echo json_encode($data);
    }
    if(isset($_POST["commentId"])){

        $sql = "SELECT parent_id FROM users WHERE id = ?";
        $params = array($_POST['commentId']);
        $row = $db->row($sql, $params);
        
        $sql1 = 'SELECT COUNT(`id`) as `total` FROM `posts` WHERE `parent_id` = ?';
        $params = array($_POST['commentId']);
        $row1 = $db->row($sql1, $params);

        $db->update('posts', array('total_comments'=>$row->total), array('id'=>$_POST["commentId"]));

        $data = $db -> delete("posts", array('id'=>$_POST["commentId"]));
        echo json_encode($data);
    }
    
?>