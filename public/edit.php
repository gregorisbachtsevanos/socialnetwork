<?php

    require_once "../public/includes/header.php";
    if (isset($_SESSION['user'])){
        
        $sql = "SELECT * FROM users INNER JOIN users_login ON users_login.user_id = users.id INNER JOIN users_extra_info ON users_extra_info.user_id = users.id WHERE users.id = ?";
        $params = array($_SESSION["user"]);
        $row = $db->row($sql, $params);
    require_once "../public/includes/navigationbar.php";
      
        ?>

    <div class="edit-container">
        <div class="info-items">
            <form method="post" action="../app/controllers/edit-profile_controller.php" enctype="multipart/form-data" class="input-items">
                <div class="input-item">
                    <label for="Photo-Profile">Photo Profile</label>
                        <input type="file" id="file"><!--<span id="file-upload">Choose a file</span>-->
                </div>
                <div class="input-item">
                    <label for="Fullname">Fullname</label>
                        <input type="text" class="<?php echo $row->fullname ? 'fullfill' : null ?>" name="fullname" value="<?php echo $row->fullname ?>">
                </div>    
                <div class="input-item">
                    <label for="Bio">Bio</label>
                        <textarea type="text" class="<?php echo $row->bio ? 'fullfill' : null ?>" name="bio" rows="7"><?php echo $row->bio ?></textarea>
                </div>
                <div class="input-item">
                    <label for="Email">Email</label>
                        <input type="email" class="<?php echo $row->email ? 'fullfill' : null ?>" name="Email" value="<?php echo $row->email ?>">
                </div>
                <div class="input-item">
                    <label for="Website">Website</label>
                        <input type="text" class="<?php echo $row->website ? 'fullfill' : null ?>" name="website" value="<?php echo $row->website ?>">
                </div>
                <div class="input-item">
                    <label for="YouTube">YouTube</label>
                        <input type="text" class="<?php echo $row->youtube ? 'fullfill' : null ?>" name="youtube" value="<?php echo $row->youtube ?>">
                </div>
                <div class="input-item">
                    <label for="Instagram">Instagram</label>
                        <input type="text" class="<?php echo $row->instagram ? 'fullfill' : null ?>" name="instagram" value="<?php echo $row->instagram ?>">
                </div>
                <div class="input-item">
                    <label for="Instagram">TikTok</label>
                        <input type="text" class="<?php echo $row->tiktok ? 'fullfill' : null ?>" name="tiktok" value="<?php echo $row->tiktok ?>">
                </div>
                <div class="input-item">
                    <label for="Twitch">Phone Number</label>
                        <input type="text" class="<?php echo $row->phone_number ? 'fullfill' : null ?>" name="phone" value="<?php echo $row->phone_number ?>">
                </div>
                <div class="input-item">
                    <input type="submit" name="submit">
                </div>
            </form>
            <div id="danger">
                <h3>Dangerous Zone</h3><hr>
            </div>
            <form method="post" action="../app/controllers/edit-profile_controller.php" enctype="multipart/form-data" class="input-items">
                <div class="input-item">
                    <label for="Twitch">Password</label>
                        <input type="password" name="password">
                </div>
                <div class="input-item">
                    <label for="Twitch">New Password</label>
                        <input type="password" name="new-password">
                </div>
                <div class="input-item">
                    <label for="Twitch">Repeat New Password</label>
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