<?php 

require_once('../../model/settings.php');

$sql = "SELECT * FROM posts ORDER BY total_likes DESC";
$rows = $db->fetch($sql);
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
    $feedInfo['message'] = $row->message;
    $feedInfo['image'] = $row->images;
    $feedInfo['video'] = $row->video;
    $feedInfo['audio'] = $row->audio;
    $feedInfo['likes'] = $row->total_likes;
    $feedInfo['comments'] = $row->total_comments;

    if($feedInfo['comments'] > 0){
        echo "OK";
    }
    print_r($feedInfo);
}
echo json_encode($rows);

?>