<?php

    require_once "../public/includes/header.php";
    if (isset($_SESSION['user'])){?>

    <div class="edit-container">
        <div class="info-items">
            <div class="header">
                <h1>Edit</h1>
            </div>
            <div class="profile-img">
                <img src="" alt="">
            </div>
            <div class="input-items">
                <div class="input-item">
                    <label style="display:block; height:0px" for="Fullname">Fullname</label>
                        <input type="text">
                </div>    
                <div class="input-item">
                    <label style="display:block; height:0px" for="Bio">Bio</label>
                        <input type="text">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Email">Email</label>
                        <input type="email">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Website">Website</label>
                        <input type="text">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="YouTube">YouTube</label>
                        <input type="text">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Instagram">Instagram</label>
                        <input type="text">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Twitch">Twitch</label>
                        <input type="text">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="Discord">Discord</label>
                        <input type="text">
                </div>
                <div class="input-item">
                    <label style="display:block; height:0px" for="TikTok">TikTok</label>
                        <input type="text">
                </div>
            </div>
        </div>
    </div>
        
    <?php
    }else{
        die("Error");
    }

?>