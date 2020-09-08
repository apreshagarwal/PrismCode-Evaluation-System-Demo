<?php
session_start();
require_once('connection.php');
$quiz_id = $username = $password = $student_user_id = $error = "";

define('DEMO_EXAM_KEY', 'ZDk4M2M1ZTljNWJkYWZlNTNiM2QzMDk0NDVkZTlkNDc=', true);

if (isset($_POST['submit']) && isset($_POST['quiz_id']) && isset($_POST['password']) && isset($_POST['username'])) {
  filter_input_array(INPUT_POST);
  $quiz_id = $_POST['quiz_id'];
  $password = $_POST['password'];
  $password = hash("sha256", $password);
  $username = $_POST['username'];

  if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

    // Google secret API
    $secretAPIkey = GOOGLE_RECAPTCHA_SEC;

    // reCAPTCHA response verification
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretAPIkey . '&response=' . $_POST['g-recaptcha-response']);

    // Decode JSON data
    $response = json_decode($verifyResponse);
    if ($response->success) {

      // Verify credentials
      $sql = "SELECT `student_user_id` FROM `student_users` WHERE `username` = ? AND `password` = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ss", $username, $password);
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($student_user_id);
      $stmt->fetch();
      if ($stmt->num_rows) {

        $stmt->close();

        // Registering the attempt
        $sql = "INSERT INTO `attempts`(`quiz_id`, `student_user_id`) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $quiz_id, $student_user_id);
        $stmt->execute();

        // Configuring the session
        $_SESSION['quiz_id'] = $quiz_id;
        $_SESSION['password'] = $password;
        $_SESSION['username'] = $username;
        $_SESSION['attempt_id'] = $stmt->insert_id;
        $_SESSION['exam_key'] = DEMO_EXAM_KEY;
        $_SESSION['question_number'] = 1;
        $_SESSION['questions_attempted'] = 0;
        $_SESSION['answers'] = array();
        $_SESSION['inProgress'] = true;

        // Redirecting to the quiz page
        echo "<meta http-equiv=\"refresh\" content=\"0;url=quiz.php\" />";
        die();
      } else {

        // Wrong Credentials
        $error = "Wrong credentials! Please try again with correct username/password.";
        $stmt->close();
      }
    } else {

      // Recaptcha Verification Failed
      $error = "Recaptcha verification failed! please try again.";
    }
  } else {

    // Recaptcha challenge not taken
    $error = "Please verify that you are a human by clicking the Recaptcha box!";
  }
}
$conn->close();
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
  <link rel="apple-touch-icon" sizes="180x180" href="./favicon.ico/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./favicon.ico/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./favicon.ico/favicon-16x16.png">
  <link rel="manifest" href="./favicon.ico/site.webmanifest">
  <title>Online Evaluation System | PrismCode Info Solutions Pvt Ltd</title>
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
  <!-- Google Recaptcha -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!-- Input Mask Plugin -->
  <script src="./assets/plugins/input-mask/plugin.js"></script>
</head>

<body class="">
  <div class="alert alert-warning text-center mb-0 text-uppercase" role="alert">
    Please Note: This application is a working prototype and not the actual evaluation portal. Dummy profiles have been set up and credentials are automatically filled in for the user conveinience.
  </div>
  <?php
  if ($error) {
  ?>
    <div class="alert alert-danger text-center mb-0 text-uppercase" role="alert">
      <?php echo $error; ?>
    </div>
  <?php
  }
  ?>
  <div class="page">
    <div class="page-single">
      <div class="container">
        <div class="row">
          <div class="col mx-auto">
            <img src="./assets/banner.png" class="img-fluid mb-5" alt="">
            <p class="text-center">
              An online portal for student performance assessment for the students of <a href="https://prismcode.in" target="_blank">PrismCode Info Solutions Private Limited</a>
            </p>
          </div>
          <div class="col col-login mx-auto">
            <form class="card" method="post">
              <div class="card-body p-6">
                <div class="card-title text-center">
                  <a class="h5 text-dark" href="https://prismcode.in" target="_blank">PrismCode Info Solutions Pvt Ltd</a>
                </div>
                <div class="form-group">
                  <label class="form-label">Select Course</label>
                  <select name="quiz_id" class="form-control custom-select" required>
                    <option value="" disabled>-- Select --</option>
                    <option value="1" selected>Python (Demo)</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Registered Email</label>
                  <input name="username" type="email" class="form-control" placeholder="Your Email" value="student@demo" required>
                </div>
                <div class="form-group">
                  <label class="form-label">Password</label>
                  <input name="password" type="password" class="form-control" minlength="8" value="password" placeholder="********" required>
                </div>
                <div class="form-footer text-center">
                  <div class="g-recaptcha" data-sitekey="<?php echo GOOGLE_RECAPTCHA_PUB; ?>"></div>
                  <button name="submit" type="submit" class="btn btn-primary btn-block mb-3">Next</button>
                  <a class="text-primary" href="./admin/index.php" target="_blank">Are you an Admin?</a>
                </div>
              </div>
            </form>
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