<?php

    require_once "../public/includes/header.php";
    if (isset($_SESSION['user'])){
        
        // $sql = "SELECT * FROM `users` WHERE id = ?";
        $sql = "SELECT users.fullname, users_login.email, users_extra_info.website FROM users JOIN users_login ON users_login.user_id = users.id JOIN users_extra_info ON users_extra_info.user_id = users.id WHERE users.id = ?";
        $params = array($_SESSION["user"]);
        $row = $db -> row($sql, $params);
            print_r(var_dump($row));

        ?>

    <div class="edit-container">
        <div class="info-items">
            <div class="header">
                <h1>Edit</h1>
            </div>
            <div class="profile-img">
                <img src="" alt="">
            </div>
            <form method="post" action="../app/controllers/edit-profile_controller.php" enctype="multipart/form-data" class="input-items">
                <div class="input-item">
                    <label style="display:block; height:0px" for="Fullname">Photo Profil</label>
                        <input type="file" name="avatar">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Fullname">Fullname</label>
                        <input type="text" name="fullname" value="">
                </div>    
                <div class="input-item">
                    <label style="display:block; height:0px" for="Bio">Bio</label>
                        <textarea type="text" name="bio" rows="7" placeholder=""></textarea>
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Email">Email</label>
                        <input type="email" name="Email" placeholder="">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Website">Website</label>
                        <input type="text" name="website" placeholder="">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="YouTube">YouTube</label>
                        <input type="text" name="youtube" >
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Instagram">Instagram</label>
                        <input type="text" name="instagram">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Instagram">TikTok</label>
                        <input type="text" name="tiktok">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Twitch">Phone Number</label>
                        <input type="text" name="phone">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Twitch">Password</label>
                        <input type="password" name="password">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Twitch">New Password</label>
                        <input type="password" name="new-password">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Twitch">Repeat New Password</label>
                        <input type="password" name="repeat-password">
                </div>
                <div class="input-item">
                    <input type="submit" name="submit">
                </div>
            </form>
        </div>
    </div>
        
    <?php
    }else{
        die("Error");
    }

?>