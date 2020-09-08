<?php
// Fetching values from the session
$question_number = $_SESSION['question_number'];
$questions_attempted = $_SESSION['questions_attempted'];
$selected_option = "";


if (isset($_GET['selected_option']) && isset($_GET['action'])) {
    if (!$_SESSION['inProgress']) {
        header('Location: ./error.php');
        die();
    }
    if (!isset($_SESSION['answers'][$question_number])) {
        $questions_attempted += 1;
        $_SESSION['questions_attempted'] = $questions_attempted;
    }
    $_SESSION['answers'][$question_number] = array(
        "selected_option" => $_GET['selected_option']
    );
    if ($question_number == count($_QUESTIONS)) {
        $_SESSION['inProgress'] = false;
?>
        <script>
            location.replace("results.php");
        </script>
<?php
        die();
    } else {
        $question_number++;
        $_SESSION['question_number'] = $question_number;
    }
}
if (isset($_GET['action']) && ($_GET['action'] == "previous")) {    // Navigating to a previous question
    if (!$_SESSION['inProgress']) {
        header('Location: ./error.php');    // Redirecting to error page if the quiz is not in progress
        die();
    }
    $question_number--; // Decrementing the question number
    $_SESSION['question_number'] = $question_number;    // Updating the session
    $selected_option = $_SESSION['answers'][$question_number]['selected_option'];   // Getting the selected option for the previous question
}
if (!isset($_SESSION['answers'][$question_number])) {
    $selected_option = "";
} else {
    $selected_option = $_SESSION['answers'][$question_number]['selected_option'];
}

// Setting variables to display the questions and options on the screen
$question_id = $_QUESTIONS[$question_number]['id'];
$question = $_QUESTIONS[$question_number]['question'];
$option_1 = $_QUESTIONS[$question_number]['option_1'];
$option_2 = $_QUESTIONS[$question_number]['option_2'];
$option_3 = $_QUESTIONS[$question_number]['option_3'];
$option_4 = $_QUESTIONS[$question_number]['option_4'];
