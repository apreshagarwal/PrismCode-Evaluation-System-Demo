<?php
require_once("session_check.php");
require_once('connection.php');
require_once("question_bank.php");
$correct_answers = 0;
$incorrect_answers = 0;
$unattempted = 0;
$correct_answers_percentage = 0;
$incorrect_answers_percentage = 0;
$summary = array();
foreach ($_SESSION['answers'] as $key => $value) {
    $summary[$key]['question'] = $_QUESTIONS[$key]['question'];
    $summary[$key]['explanation'] = $_QUESTIONS[$key]['explanation'];
    $summary[$key]['correct_option'] = $_QUESTIONS[$key]['option_' . $_QUESTIONS[$key]['answer']];
    $summary[$key]['selected_option'] = $_QUESTIONS[$key]['option_' . $value['selected_option']];
    if ($_QUESTIONS[$key]['answer'] == $value['selected_option']) {
        $correct_answers++;
    } else {
        $incorrect_answers++;
    }
    unset($_QUESTIONS[$key]);
}
foreach ($_QUESTIONS as $key => $value) {
    $summary[$key]['question'] = $_QUESTIONS[$key]['question'];
    $summary[$key]['explanation'] = $_QUESTIONS[$key]['explanation'];
    $summary[$key]['correct_option'] = $_QUESTIONS[$key]['option_' . $_QUESTIONS[$key]['answer']];
    $summary[$key]['selected_option'] = "Unattempted";
    $unattempted++;
}
$correct_answers_percentage = ($correct_answers / $total_questions) * 100;
$incorrect_answers_percentage = ($incorrect_answers / $total_questions) * 100;
$unattempted_percentage = ($unattempted / $total_questions) * 100;
$sql = "UPDATE `attempts` SET `score` = '$correct_answers_percentage' WHERE `attempt_id` = '" . $_SESSION['attempt_id'] . "'";
$conn->query($sql);
