<?php
require_once('session_check.php');
$quiz_id = "";
$quiz_details = array();
$questions = $option_1 = $option_2 = $option_3 = $option_4 = $answers = $explanations = array();
$is_new = true;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $quiz_id = $_GET['id'];
    $sql = "SELECT * FROM `quizes` WHERE `quiz_id` = '$quiz_id'";
    $result = $conn->query($sql);
    if ($result->num_rows) {
        $quiz_details = $result->fetch_assoc();
        $sql = "SELECT * FROM `question_bank` WHERE `quiz_id` = '$quiz_id'";
        $result = $conn->query($sql);
        if ($result->num_rows) {
            $is_new = false;
            while ($row = $result->fetch_assoc()) {
                array_push($questions, $row['question']);
                array_push($option_1, $row['option_1']);
                array_push($option_2, $row['option_2']);
                array_push($option_3, $row['option_3']);
                array_push($option_4, $row['option_4']);
                array_push($answers, $row['answer']);
                array_push($explanations, $row['explanation']);
            }
        }
    }
}
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="../favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon.ico/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon.ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon.ico/favicon-16x16.png">
    <link rel="manifest" href="../favicon.ico/site.webmanifest">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon.ico/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon.ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon.ico/favicon-16x16.png">
    <link rel="manifest" href="../favicon.ico/site.webmanifest">
    <title>Questionnaire | Online Evaluation System | PrismCode Info Solutions Pvt Ltd</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="./assets/js/require.min.js"></script>
    <script>
        requirejs.config({
            baseUrl: '.'
        });
    </script>
    <!-- Dashboard Core -->
    <link href="./assets/css/dashboard.css" rel="stylesheet" />
    <script src="./assets/js/dashboard.js"></script>
    <!-- Input Mask Plugin -->
    <script src="./assets/plugins/input-mask/plugin.js"></script>
</head>

