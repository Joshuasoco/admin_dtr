<?php
session_start(); 

$error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
unset($_SESSION['login_error']); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hk Duty tracker</title>
    <link rel="icon" href="../images/icontitle.png" />
    <link rel="stylesheet" type="text/css" href="../design/login.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Anek+Devanagari:wght@100..800&family=Jost:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&family=Bebas+Neue&family=Poppins:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&family=Varela+Round&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
        <div class="left">
            <img src="/ADMIN_DTR/images/Rectangle bg.png" alt="University Logo">
        </div>
        <div class="right">
            
            <h2>Welcome back</h2>
            <p>Login to your Phinma account</p>
            <form action="../backend/admin_login.php" method="POST">
            <?php if (!empty($error)): ?>
                <div class="error-message">
                    <span class="error-icon">⚠️</span>
                    <span><?php echo htmlspecialchars($error); ?></span>
                    <span class="close-btn" onclick="this.parentElement.style.display='none';">&times;</span>
                </div>
                <?php endif; ?>

                <label for="student_id">Email</label>
                <div class="password">
                    <input type="text" name="student_id" id="student_id" placeholder="03-2324-1234" required>
                    <img src="../images/email-svgrepo-com.svg" alt="email" class="email-icon">
                </div>
                <label for="password">Password</label>

                <div class="password">
                    <input type="password" name="password" id="password" required>
                    <img src="../images/eye-closed-svgrepo-com.svg" alt="hide"
                    onclick="pass()" class="pass-icon" id= "pass-icon">
                </div>
                
                <button type="submit" class="btn">Sign in</button>
            </form>
            
            <div class="divider">Or</div>
            <a href="#" class="signup-btn">Sign up</a>
            
            <p class="terms">
                By clicking continue, you agree to our 

                <button id="tos_button" class="tos-btn">Terms of Service</button>
                and 
                <a href="#">Privacy Policy</a>.
            </p>
        </div>
    </div>
    <div class="tos-modal" id="tos_modal">
        <div class="tos-content">
            <?php include '../includes/ToS.php';?>
        </div>
    </div>
    <script src="../script/script.js"></script>
</body>
</html>
