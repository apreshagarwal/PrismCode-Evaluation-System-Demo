<?php
session_start();
require_once('../connection.php');
$admin_user_id = $admin_full_name = $admin_username = "";
if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
    session_destroy();
    header('Location: index.php');
    die();
} else {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $sql = "SELECT * FROM `admin_users` WHERE `username` = '$username' and `password` = '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows) {
        $row = $result->fetch_assoc();
        $admin_user_id = $row['admin_user_id'];
        $admin_user_id = $row['admin_user_id'];
        $admin_full_name = $row['full_name'];
        $admin_username = $username;
    } else {
        session_destroy();
        header('Location: index.php');
        die();
    }
}
