<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HK</title>
    <link rel="icon" href="/ADMIN_DTR/images/icontitle.png" />
    <link rel="stylesheet" type="text/css" href="/ADMIN_DTR/design/profile.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Anek+Devanagari:wght@100..800&family=Jost:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Bebas+Neue&family=Poppins:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&family=Varela+Round&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <?php include 'includes/sidebar.php'; ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title-profile">Profile</h1>
                <h2 class="subtitle-profile">Profile Overview</h2>
            </div>
            
            <div class="content">
                <div class="profile-container">
                    <div class="profile-card">
                        <img src="images/image-removebg-preview.png" alt="profile" class="profile-pic">
                        <div class="profile-info">
                            <h2 class="full-name"><?php echo $admin_name;?></h2>
                            <p class="role"><i class='bx bx-shield-quarter'></i><?php echo $admin_name;?></p>
                            <div class="profile-stats">
                                <div class="stat-item">
                                    <span class="stat-value">4</span>
                                    <span class="stat-label">total students</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-value">4</span>
                                    <span class="stat-label">Pending Approval</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-value">Jan 02, 2005</span>
                                    <span class="stat-label">Last login</span>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>