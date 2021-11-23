<?php 

    session_start();
    require_once "../../model/settings.php";
    if(isset($_POST["postId"])){
        echo $_POST["postId"];
        $like = $db -> delete("posts_likes", array('post_id'=>$_POST["postId"]));
        $comment = $db -> delete("posts", array('parent_id'=>$_POST["postId"]));
        $data = $db -> delete("posts", array('id'=>$_POST["postId"]));
        echo json_encode($data);
    }
    
?>