<?php
require_once("session_check.php");
require_once('connection.php');
require_once("question_bank.php");
require_once("quiz_state.php");
if (!$_SESSION['inProgress']) {
  header('Location: error.php');
  die();
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
  <link rel="icon" href="./favicon.ico" type="image/x-icon" />
  <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
  <title><?php echo $quiz_title; ?> | Certification System</title>
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
          <div class="d-flex justify-content-between">
            <a class="header-brand" href="#">
              <img src="./assets/images/logo.png" class="header-brand-img" alt="prismcode logo">
            </a>
            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#endQuizModal">
              <i class="fe fe-slash"></i> End Quiz
            </button>
          </div>
        </div>
      </div>
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="page-header">
            <h1 class="page-title">
              <?php echo $quiz_title; ?>
            </h1>
          </div>
          <div class="row row-cards row-deck">
            <div class="col-12 col-sm-4 col-lg-4">
              <div class="card">
                <div class="card-body p-3 text-center">
                  <div class="h1 m-0"><?php echo $total_questions; ?></div>
                  <div class="text-primary mb-4">Total Questions</div>
                </div>
              </div>
            </div>
            <div class="col col-sm-4 col-lg-4">
              <div class="card">
                <div class="card-body p-3 text-center">
                  <div class="h1 m-0"><?php echo $questions_attempted; ?></div>
                  <div class="text-success mb-4">Attempted</div>
                </div>
              </div>
            </div>
            <div class="col col-sm-4 col-lg-4">
              <div class="card">
                <div class="card-body p-3 text-center">
                  <div class="h1 m-0"><?php echo $total_questions - $questions_attempted; ?></div>
                  <div class="text-danger mb-4">Remaining</div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                <div class="progress progress-sm">
                  <div class="progress-bar bg-green" style="width: <?php echo ($questions_attempted / $total_questions) * 100 . "%"; ?>"></div>
                </div>
                <div class="card-header">
                  <h3 class="card-title">Question <?php echo $question_number; ?></h3>
                </div>
                <div class="card-body">
                  <p>
                    <?php echo $question; ?>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <form id="quiz_form" method="get">
                    <div class="form-row mb-2">
                      <div class="col-sm-6 col-xs-12">
                        <div class="custom-control custom-radio">
                          <input type="radio" id="customRadio1" name="selected_option" value="1" <?php if ($selected_option == 1) echo "checked"; ?> class="custom-control-input" required>
                          <label class="custom-control-label" for="customRadio1"><?php echo $option_1; ?></label>
                        </div>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <div class="custom-control custom-radio">
                          <input type="radio" id="customRadio2" name="selected_option" value="2" <?php if ($selected_option == 2) echo "checked"; ?> class="custom-control-input">
                          <label class="custom-control-label" for="customRadio2"><?php echo $option_2; ?></label>
                        </div>
                      </div>
                    </div>
                    <div class="form-row mb-2">
                      <div class="col-sm-6 col-xs-12">
                        <div class="custom-control custom-radio">
                          <input type="radio" id="customRadio3" name="selected_option" value="3" <?php if ($selected_option == 3) echo "checked"; ?> class="custom-control-input">
                          <label class="custom-control-label" for="customRadio3"><?php echo $option_3; ?></label>
                        </div>
                      </div>
                      <div class="col-sm-6 col-xs-12">
                        <div class="custom-control custom-radio">
                          <input type="radio" id="customRadio4" name="selected_option" value="4" <?php if ($selected_option == 4) echo "checked"; ?> class="custom-control-input">
                          <label class="custom-control-label" for="customRadio4"><?php echo $option_4; ?></label>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="d-flex flex-row-reverse justify-content-between">
                <?php
                if ($question_number < $total_questions) {
                ?>
                  <button form="quiz_form" name="action" value="next" type="submit" class="btn btn-pill btn-primary">Next <i class="fe fe-chevron-right"></i></button>
                <?php
                } else {
                ?>
                  <button type="button" class="btn btn-pill btn-primary" data-toggle="modal" data-target="#submitQuizModal">
                    Finish Quiz
                  </button>
                <?php
                }
                ?>
                <?php
                if ($question_number > 1) {
                ?>
                  <form>
                    <button name="action" value="previous" type="submit" class="btn btn-pill btn-outline-secondary"><i class="fe fe-chevron-left"></i> Previous</button>
                  </form>
                <?php
                }
                ?>
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

  <div class="modal fade" id="endQuizModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="endQuizModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">End Quiz?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <!-- <span aria-hidden="true">&times;</span> -->
          </button>
        </div>
        <div class="modal-body">
          If you end the quiz now, your answers might not be recorded. Do you really want to continue?
        </div>
        <div class="modal-footer">
          <a href="results.php" class="btn btn-secondary">Yes, end the quiz.</a>
          <button type="button" class="btn btn-primary" data-dismiss="modal">No, resume.</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="submitQuizModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="submitQuizModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Submit Quiz?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <!-- <span aria-hidden="true">&times;</span> -->
          </button>
        </div>
        <div class="modal-body">
          You won't be able to make changes after you submit. Do you want to continue?
        </div>
        <div class="modal-footer">
          <button form="quiz_form" name="action" type="submit" class="btn btn-secondary">Yes, submit the quiz.</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">No, not right now.</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>