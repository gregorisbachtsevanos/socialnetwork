<?php

    session_start();
    require_once "../model/settings.php";
    if (isset($_POST['submit'])){

        if(!empty($_FILES["avatar"]["name"])){
            $img = $_FILES["avatar"]["name"];
            move_uploaded_file($_FILES["avatar"]["tmp_name"], "../../files/assets/img/avatars/".$img);
            $db->update('users', 
                array('avatar'=>$img),
                array('id'=>$_SESSION["user"])
            );
        }
        if(!empty($_POST["fullname"])){
            $db->update('users', 
                array('fullname'=>$_POST["fullname"]),
                array('id'=>$_SESSION["user"])
            );
        }
        if(!empty($_POST["bio"])){
            $db->update('users', 
                array('bio'=>$_POST["bio"]),
                array('id'=>$_SESSION["user"])
            );
        }
        if(!empty($_POST["email"])){
            $db->update('users_login', 
                array('email'=>$_POST["email"]),
                array('user_id'=>$_SESSION["user"])
            );
        }
        if(!empty($_POST["website"])){
            $db->update('users_extra_info', 
                array('website'=>$_POST["website"]),
                array('user_id'=>$_SESSION["user"])
            );
        }
        if(!empty($_POST["youtube"])){
            $db->update('users_extra_info', 
                array('youtube'=>$_POST["youtube"]),
                array('user_id'=>$_SESSION["user"])
            );
        }
        if(!empty($_POST["instagram"])){
            $db->update('users_extra_info', 
                array('instagram'=>$_POST["instagram"]),
                array('user_id'=>$_SESSION["user"])
            );
        }
        if(!empty($_POST["tiktok"])){
            $db->update('users_extra_info', 
                array('tiktok'=>$_POST["tiktok"]),
                array('user_id'=>$_SESSION["user"])
            );
        }
        if(!empty($_POST["phone"])){
            $db->update('users_extra_info', 
                array('phone_number'=>$_POST["phone"]),
                array('user_id'=>$_SESSION["user"])
            );
        }
        if(!empty($_POST["password"])){
            $sql = 'SELECT `user_id`, "password" FROM users_login WHERE `user_id` = ?';
			$params = array($_SESSION["user"]);
			$row = $db->row($sql, $params);
            if(password_verify($_POST["password"],$row->password)){
                
                if(!empty($_POST["new-password"]) && !empty($_POST["repeat-password"])){
                    if(strlen($_POST["new-password"]) < 8){
                        echo "Password must have 8 characters or more";
                    } elseif($_POST["new-password"] !== $_POST["repeat-password"]){
                        echo "Passwords not match";
                    }else{
                        $pwdHash = password_hash($_POST["new-password"], PASSWORD_DEFAULT);
                        $db->update('users_login',
                            array("password"=>$pwdHash),
                            array("user_id"=>$_SESSION["user"])
                        );
                        echo "success";
                    }
                }

            }
        }
        
        header("Location: ../../public/profile.php?id=".$_SESSION["user"]);
    }else{
        die("Error");
    }
?>