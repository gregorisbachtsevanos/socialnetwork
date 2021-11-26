<?php

    session_start();
    require_once "../model/settings.php";
    if (isset($_POST['submit'])){

        if(!empty($_FILES["avatar"])){
            $img = $_FILES["avatar"]["name"];
            move_uploaded_file($_FILES["avatar"]["tmp_name"], "../../files/assets/img/avatars/".$img);
            $db->update('users', 
                array('avatar'=>$img),
                array('id'=>$_SESSION["user"])
            );
        }else{echo"F";}
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
                array('phone'=>$_POST["phone"]),
                array('user_id'=>$_SESSION["user"])
            );
        }
        
        header("Location: ../../public/profile.php?id=".$_SESSION["user"]);
    }else{
        die("Error");
    }
?>