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
        $data = $db -> delete("posts", array('id'=>$_POST["commentId"]));
        echo json_encode($data);
    }
    
?>