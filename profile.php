<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HK - Profile</title>
    <!-- boxiconfavicon -->
    <link rel="icon" href="/ADMIN_DTR/images/icontitle.png" />
    <link rel="stylesheet" type="text/css" href="/ADMIN_DTR/design/profile.css" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!-- google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Anek+Devanagari:wght@100..800&family=Jost:ital,wght@0,100..900&family=Roboto:ital,wght@0,100..900&family=Bebas+Neue&family=Poppins:ital,wght@0,100..900&family=Quicksand:wght@300..700&family=Varela+Round&display=swap" rel="stylesheet">
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
                <!-- Profile Section -->
                <div class="profile-container">
                    <div class="profile-card">
                        <img src="images/image-removebg-preview.png" alt="Profile Picture" class="profile-pic">
                        <div class="profile-info">
                            <h2 class="full-name"><?php echo $admin_name; ?></h2>
                            <p class="role"><i class='bx bx-shield-quarter'></i> <?php echo $admin_name; ?></p>

                            <div class="profile-stats">
                                <div class="stat-item">
                                    <span class="stat-value">4</span>
                                    <span class="stat-label">Total Students</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-value">4</span>
                                    <span class="stat-label">Pending Approval</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-value">02-05-2025</span>
                                    <span class="stat-label">Last Login</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- account Details Section -->
                <div class="account-section">
                    <h2 class="section-title">Account Details</h2>
                    <div class="account-container">
                        <!-- Personal Information -->
                        <div class="account-card">
                            <div class="account-header">
                                <i class='bx bx-user-circle'></i>
                                <h3>Personal Information</h3>
                            </div>
                            <div class="account-details">
                                <div class="detail-item">
                                    <span class="detail-label">Username:</span>
                                    <span class="detail-value">Joshco</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Full Name:</span>
                                    <span class="detail-value"><?php echo $admin_name; ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Email:</span>
                                    <span class="detail-value"><?php echo isset($email) ? $email : 'admin@example.com'; ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Phone Number:</span>
                                    <span class="detail-value"><?php echo isset($phone_number) ? $phone_number : '09012345678'; ?></span>
                                </div>
                                
                            </div>
                            <div class="edit-button">
                                <button><i class='bx bx-edit-alt'></i> Edit Information</button>
                            </div>
                        </div>

                        <!-- Work Information -->
                        <div class="account-card">
                            <div class="account-header">
                                <i class='bx bx-briefcase'></i>
                                <h3>Work Information</h3>
                            </div>
                            <div class="account-details">
                                <div class="detail-item">
                                    <span class="detail-label">Department:</span>
                                    <span class="detail-value"><?php echo isset($department) ? $department : 'CITE'; ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Position:</span>
                                    <span class="detail-value"><?php echo isset($position) ? $position : 'Administrator'; ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Status:</span>
                                    <span class="detail-value status-active">Active</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Date Joined:</span>
                                    <span class="detail-value"><?php echo isset($date_joined) ? $date_joined : '1-2-2025'; ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Security Settings -->
                        <div class="account-card">
                            <div class="account-header">
                                <i class='bx bx-lock-alt'></i>
                                <h3>Security Settings</h3>
                            </div>
                            <div class="account-details">
                                <div class="detail-item">
                                    <span class="detail-label">Last Password Change:</span>
                                    <span class="detail-value"><?php echo isset($last_password_change) ? $last_password_change : '1-1-2025'; ?></span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Two-Factor Authentication:</span>
                                    <span class="detail-value status-inactive">Not Enabled</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Account Recovery:</span>
                                    <span class="detail-value status-active">Enabled</span>
                                </div>
                            </div>
                            <div class="edit-button">
                                <button><i class='bx bx-lock-open-alt'></i> Change Password</button>
                            </div>
                        </div>
                    </div> <!--account-container -->
                </div> <!--account-section -->
            </div> <!--content -->
        </div> <!--main-content -->
    </div> <!--wrapper -->
</body>
</html>
