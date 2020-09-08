<?php
require_once("calculate_results.php");
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
    <link rel="icon" href="./favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <title>Results | Quiz Demo by PrismCode Info Solutions</title>
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
                        <a class="header-brand" href="#">
                            <img src="./assets/images/logo.png" class="header-brand-img" alt="prismcode logo">
                        </a>
                    </div>
                </div>
            </div>
            <div class="my-3 my-md-5">
                <div class="container">
                    <div class="page-header">
                        <h1 class="page-title">
                            Thank you for attempting the <?php echo $quiz_title; ?> exam. <?php echo ($correct_answers_percentage >= 70) ? "Congratulations on clearing the assessment!" : "Unfortunately, you need more practice before you can clear the assessment."; ?>
                        </h1>
                    </div>
                    <div class="row row-cards row-deck">
                        <div class="col-12 col-sm-3 col-lg-3">
                            <div class="card">
                                <div class="card-body p-3 text-center">
                                    <div class="h1 m-0"><?php echo $total_questions; ?></div>
                                    <div class="text-primary mb-4">Total Questions</div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-sm-3 col-lg-3">
                            <div class="card">
                                <div class="card-body p-3 text-center">
                                    <div class="h1 m-0"><?php echo $unattempted; ?></div>
                                    <div class="text-warning mb-4">Unattempted Questions</div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-sm-3 col-lg-3">
                            <div class="card">
                                <div class="card-body p-3 text-center">
                                    <div class="h1 m-0"><?php echo $correct_answers; ?></div>
                                    <div class="text-success mb-4">Correct Answers</div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-sm-3 col-lg-3">
                            <div class="card">
                                <div class="card-body p-3 text-center">
                                    <div class="h1 m-0"><?php echo $incorrect_answers; ?></div>
                                    <div class="text-danger mb-4">Incorrect Answers</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Performance Chart</h3>
                                </div>
                                <div class="card-body">
                                    <div id="chart-pie" style="height: 12rem; max-height: 192px; position: relative;" class="c3"><svg width="166" height="192" style="overflow: hidden;">
                                        </svg>
                                        <div class="c3-tooltip-container" style="position: absolute; pointer-events: none; display: none;"></div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                require(['c3', 'jquery'], function(c3, $) {
                                    $(document).ready(function() {
                                        var chart = c3.generate({
                                            bindto: '#chart-pie', // id of chart wrapper
                                            data: {
                                                columns: [
                                                    // each columns data
                                                    ['data1', <?php echo $correct_answers_percentage; ?>],
                                                    ['data2', <?php echo $incorrect_answers_percentage; ?>],
                                                    ['data3', <?php echo $unattempted_percentage; ?>],
                                                ],
                                                type: 'pie', // default type of chart
                                                colors: {
                                                    'data1': "#5eba00",
                                                    'data2': "#cd201f",
                                                    'data3': "#f1c40f",
                                                },
                                                names: {
                                                    // name of each serie
                                                    'data1': 'Correct Answers',
                                                    'data2': 'Incorrect Answers',
                                                    'data3': 'Unattempted Questions',
                                                }
                                            },
                                            axis: {},
                                            legend: {
                                                show: false, //hide legend
                                            },
                                            padding: {
                                                bottom: 0,
                                                top: 0
                                            },
                                        });
                                    });
                                });
                            </script>
                        </div>
                        <div class="col-sm-12">
                            <div class="accordion" id="accordionExample">
                                <?php
                                foreach ($summary as $key => $value) {
                                ?>
                                    <div class="card border <?php echo (strip_tags($value['selected_option']) == "Unattempted") ? "border-warning" : ((md5($value['selected_option']) == md5($value['correct_option'])) ? "border-success" : "border-danger"); ?>">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $key; ?>" aria-expanded="true" aria-controls="collapse<?php echo $key; ?>">
                                                    Question <?php echo $key; ?>
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapse<?php echo $key; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body text-justify">
                                                <p><b><?php echo $value['question']; ?></b></p>
                                                <p><span class="text-white <?php echo (strip_tags($value['selected_option']) == "Unattempted") ? "bg-warning" : ((md5($value['selected_option']) == md5($value['correct_option'])) ? "bg-success" : "bg-danger"); ?> p-1">Selected Option:</span></p>
                                                <p><?php echo $value['selected_option']; ?></p>
                                                <p><span class="text-white bg-success p-1">Correct Option:</span></p>
                                                <p><?php echo $value['correct_option']; ?></p>
                                                <p><?php if ($value['explanation']) {
                                                    ?>
                                                        <p><span class="text-white bg-secondary p-1">Explanation:</span></p>
                                                        <p><i><?php echo $value['explanation']; ?></i></p>
                                                    <?php
                                                    } else {
                                                        echo "No explanation available for this question.";
                                                    } ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-sm-12 text-center">
                            <a href="end_quiz.php" class="btn btn-square btn-primary">Reattempt the Quiz</a>
                        </div>
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