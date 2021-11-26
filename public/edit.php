<?php

    require_once "../public/includes/header.php";
    if (isset($_SESSION['user'])){
        
        $sql = "SELECT * FROM `users` WHERE id = ?";
        // $sql = "SELECT *  FROM `users`, `users_extra_info`, `users_login` WHERE `id` = 7 AND `user_id` = id";
        $params = array($_SESSION["user"]);
        $row = $db -> row($sql, $params);
        print_r($row);
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
                        <input type="text" name="fullname" value="<?php echo $row->fullname ?>">
                </div>    
                <div class="input-item">
                    <label style="display:block; height:0px" for="Bio">Bio</label>
                        <textarea type="text" name="bio" rows="7" placeholder="<?php echo $row->bio ?>"></textarea>
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Email">Email</label>
                        <input type="email" name="Email" placeholder="<?php //echo $row->email ?>">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Website">Website</label>
                        <input type="text" name="website" placeholder="<?php //echo $row->website ?>">
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