<?php
require_once('session_check.php');
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
    <title>Create Exam | Online Evaluation System | PrismCode Info Solutions Pvt Ltd</title>
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
                                    <a href="./create_exam.php" class="nav-link active"><i class="fe fe-plus"></i> Create/Edit Exam</a>
                                </li>
                                <li class="nav-item">
                                    <a href="./add_questionnaire.php" class="nav-link"><i class="fe fe-book-open"></i> Add/Edit Questionnaire</a>
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
            $exam_name = $difficulty_level = $description = $number_of_questions = "";
            if (isset($_POST['submit']) && isset($_POST['exam_name']) && isset($_POST['difficulty_level']) && isset($_POST['description']) && isset($_POST['number_of_questions'])) {
                $exam_name = $_POST['exam_name'];
                $difficulty_level = $_POST['difficulty_level'];
                $description = $_POST['description'];
                $number_of_questions = $_POST['number_of_questions'];
                $sql = "INSERT INTO `quizes`(`quiz_id`, `quiz_name`, `difficulty_level`, `description`, `number_of_questions`, `is_active`, `timestamp`) VALUES (NULL,'$exam_name','$difficulty_level','$description','$number_of_questions',DEFAULT,DEFAULT)";
                if ($conn->query($sql)) {
                    $insert_id = $conn->insert_id;
                    $key = base64_encode(md5(EXAM_KEY_PREFIX . $insert_id));
                    $sql = "UPDATE `quizes` SET `quiz_key` = '$key' WHERE `quiz_id` = '$insert_id'";
                    $conn->query($sql);
            ?>
                    <div class="alert alert-icon alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"></button>
                        <i class="fe fe-check mr-2" aria-hidden="true"></i> The exam <b><?php echo $exam_name ?></b> has been created successfully. <a href="add_questionnaire.php?id=<?php echo $insert_id; ?>">Add a Questionnaire?</a>
                    </div>
                <?php
                    $exam_name = $difficulty_level = $description = $number_of_questions = "";
                } else {
                ?>
                    <div class="alert alert-icon alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"></button>
                        <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> Exam creation failed. Please try again later.
                    </div>
            <?php
                }
            }
            ?>
            <div class="my-3 my-md-5">
                <div class="container">
                    <div class="page-header">
                        <h1 class="page-title">
                            Create Exam
                        </h1>
                    </div>
                    <div class="row row-cards row-deck">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Create Exam</h3>
                                </div>
                                <div class="card-body">
                                    <form id="create_exam_form" action="#" method="post">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label">Exam Name</label>
                                                    <input type="text" name="exam_name" class="form-control" placeholder="Exam Name" value="<?php echo $exam_name; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label">Difficulty Level</label>
                                                    <div class="selectgroup w-100">
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="difficulty_level" value="Beginner" <?php if ($difficulty_level == "Beginner") echo "checked=\"\""; ?> class="selectgroup-input" required>
                                                            <span class="selectgroup-button">Beginner</span>
                                                        </label>
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="difficulty_level" value="Intermediate" <?php if ($difficulty_level == "Intermediate") echo "checked=\"\""; ?> class="selectgroup-input">
                                                            <span class="selectgroup-button">Intermediate</span>
                                                        </label>
                                                        <label class="selectgroup-item">
                                                            <input type="radio" name="difficulty_level" value="Advance" <?php if ($difficulty_level == "Advance") echo "checked=\"\""; ?> class="selectgroup-input">
                                                            <span class="selectgroup-button">Advance</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label">Description <span class="form-label-small"><span id="character_count">0</span>/1500</span></label>
                                                    <textarea onkeyup="$('#character_count').text(this.value.length);" maxlength="1500" class="form-control" name="description" rows="6" placeholder="Exam Description..." required><?php echo $description; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label">Number of Questions</label>
                                                    <input type="number" min="1" name="number_of_questions" class="form-control" placeholder="Number of Questions" value="<?php echo $number_of_questions; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-right">
                                    <div class="d-flex">
                                        <button form="create_exam_form" type="reset" class="btn btn-secondary">Reset</button>
                                        <button form="create_exam_form" type="submit" name="submit" class="btn btn-primary ml-auto">Create Exam</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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