<?php 

    session_start();
    require_once "../../model/settings.php";

    if(isset($_POST['postId'])){
        $sql = "SELECT `message` FROM `posts` WHERE `parent_id` = ?";
        $params = array($_POST['postId']);
        $row = $db->row($sql, $params);
           
        $db->insert('posts', array(
                                    'parent_id'=>$_POST['postId'],
                                    'message'=>$_POST['msg'],
                                    'user_id'=>$_SESSION["user"],
                                    'date_created'=>date('Y-m-d H:i:s')
                               )
                    );
        $data = array('status'=>200, 'comment'=>true);

        $sql = 'SELECT COUNT(`total_comments`) as `total` FROM `posts` WHERE `parent_id` = ?';
        $params = array($_POST['postId']);
        $row = $db->row($sql, $params);
        $db->update('posts', array('total_comments'=>$row->total), array('id'=>$_POST['postId']));
        $data['total'] = $row->total;
        header('Content-type: application/json');
        echo json_encode($data);
        exit();
    }
?>