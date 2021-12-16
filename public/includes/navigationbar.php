<?php 

    // if(isset($_GET['id'])){
       
        ini_set("display_errors", 1);
        $sql = "SELECT * FROM users WHERE id = ?";
        $params = array($_SESSION['user']);
        $row = $db->row($sql, $params);
        
        if($row->avatar){
            $avatar = "<img style='width:100%' src='../files/assets/img/avatars/".$row->avatar."'>";
        }else{
            $avatar = "<span class='user-icon'>".substr(ucwords($row->fullname),0,1)."</span>";
        }
    // }
?>
<nav id='nav-container'>
    <ul id='nav-items'>
        <li id='nav-item'>
            <a id='user' href='./profile.php?id=<?php echo $_SESSION['user'] ?>'><?php echo $avatar ?></a>
        </li>
        <div id="space">
        <li id='nav-item'>
            <a href="./homepage.php"><i class='fas fa-home' style='font-size:35px'></i></a>
        </li>
        <li id='nav-item'>
            <a href="#"><i class='fas fa-search' style='font-size:35px'></i></a>
        </li>
        <li id='nav-item'>
            <a href="#"><i class='fas fa-bell' style='font-size:35px'></i></a>
        </li>
        <li id='nav-item'>
            <a href="#"><i class='fas fa-comments' style='font-size:35px'></i></a>
        </li>
        <li id='nav-item'>
            <a href="#"><i class='fas fa-compass' style='font-size:35px'></i></a>
        </li>
        <li id='nav-item'>
            <a href="./friends.php"><i class='fas fa-user-friends' style='font-size:35px'></i></a>
        </li>
        </div>
        <li id='nav-item'>
            <a id='logout' href="./index.php?logout=1"><i class="fas fa-power-off" style="font-size:45px"></i></a>
        </li>
    </ul>
</nav>
<div class="search-background"></div>
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