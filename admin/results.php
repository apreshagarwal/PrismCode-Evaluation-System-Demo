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
    <title>Evaluation Results | Online Evaluation System | PrismCode Info Solutions Pvt Ltd</title>
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
    <!-- c3.js Charts Plugin -->
    <link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/maps-google/plugin.js"></script>
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
                                    <a href="./add_questionnaire.php" class="nav-link"><i class="fe fe-book-open"></i> Add/Edit Questionnaire</a>
                                </li>
                                <li class="nav-item">
                                    <a href="./results.php" class="nav-link active"><i class="fe fe-award"></i> View Results</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-3 my-md-5">
                <div class="container">
                    <div class="page-header">
                        <h1 class="page-title">
                            Results
                        </h1>
                    </div>
                    <div class="row row-cards row-deck">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Results</h3>
                                </div>
                                <?php
                                $sql = "SELECT `attempts`.*, `student_users`.`full_name`, `student_users`.`username`, `quizes`.`quiz_name` FROM `attempts`, `student_users`, `quizes` WHERE `attempts`.`quiz_id` = `quizes`.`quiz_id` AND `attempts`.`student_user_id` = `student_users`.`student_user_id` ORDER BY `attempts`.`attempt_id` DESC";
                                $result = $conn->query($sql);
                                if ($result->num_rows) {
                                ?>
                                    <div class="table-responsive">

                                        <table class="table card-table table-vcenter text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="w-1">S No.</th>
                                                    <th>Exam Name</th>
                                                    <th>Taken by</th>
                                                    <th>Email</th>
                                                    <th>Taken on</th>
                                                    <th>Score</th>
                                                    <th>Result</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                while ($row = $result->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td><span class="text-muted"><?php echo ++$i; ?></span></td>
                                                        <td><?php echo $row['quiz_name']; ?></td>
                                                        <td><?php echo $row['full_name']; ?></td>
                                                        <td><?php echo $row['username']; ?></td>
                                                        <td><?php echo date("d F Y h:i A", strtotime($row['timestamp'])); ?></td>
                                                        <td><?php echo $row['score']; ?></td>
                                                        <td>
                                                            <?php if (is_null($row['score'])) {
                                                            ?>
                                                                <span class="status-icon bg-warning"></span> Unfinished / In Progress
                                                            <?php
                                                            } elseif ($row['score'] >= 70) {
                                                            ?>
                                                                <span class="status-icon bg-success"></span> Passed
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span class="status-icon bg-danger"></span> Failed
                                                            <?php
                                                            } ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="card-body">
                                        <p class="text-capitalize">no results to display.</p>
                                    </div>
                                <?php
                                }
                                ?>
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