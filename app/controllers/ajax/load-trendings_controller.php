<?php 

require_once('../../model/settings.php');
// if(isset($_POST['CURRENT_USER'])){
//     echo $_POST['CURRENT_USER'];

// }
$currentDate = date("Y/m/d");
// echo $currentDate;

$sql = "SELECT id FROM users WHERE username = ?";
$params = array($_POST["CURRENT_USER"]);
$row = $db->row($sql, $params);
$userId = $row->id;

$sql = "SELECT * FROM posts WHERE parent_id IS NULL ORDER BY total_likes DESC";
$rows = $db->fetch($sql);
$response = array();
foreach($rows as $row){
    $feedInfo = array();
    $sql = "SELECT * FROM users WHERE id = $row->user_id";
    $userInfo = $db->row($sql);
    
    $userInfo->avatar 
        ? $avatar = "<img style='width:100%;height:100%' src='../files/assets/img/avatars/".$userInfo->avatar."' alt='image-profile'>"
        : $avatar = "<span class='user-icon'>".substr(ucwords($userInfo->fullname),0,1)."</span>";
    
    $feedInfo['username'] = $userInfo->username;
    $feedInfo['fullname'] = $userInfo->username;
    $feedInfo['avatar'] = $avatar;
    $feedInfo['post_id'] = $row->id;
    $feedInfo['parent_id'] = $row->parent_id;
    $feedInfo['message'] = $row->message;
    $feedInfo['image'] = $row->images;
    $feedInfo['video'] = $row->video;
    $feedInfo['audio'] = $row->audio;
    $feedInfo['date_created'] = $row->date_created;
    $feedInfo['total_likes'] = $row->total_likes;
    $feedInfo['total_comments'] = $row->total_comments;

    $feedInfo["liked"] = '';
    $sql = "SELECT `date` FROM posts_likes WHERE `user_id` = ? AND post_id = ?";
    $params = array($userId, $row->id);
    $likeRow = $db -> row($sql, $params);
    if($likeRow){
        $feedInfo["liked"] = "liked";
    } 

    $comments = array();
    $commentsUser = array();

    if($feedInfo['total_comments'] > 0){
        // echo $row->id;
        $sql = "SELECT * FROM posts WHERE parent_id = ?";
        $params = array($row->id);
        $commetnsRows = $db->fetch($sql, $params);

        foreach($commetnsRows as $comment){

            $sql = "SELECT * FROM users WHERE id = ?";
            $params = array($comment->user_id);
            $userCommetnsRows = $db->row($sql, $params);
            
            $userCommetnsRows->avatar 
                ? $avatar = "<img style='width:100%;height:100%' src='../files/assets/img/avatars/".$userCommetnsRows->avatar."' alt='image-profile'>"
                : $avatar = "<span class='user-icon'>".substr(ucwords($userCommetnsRows->fullname),0,1)."</span>";
                
            $comment->username  = $userCommetnsRows->username;
            $comment->fullname  = $userCommetnsRows->fullname;
            $comment->avatar  = $avatar;

            array_push($comments, $comment);
        }

    }

    // print_r($rows);
   
    $feedInfo['comments'] = $comments;
    array_push($response, $feedInfo);
}
// print_r($response);
echo json_encode($response);

?>