<?php

    session_start();
    require_once "../model/settings.php";
    
    if (isset($_POST['submit'])){
        $success = array();
        $changeEvent = false;
        $sql = "SELECT * FROM users INNER JOIN users_login ON users_login.user_id = users.id INNER JOIN users_extra_info ON users_extra_info.user_id = users.id WHERE users.id = ?";
        $params = array($_SESSION["user"]);
        $row = $db->row($sql, $params);

        if(!empty($_FILES["avatar"]["name"]) ){
            $img = $_FILES["avatar"]["name"];
            move_uploaded_file($_FILES["avatar"]["tmp_name"], "../../files/assets/img/avatars/".$img);
            $db->update('users', 
                array('avatar'=>$img),
                array('id'=>$_SESSION["user"])
            );
            $success[] = "Profile Pic";
            $changeEvent = true;
          
        }
        if(!empty($_POST["fullname"]) && $_POST["fullname"] != $row->fullname){
            $db->update('users', 
                array('fullname'=>$_POST["fullname"]),
                array('id'=>$_SESSION["user"])
            );
            $success[] = "Fullname";
            $changeEvent = true;
        }
        if(!empty($_POST["bio"]) && $_POST["bio"] != $row->bio){
            $success[] = "Bio";
            $db->update('users', 
                array('bio'=>$_POST["bio"]),
                array('id'=>$_SESSION["user"])
            );
            $success[] = "bio";
            $changeEvent = true;
        }
        if(!empty($_POST["email"]) && $_POST["email"] != $row->emial){

            $sql = 'SELECT `user_id` FROM users_login WHERE email = ?';
            $params = array($_POST['email']);
            $row = $db->row($sql, $params);

            if(!(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))){
                $error = "Email is not valid";
            }if(isset($row->id)){
                $error = "Email in use.";
            }else{
                $db->update('users_login', 
                    array('email'=>$_POST["email"]),
                    array('user_id'=>$_SESSION["user"])
                );
                $success[] = "Email";
                $changeEvent = true;
            }

        }
        if(!empty($_POST["website"]) && $_POST["website"] != $row->website){
            $db->update('users_extra_info', 
                array('website'=>$_POST["website"]),
                array('user_id'=>$_SESSION["user"])
            );
            $success[] = "Website";
            $changeEvent = true;
        }
        if(!empty($_POST["youtube"]) && $_POST["youtube"] != $row->youtube){
            $db->update('users_extra_info', 
                array('youtube'=>$_POST["youtube"]),
                array('user_id'=>$_SESSION["user"])
            );
            $success[] = "YouTube";
            $changeEvent = true;
        }
        if(!empty($_POST["instagram"]) && $_POST["instagram"] != $row->instagram){
            $db->update('users_extra_info', 
                array('instagram'=>$_POST["instagram"]),
                array('user_id'=>$_SESSION["user"])
            );
            $success[] = "Instagram";
            $changeEvent = true;
        }
        if(!empty($_POST["tiktok"]) && $_POST["tiktok"] != $row->tiktok){
            $db->update('users_extra_info', 
                array('tiktok'=>$_POST["tiktok"]),
                array('user_id'=>$_SESSION["user"])
            );
            $success[] = "TiktTok";
            $changeEvent = true;
        }
        if(!empty($_POST["phone"]) && $_POST["phone"] != $row->phone_number){
            $db->update('users_extra_info', 
                array('phone_number'=>$_POST["phone"]),
                array('user_id'=>$_SESSION["user"])
            );
            $success[] = "Phone Number";
            $changeEvent = true;
        }
        if(!empty($_POST["password"])){
            $sql = 'SELECT `user_id`, "password" FROM users_login WHERE `user_id` = ?';
			$params = array($_SESSION["user"]);
			$row = $db->row($sql, $params);
            if(password_verify($_POST["password"],$row->password)){
                
                if(!empty($_POST["new-password"]) && !empty($_POST["repeat-password"])){
                    if(strlen($_POST["new-password"]) < 8){
                        $error = "Password must have 8 characters or more";
                        header("Location: ../../public/edit.php?error=".$error);
                        exit();
                    } elseif($_POST["new-password"] !== $_POST["repeat-password"]){
                        $error = "Passwords not match";
                        header("Location: ../../public/edit.php?error=".$error);
                        exit();
                    }else{
                        $pwdHash = password_hash($_POST["new-password"], PASSWORD_DEFAULT);
                        $db->update('users_login',
                            array("password"=>$pwdHash),
                            array("user_id"=>$_SESSION["user"])
                        );
                        $success[] = "Password";
                        $changeEvent = true;
                    }
                }

            }else {
                $error = "Wrong password";
                header("Location: ../../public/edit.php?error=".$error);
                exit();
            }
        }
        if($changeEvent){
            header("Location: ../../public/edit.php?success=".implode(" ",$success). " have change successfully");
            exit();
        }else{
            header("Location: ../../public/edit.php?noChanges=No changes are made");
            exit();
        }
    }else{
        die("Error");
    }
?>