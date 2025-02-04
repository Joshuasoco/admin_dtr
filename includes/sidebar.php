<?php
    session_start();

    if(isset($_SESSION['admin_name']) && isset ($_SESSION['admin_role'])){
        $admin_name = $_SESSION['admin_name'];
        $admin_role = $_SESSION['admin_role'];
    } else{
        $admin_name = "Guest";
        $admin_role = "Guest";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="images/icontitle.png" />
    <link rel="stylesheet" type = "text/css" href= "/design/styles.css"/>
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"
    />
</head>
<body>
<div class="wrapper">
  <div class="sidebar">
    <div class="top">
      <div class="logo">
        <a href="index.php">
          <img src="/images/phinmasvg.svg" alt="Upang logo" class="phinmalogo" />
          <span class="title">HK Duty Tracker</span>
        </a>
      </div>
    </div>
    <div class="user">
      <i class="bx bx-user-circle"></i>
      <div class="name">
        <p><?php echo $admin_name;?></p>
        <p class="role"><?php echo $admin_role;?></p>
      </div>
    </div>
    <hr class="line" />
    <ul>
      <li>
        <i class="bx bx-home"></i>
        <a href="index.php" class="menu">Home</a>
      </li>
      <li>
        <i class="bx bx-store"></i>
        <a href="dashboard.php" class="menu">Dashboard</a>
      </li>
      <li>
        <i class="bx bx-news"></i>
        <a href="hk.php" class="menu">HK Student</a>
      </li>
    </ul>
    <hr class="line_2" />
    <div class="profilelinks">
      <a href="#">
        <img src="/images/profile-minus-1353-svgrepo-com.svg" alt="click to visit profile" class="profilelogo" />
        <span class="profile_text">Profile</span>
      </a>
    </div>
    <div class="logout">
      <a href="#" onclick="show_logout()">
        <img src="/images/logout-svgrepo-com.svg" alt="click to logout" class="logoutlogo" />
        <span class="logout_text">Logout</span>
      </a>
    </div>
  </div>
</div>
<div class="logout_popup" id="logout_warning">
      <div class="logout_content">
        <p>Are you sure you want to logout?</p>
        <button class="logout_button" onclick="logout()">Yes</button>
        <button class="cancel_button" onclick="hide_logout()">No</button>
      </div>
    </div>
    <script src="/script/script.js"></script>
  </body>
</html>