<body class="">
    <div class="alert alert-warning text-center mb-0 text-uppercase" role="alert">
        Please Note: This application is a working prototype and not the actual evaluation portal. Dummy profiles have been set up and credentials are automatically filled in for the user conveinience.
    </div>
    <div class="page">
        <div class="page-main">
            <div class="header py-4">
                <div class="container">
                    <div class="d-flex">
                        <a class="header-brand" href="./dashboard.php">
                            <img src="../assets/images/logo.png" class="header-brand-img" alt="prismcode logo">
                        </a>
                        <div class="d-flex order-lg-2 ml-auto">
                            <div class="dropdown">
                                <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                    <img class="rounded-circle img-fluid mx-auto d-block" width="35" src="./assets/images/profile.jpg" />
                                    <span class="ml-2 d-none d-lg-block">
                                        <span class="text-default"><?php echo $admin_full_name; ?></span>
                                        <small class="text-muted d-block mt-1">Administrator</small>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="logout.php">
                                        <i class="dropdown-icon fe fe-log-out"></i> Sign out
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                            <span class="header-toggler-icon"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg order-lg-first">
                            <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                                <li class="nav-item">
                                    <a href="./dashboard.php" class="nav-link"><i class="fe fe-home"></i> Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a href="./exams.php" class="nav-link"><i class="fe fe-book"></i> View Exams</a>
                                </li>
                                <li class="nav-item">
                                    <a href="./create_exam.php" class="nav-link"><i class="fe fe-plus"></i> Create/Edit Exam</a>
                                </li>
                                <li class="nav-item">
                                    <a href="./add_questionnaire.php?id=" class="nav-link active"><i class="fe fe-book-open"></i> Add/Edit Questionnaire</a>
                                </li>
                                <li class="nav-item">
                                    <a href="./results.php" class="nav-link"><i class="fe fe-award"></i> View Results</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_POST['submit']) && isset($_POST['questions']) && isset($_POST['option_1']) && isset($_POST['option_2']) && isset($_POST['option_3']) && isset($_POST['option_4']) && isset($_POST['answers']) && isset($_POST['explanations'])) {
                $conn->autocommit(FALSE);
                $sql = "DELETE FROM `question_bank` WHERE `quiz_id` = '$quiz_id';";
                $conn->query($sql);
                $err = FALSE;

                $sql = "INSERT INTO `question_bank`(`quiz_id`, `question`, `explanation`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`) VALUES (?,?,?,?,?,?,?,?);";
                $stmt = $conn->prepare($sql);
                for ($i = 0; $i < $quiz_details['number_of_questions']; $i++) {
                    array_push($questions, $_POST['questions'][$i]);
                    array_push($option_1, $_POST['option_1'][$i]);
                    array_push($option_2, $_POST['option_2'][$i]);
                    array_push($option_3, $_POST['option_3'][$i]);
                    array_push($option_4, $_POST['option_4'][$i]);
                    array_push($answers, $_POST['answers'][$i]);
                    array_push($explanations, $_POST['explanations'][$i]);
                    $stmt->bind_param("issssssi", $quiz_id, $questions[$i], $explanations[$i], $option_1[$i], $option_2[$i], $option_3[$i], $option_4[$i], $answers[$i]);
                    $stmt->execute();
                    if ($stmt->affected_rows == -1) {
                        $err = TRUE;
                    }
                }
                $stmt->close();
                if (!$err) {
                    $sql = "UPDATE `quizes` SET `is_active` = '1' WHERE `quiz_id` = '$quiz_id';";
                    $conn->query($sql);
            ?>
                    <div class="alert alert-icon alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"></button>
                        <i class="fe fe-check mr-2" aria-hidden="true"></i> The questionnaire has been added successfully.
                    </div>
                <?php
                    $questions = $option_1 = $option_2 = $option_3 = $option_4 = $answers = $explanations = array();
                } else {
                    $conn->rollback();
                ?>
                    <div class="alert alert-icon alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"></button>
                        <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> Could not add the questionnaire. Please try again later.
                    </div>
            <?php
                }
                $conn->commit();
            }
            ?>
            <div class="my-3 my-md-5">
                <div class="container">

                    <?php
                    if (count($quiz_details)) {
                    ?>
                        <div class="page-header">
                            <h1 class="page-title">
                                <?php echo (!$is_new) ? "Edit" : "Add"; ?> Questionnaire (<?php echo $quiz_details['quiz_name']; ?>)
                            </h1>
                        </div>
                        <div class="row row-cards row-deck">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title"><?php echo (!$is_new) ? "Edit" : "Add"; ?> Questions</h3>
                                    </div>
                                    <div class="card-body">
                                        <form id="add_questinnaire_form" action="#" method="post">
                                            <?php
                                            for ($i = 0; $i < $quiz_details['number_of_questions']; $i++) {
                                            ?>
                                                <div class="row p-4 mb-2 border rounded border-muted">
                                                    <div class="col-sm-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Question <?php echo $i + 1; ?></label>
                                                            <input type="text" name="questions[]" class="form-control" placeholder="Question <?php echo $i + 1; ?>" value="<?php echo (array_key_exists($i, $questions)) ? $questions[$i] : ""; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Option 1</label>
                                                            <input type="text" name="option_1[]" class="form-control" placeholder="Option 1" value="<?php echo (array_key_exists($i, $option_1)) ? $option_1[$i] : ""; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Option 2</label>
                                                            <input type="text" name="option_2[]" class="form-control" placeholder="Option 2" value="<?php echo (array_key_exists($i, $option_2)) ? $option_2[$i] : ""; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Option 3</label>
                                                            <input type="text" name="option_3[]" class="form-control" placeholder="Option 3" value="<?php echo (array_key_exists($i, $option_3)) ? $option_3[$i] : ""; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Option 4</label>
                                                            <input type="text" name="option_4[]" class="form-control" placeholder="Option 4" value="<?php echo (array_key_exists($i, $option_4)) ? $option_4[$i] : ""; ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Answer</label>
                                                            <select name="answers[]" class="form-control custom-select" required>
                                                                <option value="" disabled>-- Select --</option>
                                                                <option value="1" <?php if (array_key_exists($i, $answers) && $answers[$i] == '1') echo "selected"; ?>>Option 1</option>
                                                                <option value="2" <?php if (array_key_exists($i, $answers) && $answers[$i] == '2') echo "selected"; ?>>Option 2</option>
                                                                <option value="3" <?php if (array_key_exists($i, $answers) && $answers[$i] == '3') echo "selected"; ?>>Option 3</option>
                                                                <option value="4" <?php if (array_key_exists($i, $answers) && $answers[$i] == '4') echo "selected"; ?>>Option 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Explanation</label>
                                                            <textarea name="explanations[]" class="form-control" rows="4" placeholder="Explanation" required><?php echo (array_key_exists($i, $explanations)) ? $explanations[$i] : ""; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </form>
                                    </div>
                                    <div class="card-footer text-right">
                                        <div class="d-flex">
                                            <button form="add_questinnaire_form" type="reset" class="btn btn-secondary">Reset</button>
                                            <button form="add_questinnaire_form" type="submit" name="submit" class="btn btn-primary ml-auto"><?php echo (!$is_new) ? "Update" : "Add"; ?> Questions</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="page-header">
                            <h1 class="page-title">
                                Add/Edit Questionnaire
                            </h1>
                        </div>
                        <div class="row row-cards row-deck">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Select Exam</h3>
                                    </div>
                                    <div class="card-body">
                                        <form id="select_exam_form" action="#" method="get">
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Select Exam</label>
                                                        <select name="id" class="form-control custom-select" required>
                                                            <option value="" disabled>-- Select --</option>
                                                            <?php
                                                            $sql = "SELECT * FROM `quizes`";
                                                            $result = $conn->query($sql);
                                                            while ($row = $result->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $row['quiz_id']; ?>"><?php echo $row['quiz_name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-right">
                                        <div class="d-flex">
                                            <button form="select_exam_form" type="reset" class="btn btn-secondary">Reset</button>
                                            <button form="select_exam_form" type="submit" name="continue" class="btn btn-primary ml-auto">Continue</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mt-3 mt-lg-0 text-center">
                        Online Evaluation System © <?php echo date("Y"); ?> <a href="https://prismcode.in">PrismCode Info Solutions Pvt Ltd</a>. All rights reserved. <br>
                        Developed by <a href="http://www.linkedin.com/in/apreshagarwal">Apresh Agarwal</a> on March 12, 2020.
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
<?php
$conn->close();
?>