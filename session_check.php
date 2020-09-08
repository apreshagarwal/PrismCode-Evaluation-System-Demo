<?php
session_start();
if (!isset($_SESSION['exam_key'])) {
    session_destroy();
    header('Location: index.php');
    die();
}
