<?php

    require_once "../public/includes/header.php";
    require_once $appIncludes."navigationbar.php";

    if (isset($_SESSION['user'])){
        
        $sql = "SELECT * FROM users INNER JOIN users_login ON users_login.user_id = users.id INNER JOIN users_extra_info ON users_extra_info.user_id = users.id WHERE users.id = ?";
        $params = array($_SESSION["user"]);
        $row = $db->row($sql, $params);

    if(isset($_GET["error"])){
        $msg = $_GET["error"];
        $class = 'error-msg';
    }else if(isset($_GET["success"])){
        $msg = $_GET["success"];
        $class = 'success-msg';
    }else if(isset($_GET["noChanges"])){
        $msg = $_GET["noChanges"];
        $class = 'no-changes-msg';
    }else{
        $msg = null;
        $class = '';
    }
    
    ?>

    <div class="edit-container">
        <div id="go-back">
            <p id="<?php echo $class;?>"> <?php echo $msg;?></p>
            <a href="./profile.php?id=<?php echo $_SESSION["user"]?>">
                <i class="fas fa-undo"></i>
                Back to your page
            </a>
        </div>
        <div class="info-items">
            <div id="message">
                </div>

                <form method="post" action="../app/controllers/edit-profile_controller.php" enctype="multipart/form-data" class="input-items">
                    <div class="input-item">
                        <label for="Photo-Profile">Photo Profile</label>
                            <input type="file" autocomplete="off" name="avatar" id="file">
                    </div>
                    <div class="input-item">
                        <label for="Fullname">Fullname</label>
                            <input type="text" autocomplete="off" name="fullname" value="<?php echo $row->fullname ?>">
                    </div>    
                    <div class="input-item">
                        <label for="Bio">Bio</label>
                            <textarea type="text" name="bio" rows="7"><?php echo $row->bio ?></textarea>
                    </div>
                    <div class="input-item">
                        <label for="Email">Email</label>
                            <input type="email" autocomplete="off" name="Email" value="<?php echo $row->email ?>">
                    </div>
                    <div class="input-item">
                        <label for="Website">Website</label>
                            <input type="text" autocomplete="off" name="website" value="<?php echo $row->website ?>">
                    </div>
                    <div class="input-item">
                        <label for="YouTube">YouTube</label>
                            <input type="text" autocomplete="off" name="youtube" value="<?php echo $row->youtube ?>">
                    </div>
                    <div class="input-item">
                        <label for="Instagram">Instagram</label>
                            <input type="text" autocomplete="off" name="instagram" value="<?php echo $row->instagram ?>">
                    </div>
                    <div class="input-item">
                        <label for="Instagram">TikTok</label>
                            <input type="text" autocomplete="off" name="tiktok" value="<?php echo $row->tiktok ?>">
                    </div>
                    <div class="input-item">
                        <label for="Twitch">Phone Number</label>
                            <input type="text" autocomplete="off" name="phone" value="<?php echo $row->phone_number ?>">
                    </div>
                    <div class="input-item">
                        <input type="submit" name="submit" value="Save">
                    </div>
                </form>
                <div id="danger">
                    <h3>Danger Zone</h3><hr>
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
                        <input type="submit" name="submit" value="Save">
                    </div>
                </form>
            </div>
        </div> <!-- end info-items-->
    </div> <!-- end edit-container-->
    
    <?php 
    }else{
        die("Error");
    }

?>