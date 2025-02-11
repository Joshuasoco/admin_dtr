<?php
session_start();
unset($_SESSION['search_active']);
unset($_SESSION['search_query']);
echo "success";
?>