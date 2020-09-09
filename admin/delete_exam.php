<?php
require_once('session_check.php');
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $quiz_id = $_GET['id'];
    if ($quiz_id != 1) {    // ID 1 refers to the PHP Demo Quiz
        $sql = "DELETE FROM `quizes` WHERE `quiz_id` = '$quiz_id'";
        $result = $conn->query($sql);
    }
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
die();
