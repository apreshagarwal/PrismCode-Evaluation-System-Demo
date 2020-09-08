<?php
$_QUESTIONS = array();
$quiz_title = $conn->query("SELECT `quiz_name` FROM `quizes` WHERE `quiz_id` = '" . $_SESSION['quiz_id'] . "'")->fetch_array()[0];
$sql = "SELECT * FROM `question_bank` WHERE `quiz_id` = '" . $_SESSION['quiz_id'] . "'";
$result = $conn->query($sql);
$i = 0;
while ($row = $result->fetch_assoc()) {
    $_QUESTIONS[++$i] = array(
        "id" => $row['question_bank_id'],
        "question" => $row['question'],
        "explanation" => $row['explanation'],
        "option_1" => $row['option_1'],
        "option_2" => $row['option_2'],
        "option_3" => $row['option_3'],
        "option_4" => $row['option_4'],
        "answer" => $row['answer']
    );
}
$total_questions = count($_QUESTIONS);
$total_marks = $total_questions * 10;
