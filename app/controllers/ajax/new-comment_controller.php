<?php 

    session_start();
    require_once "../../model/settings.php";

    if(isset($_POST['postId'])){

        $sql = "SELECT id FROM `users` WHERE `username` = ? ";
		$params = array($_SESSION["user"]);
		$currentUserId = $db->row($sql, $params);

        $sql = "SELECT `message` FROM `posts` WHERE `parent_id` = ?";
        $params = array($_POST['postId']);
        $row = $db->row($sql, $params);
           
        $new_id = $db->insert(
            'posts', array(
                'parent_id'     =>$_POST['postId'],
                'message'       =>$_POST['msg'],
                'user_id'       =>$currentUserId->id,
                'date_created'  =>date('Y-m-d H:i:s')
            )
        );
        $data = array('status'=>200, 'comment'=>true, 'id'=>$_POST["postId"]);
        $sql = "SELECT `username`, fullname, avatar FROM `users` WHERE `id` = ?";
        $params = array($currentUserId->id);
        $row = $db->row($sql, $params);

        $row->avatar 
        ? $avatar = "<img style='width:100%;height:100%' src=".$appFiles."assets/img/avatars/".$row->avatar." alt='image-profile'>"
        : $avatar = "<span class='user-icon'>".substr(ucwords($userRow->fullname),0,1)."</span>";

        $data['username'] = $row->username;
        $data['fullname'] = $row->fullname;
        $data['avatar'] = $avatar;
        $data['date_created'] = date("d/m/Y");
        $data['message'] = $_POST['msg'];
        $data["id"] = $new_id;

        $sql = 'SELECT COUNT(`id`) as `total` FROM `posts` WHERE `parent_id` = ?';
        $params = array($_POST['postId']);
        $row = $db->row($sql, $params);
        $db->update('posts', array('total_comments'=>$row->total), array('id'=>$_POST['postId']));
        $data['total'] = $row->total;
        header('Content-type: application/json');
        echo json_encode($data);
        exit();
    }
?> 