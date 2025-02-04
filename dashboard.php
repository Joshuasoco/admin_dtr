<?php
    include 'includes/connection.php';  // Include connection first
    include 'includes/fetch_students.php';  // Then include the data fetch
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hk Duty Tracker</title>
    <link rel="icon" href="/ADMIN_DTR/images/icontitle.png" />
    <link rel="stylesheet" type="text/css" href="/ADMIN_DTR/design/table.css" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"
    />
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
                        <input type="checkbox" id="all_students_checkbox" />
                        All student&nbsp;&nbsp;<?php echo $result->num_rows; ?>
                    </label>

                    <div class="search">
                        <span><i class="bx bx-search-alt-2"></i></span>
                        <input type="text" id="search_input" placeholder="Search" />
                        <a class="add_new" href="#divOne">+&nbsp;&nbsp;&nbsp;&nbsp; Add New</a>
                        <button class="edit" id="edit_button">
                            <i class="bx bxs-pencil"></i>Edit
                        </button>
                    </div>
                </div>
                <?php include 'includes/dashtable.php';?>
            </div> 
        </div> 
    </div>
    <script src="/ADMIN_DTR/script/table.js"></script>
</body>
</html>