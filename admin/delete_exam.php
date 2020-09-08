<?php
require_once('session_check.php');
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $quiz_id = $_GET['id'];
    $sql = "DELETE FROM `quizes` WHERE `quiz_id` = '$quiz_id'";
    $result = $conn->query($sql);
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
die();
