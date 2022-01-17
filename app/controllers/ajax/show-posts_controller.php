<?php 
	session_start();
	require_once '../../model/settings.php';
	// header('Content-Type: application/json; charset=utf-8');

	if(isset($_POST["USERNAME"])){
		$sql = "SELECT id FROM users WHERE username = ?";
		$params = array($_POST["page"] == 'profile' ? $_POST["USERNAME"] : $_SESSION['user']);
		$row = $db->row($sql, $params);
		$userId = $row->id;
		if(($_POST["page"]) == "homepage"){
			$limit = $_POST["limit"];
			if(isset($_POST["counter"])){
				$sql = "SELECT * FROM posts WHERE parent_id is Null AND id < ? ORDER BY id DESC LIMIT $limit";
				$params = array($_POST["counter"]);
				$rows = $db->fetch($sql, $params);
				// print_r($rows);
			} else{
				$sql = "SELECT * FROM posts WHERE parent_id is Null ORDER BY id DESC LIMIT $limit";
				$rows = $db->fetch($sql);
				// print_r($rows);
			}
			
		} else if(($_POST["page"]) == "profile"){

		// ********** load user's posts ********** //
			if($_POST["type"] == "posts"){
				if(isset($_POST["counter"])){
					$sql = "SELECT * FROM posts WHERE parent_id is Null AND `user_id` = ? AND id < ? ORDER BY id DESC LIMIT 2";
					$params = array($userId, $_POST['counter']);
					$rows = $db->fetch($sql, $params);
					// print_r($rows);
				} else{
					$sql = "SELECT * FROM posts WHERE parent_id is Null AND `user_id` = ? ORDER BY id DESC LIMIT 2";
					$params = array($userId);
					$rows = $db->fetch($sql, $params);
					// print_r($rows);
				}
			} 
		// ********** load user's images ********** //
			else if($_POST["type"] == "images"){
				if(isset($_POST["counter"])){
					$sql = "SELECT * FROM posts WHERE parent_id is Null AND `message` is NULL AND images is not NULL AND `user_id` = ? AND id < ? ORDER BY id DESC LIMIT 2";
					$params = array($userId, $_POST["counter"]);
					$rows = $db->fetch($sql, $params);
					
				// 	// print_r($rows);
				} else{
					$sql = "SELECT * FROM posts WHERE parent_id is Null AND `message` is NULL AND images is not NULL AND `user_id` = ? ORDER BY id DESC LIMIT 2";
					$params = array($userId);
					$rows = $db->fetch($sql, $params);
					// print_r($rows);
				}
			} 
		// ********** load users followers ********** //
			else if($_POST["type"] == "following"){
				$following = array("posts"=>array());
				// if(isset($_POST["counter"])){
					// $sql = "SELECT * FROM posts WHERE id < ? AND parent_id is Null AND user_id = ?";
					// $params = array($_POST["postId"], $userId);
					// $rows = $db->fetch($sql, $params);
					// print_r($rows);
				// } else{
					$sql = "SELECT `follow_user_id` FROM `follow` WHERE `user_id` = ?";
					$params = array($userId);
					$rows = $db -> fetch($sql, $params);
					foreach($rows as $row){
						$sql = "SELECT `id`, `fullname`, `username`, `avatar` FROM `users` WHERE `id` = ? ORDER BY id DESC LIMIT 1";
						$params = array($row->follow_user_id);
						$row = $db -> row($sql, $params);
						$row->profileAvatar = $row -> avatar 
							? "<img style='width:100%;height:100%' src='../files/assets/img/avatars/".$row->avatar."'alt='image-profile'>" 
							: "<span class='user-icon'>".substr(ucwords($row->fullname),0,1)."</span>";
						array_push($following["posts"], $row);
					}				
					// print_r($followers);
					echo json_encode($following);
					exit();
				// }
			} 
		// ********** load users following ********** //
			else if($_POST["type"] == "followers"){
				$following = array("posts"=>array());
				// if(isset($_POST["counter"])){
					// $sql = "SELECT * FROM posts WHERE id < ? AND parent_id is Null AND user_id = ?";
					// $params = array($_POST["postId"], $userId);
					// $rows = $db->fetch($sql, $params);
					// print_r($rows);
				// } else{

					$sql = "SELECT `user_id` FROM `follow` WHERE `follow_user_id` = ?";
					$params = array($userId);
					$rows = $db -> fetch($sql, $params);
					foreach($rows as $row){
						$sql = "SELECT `id`, `fullname`, `username`, `avatar` FROM `users` WHERE `id` = ? ORDER BY id LIMIT 2";
						$params = array($row->user_id);
						$row = $db -> row($sql, $params);
						$row->profileAvatar = $row -> avatar 
						? "<img style='width:100%;height:100%' src='../files/assets/img/avatars/".$row->avatar."'alt='image-profile'>" 
						: "<span class='user-icon'>".substr(ucwords($row->fullname),0,1)."</span>";
						array_push($following["posts"], $row);
					}				
					echo json_encode($following);
					exit();
				// }
			} 
			
		}

		// get all posts
		$response = array($totalPosts = Count($rows),'posts'=>array());
		foreach(($rows) as $post){
			
			$date = date("d/m/Y", strtotime($post->date_created));
			$time = date("H:m:s", strtotime($post->date_created));
			$comments = array();
			$sql = "SELECT `fullname`, `username`, id, avatar FROM `users` WHERE `id` = '$post->user_id'";
			$row = $db->row($sql);
			// echo gettype($row->avatar);
			$row->avatar 
				? $avatar = "<img style='width:100%;height:100%' src='../files/assets/img/avatars/".$row->avatar."' alt='image-profile'>"
				: $avatar = "<span class='user-icon'>".substr(ucwords($row->fullname),0,1)."</span>";

			$sql = "SELECT `id`, `user_id`, `message`, `date_created`, parent_id FROM posts WHERE parent_id = ?";
			$params = array($post->id);
			$commentsRow = $db->fetch($sql, $params);
			$total_comments = ($post->total_comments);
			
			foreach($commentsRow as $comment){
				if($comment->id){
					
					$sql = "SELECT `username` FROM users WHERE id = ?";
					$params = array($comment->user_id);
					$commentsUsername = $db->row($sql, $params);
					$comment->username = $commentsUsername;
					array_push($comments, $comment);
				}
				// print_r(($comment));
			}
			$sql = "SELECT COUNT(total_comments) as total FROM posts WHERE parent_id = ?";
			$params = array($post->id);
			$totalCommentsRow = $db->row($sql, $params);
			$data = array(
				"post_id"		=> $post->id,
				"user_id"		=> $post->user_id,
				"parent_id"		=> $post->parent_id,
				"message"		=> $post->message,
				"video"			=> $post->video,
				"image"			=> $post->images,
				"audio"			=> $post->audio,
				"date_created"	=> $date,
				"total_views"	=> $post->total_views,
				"total_reposts"	=> $post->total_reposts,
				"total_likes"	=> $post->total_likes,
				"total_comments"=> $totalCommentsRow->total,
				"mentions"		=> $post->mentions,
				"hashtags"		=> $post->hashtags,
				"repost_id"		=> $post->repost_id,
				"username"		=> $row->username,
				"fullname"		=> $row->fullname,
				"avatar"		=> $avatar,
				"comments"		=> $comments,
				"currentUserId"		=> $userId
			);
			// print_r($post);
			
			$data["liked"] = '';
			$sql = "SELECT `date` FROM posts_likes WHERE `user_id` = ? AND post_id = ?";
			$params = array($userId, $post->id);
			$row = $db -> row($sql, $params);
			if($row){
				$data["liked"] = "liked";
			} 
				array_push($response['posts'], $data);
				// print_r($data);
		}
		// print_r(($response));
		echo json_encode(($response));
		
	}

?>