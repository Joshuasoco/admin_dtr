<?php
    include 'backend/connection.php';  
    include 'backend/fetch_students.php';  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hk Duty Tracker</title>
    <link rel="icon" href="/ADMIN_DTR/images/icontitle.png" />
    <link rel="stylesheet" type="text/css" href="/ADMIN_DTR/design/table.css" />    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <div class="wrapper">
        <?php include 'includes/sidebar.php';?>
        <div class="main-content">
            <div class="content" >
                <h1 class="title_db">Dashboard</h1>
                <h2 class="subtitle">Student list</h2>

                <div class="header-container">
                    <label class="all-students">
                        <input type="checkbox" id="all_students_checkbox" class ="allstudent_checkbox   " />
                        All student&nbsp;&nbsp;
                        <span class = "student-count">
                            <?php echo $result->num_rows; ?>
                        </span>
                    </label>
 
                    <div class="search">
                        <span><i class="bx bx-search-alt-2"></i></span>
                        <input type="text" id="search_input" placeholder="Search" />
                        <a class="add_new" href="#divOne">+&nbsp;&nbsp;&nbsp;&nbsp; Add New</a>
                        <button class="edit" id="edit_button">
                        <i class="bx bxs-pencil"></i> Edit
                        </button>
                    </div>
                </div>
                <?php include 'includes/dashtable.php';?>
            </div> 
        </div> 
    </div>
    <div class="delete_popup" id="delete_warning">
      <div class="delete_content">
        <p>Are you sure you want to delete the selected students?</p>
        <button class="delete_button" onclick="delete_selected()">Yes</button>
        <button class="cancel_button" onclick="hide_delete_popup()">No</button>
      </div>
    </div>

    <script src = "/ADMIN_DTR/script/table.js"></script>
</body>
</html>