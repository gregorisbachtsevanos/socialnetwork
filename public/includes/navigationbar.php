<nav id='nav-container'>
    <ul id='nav-items'>
        <a id='user' href='../public/profile.php?id=<?php echo $_SESSION['user'] ?>'><span class="user-icon" style='font-size:35px'><?php echo substr(ucwords($_SESSION['fullname']),0,1) ?></span></a>
        <li id='nav-item' href='#'><i class='fas fa-search' style='font-size:35px'></i></li>
        <li id='nav-item' href='#'><i class='fas fa-bell' style='font-size:35px'></i></li>
        <li id='nav-item' href='#'><i class='fas fa-comments' style='font-size:35px'></i></li>
        <li id='nav-item' href='#'><i class='fas fa-compass' style='font-size:35px'></i></li>
        <li id='nav-item' href='#'><i class='fas fa-user-friends' style='font-size:35px'></i></li>
        <a id='logout' href='index.php?logout=1'><i class="fas fa-power-off" style="font-size:45px"></i></a>
    </ul>
</nav>

<div class="search">
    <div class="search-form">
        <div id=search-items>
            <label for="search">Search</label>
            <input type="search" class="search-input">
        </div>
        <i class="fas fa-times"></i>
    </div>

    <div class="results"></div>
</div>