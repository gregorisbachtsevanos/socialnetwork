<?php 

    require_once('../public/index.php');
    // ini_set("display_errors", 1);
    $sql = "SELECT * FROM users WHERE username = ?";
    $params = array($_SESSION["user"]);
    $row = $db->row($sql, $params);
    $url = getURL($requestUrl, $appURL);

    isset($url[1])
        ? $src = "src='../".$appFiles."assets/img/avatars/".$row->avatar."'"
        : $src = "src='".$appFiles."assets/img/avatars/".$row->avatar."'";

    $row->avatar 
        ? $avatar = "<img style='width:100%;height:100%' ".$src." alt='image-profile'>"
        : $avatar = "<span class='user-icon'>".substr(ucwords($row->fullname),0,1)."</span>";
    
?>
<nav id='nav-container'>
    <ul id='nav-items'>
        <li id='nav-item'>
            <a id='user' href='<?php echo $appURL.$_SESSION["user"]; ?>' aria-label="profile">
                <?php echo $avatar ?>
            </a>
        </li>

        <li class="space"></li>

        <li id='nav-item'>
            <a href="<?php echo $appURL;?>homepage" aria-label="homepage">
                <!-- <i class='fas fa-home' style='font-size:35px'></i> -->
                <?php require_once $appFiles."/assets/img/svg/home.svg" ?>
            </a>
        </li>
        <li id='nav-item'>
            <a href="#" aria-label="search">
                <!-- <i class='fas fa-search' style='font-size:35px'></i> -->
                <?php require_once $appFiles."/assets/img/svg/search.svg" ?>
            </a>
        </li>
        <!-- <li id='nav-item'>
            <a href="#" aria-label="notification">
                <!-- <i class='fas fa-bell' style='font-size:35px'></i> -->
                <?php// require_once $appFiles."/assets/img/svg/bell.svg" ?>
            <!-- </a> -->
        <!-- </li> -->
        <!-- <li id='nav-item'>
            <a href="<?php //echo $appURL; ?>chat" aria-label="chat">
                <!-- <i class='fas fa-comments' style='font-size:35px'></i> -->
                <?php// require_once $appFiles."/assets/img/svg/envelope.svg" ?>
            <!-- </a> -->
        <!-- </li>  -->
        <li id='nav-item'>
            <a href="<?php echo $appURL; ?>trending" aria-label="trending">
                <!-- <i class='fas fa-compass' style='font-size:35px'></i> -->
                <?php require_once $appFiles."/assets/img/svg/navigation.svg" ?>
            </a>
        </li>
        <li id='nav-item'>
            <a href="<?php echo $appURL; ?>friends" aria-label="friends">
                <!-- <i class='fas fa-user-friends' style='font-size:35px'></i> -->
                <?php require_once $appFiles."/assets/img/svg/users.svg" ?>
            </a>
        </li>

        <li class="space"></li>

        <li id='nav-item'>
            <a id='logout' href="<?php echo $appURL;?>logout" aria-label="logout">
                <!-- <i class="fas fa-power-off" style="font-size:45px"></i> -->
                <?php require_once $appFiles."/assets/img/svg/logout.svg" ?>
            </a>
        </li>
    </ul>
</nav>
<div class="search-background"></div>
<div class="search">
    <div class="search-form">
        <div id=search-items>
            <label for="search">Search
                <input type="search" class="search-input"></label>
        </div>
        <i class="fas fa-times"></i>
    </div>

    <div class="results"></div>
</div>