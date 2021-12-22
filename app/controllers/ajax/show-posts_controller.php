<?php 
	session_start();
	require_once '../../model/settings.php';
	// header('Content-Type: application/json; charset=utf-8');

	if(isset($_POST["userId"])){
		
		if(($_POST["page"]) == "homepage"){
			
			if(isset($_POST["counter"])){
				$counter = $_POST["counter"];
				$sql = "SELECT * FROM posts WHERE id < ? AND parent_id is Null";
				$params = array($_POST["postId"]);
				$rows = $db->fetch($sql, $params);
				// print_r($rows);
			} else{
				$counter = 0;
				$sql = "SELECT * FROM posts WHERE parent_id is Null";
				$rows = $db->fetch($sql);
				// print_r($rows);
			}
			
		} else if(($_POST["page"]) == "profile"){
			// ****** load users posts ****** //
			if($_POST["type"] == "posts"){
				// echo $_POST["type"];
				if(isset($_POST["counter"])){
					$counter = $_POST["counter"];
					$sql = "SELECT * FROM posts WHERE id < ? AND parent_id is Null AND user_id = ?";
					$params = array($_POST["postId"], $_POST["userId"]);
					$rows = $db->fetch($sql, $params);
					// print_r($rows);
				} else{
					$counter = 0;
					$sql = "SELECT * FROM posts WHERE parent_id is Null AND user_id = ?";
					$params = array($_POST["userId"]);
					$rows = $db->fetch($sql, $params);
					// print_r($rows);
				}
			} 
			// ****** load users comments ****** //
			else if($_POST["type"] == "comments"){
				if(isset($_POST["counter"])){
					$counter = $_POST["counter"];
					$sql = "SELECT * FROM posts WHERE id < ? AND parent_id is not Null AND user_id = ?";
					$params = array($_POST["postId"], $_POST["userId"]);
					$rows = $db->fetch($sql, $params);
					// print_r($rows);
				} else{
					$counter = 0;
					$sql = "SELECT * FROM posts WHERE parent_id is not Null AND user_id = ?";
					$params = array($_POST["userId"]);
					$rowsP = $db->fetch($sql, $params);
					foreach($rowsP as $row){
						$sql = "SELECT * FROM posts WHERE parent_id is Null AND id = ?";
						$params = array($row->parent_id);
						$rows = $db->fetch($sql, $params);
					}
					// print_r($rows);
					// $rows = array_values($postComments->comments);
				}
			} 
			// // ****** load users mentions ****** //
			// else if($_POST["type"] == "mentions"){
			// 	if(isset($_POST["counter"])){
			// 		$counter = $_POST["counter"];
			// 		$sql = "SELECT * FROM posts WHERE id < ? AND parent_id is Null AND user_id = ?";
			// 		$params = array($_POST["postId"], $_POST["userId"]);
			// 		$rows = $db->fetch($sql, $params);
			// 		// print_r($rows);
			// 	} else{
			// 		$counter = 0;
			// 		$sql = "SELECT * FROM posts WHERE parent_id is Null AND user_id = ?";
			// 		$params = array($_POST["userId"]);
			// 		$rows = $db->fetch($sql, $params);
			// 		// print_r($rows);
			// 	}
			// } 
			// // ****** load users likes ****** //
			// else if($_POST["type"] == "likes"){
			// 	if(isset($_POST["counter"])){
			// 		$counter = $_POST["counter"];
			// 		$sql = "SELECT * FROM posts WHERE id < ? AND parent_id is Null AND user_id = ?";
			// 		$params = array($_POST["postId"], $_POST["userId"]);
			// 		$rows = $db->fetch($sql, $params);
			// 		// print_r($rows);
			// 	} else{
			// 		$counter = 0;
			// 		$sql = "SELECT * FROM posts WHERE parent_id is Null AND user_id = ?";
			// 		$params = array($_POST["userId"]);
			// 		$rows = $db->fetch($sql, $params);
			// 		// print_r($rows);
			// 	}
			// }
		}

		$limit = $counter + 5;
		// get all posts
		$response = array($totalPosts = Count($rows),'posts'=>array());
		foreach(array_reverse($rows) as $post){
			$counter++;
			if($counter <= $limit){
			
				$comments = array();
			
				$sql = "SELECT `fullname`, `username`, id, avatar FROM `users` WHERE `id` = '$post->user_id'";
				$row = $db->row($sql);
				$date = date("d/m/Y", strtotime($post->date_created));
				$time = date("H:m:s", strtotime($post->date_created));
				if($row->avatar){
					$avatar = "<img style='width:100%;height:100%' src='../files/assets/img/avatars/".$row->avatar."' alt='image-profile'>";
				}else{
					$avatar = "<span class='user-icon'>".substr(ucwords($row->fullname),0,1)."</span>";
				}
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
					"counter"		=> $counter
				);
				// print_r($data);

				$data["liked"] = '';
				$sql = "SELECT `date` FROM posts_likes WHERE user_id = ? AND post_id = ?";
				$params = array($_POST["userId"], $post->id);
				$row = $db -> row($sql, $params);
				if($row){
					$data["liked"] = "liked";
				}
				array_push($response['posts'], $data);
			}
		}
		echo json_encode(($response));
		
	}

?>