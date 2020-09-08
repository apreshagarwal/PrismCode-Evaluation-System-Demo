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
  <title>Dashboard | Online Evaluation System | PrismCode Info Solutions Pvt Ltd</title>
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
                  <a href="./dashboard.php" class="nav-link active"><i class="fe fe-home"></i> Dashboard</a>
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
                  <a href="./results.php" class="nav-link"><i class="fe fe-award"></i> View Results</a>
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
              Dashboard
            </h1>
          </div>
          <div class="row row-cards">
            <div class="col-12 col-sm-6 col-lg-3">
              <?php
              $sql = "SELECT COUNT(*) FROM `quizes` WHERE `is_active` = '1'";
              $result = $conn->query($sql)->fetch_array()[0];
              ?>
              <div class="card bg-primary">
                <div class="card-body p-3 text-center">
                  <div class="h1 m-0 text-white"><?php echo $result; ?></div>
                  <div class="text-white mb-4">Active Exams</div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <?php
              $sql = "SELECT COUNT(*) FROM `attempts`";
              $result = $conn->query($sql)->fetch_array()[0];
              ?>
              <div class="card bg-warning">
                <div class="card-body p-3 text-center">
                  <div class="h1 m-0 text-white"><?php echo $result; ?></div>
                  <div class="text-white mb-4">Attempts</div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <?php
              $sql = "SELECT COUNT(*) FROM `attempts` WHERE `score` >= 70";
              $result = $conn->query($sql)->fetch_array()[0];
              ?>
              <div class="card bg-success">
                <div class="card-body p-3 text-center">
                  <div class="h1 m-0 text-white"><?php echo $result; ?></div>
                  <div class="text-white mb-4">Passed</div>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
              <?php
              $sql = "SELECT COUNT(*) FROM `attempts` WHERE `score` <= 70";
              $result = $conn->query($sql)->fetch_array()[0];
              ?>
              <div class="card bg-danger">
                <div class="card-body p-3 text-center">
                  <div class="h1 m-0 text-white"><?php echo $result; ?></div>
                  <div class="text-white mb-4">Failed</div>
                </div>
              </div>
            </div>
          </div>
          <div class="row row-cards row-deck">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Exams</h3>
                </div>
                <?php
                $sql = "SELECT * FROM `quizes` ORDER BY `quiz_id` DESC";
                $result = $conn->query($sql);
                if ($result->num_rows) {
                ?>
                  <div class="table-responsive">

                    <table class="table card-table table-vcenter text-nowrap">
                      <thead>
                        <tr>
                          <th class="w-1">S No.</th>
                          <th>Exam Name</th>
                          <th>Exam Key</th>
                          <th>Difficulty Level</th>
                          <th>Description</th>
                          <th>No. of Questions</th>
                          <th>Is Active</th>
                          <th>Created</th>
                          <th></th>
                          <th></th>
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
                            <td><?php echo $row['quiz_key']; ?></td>
                            <td><?php echo $row['difficulty_level']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['number_of_questions']; ?></td>
                            <td>
                              <?php if ($row['is_active']) {
                              ?>
                                <span class="status-icon bg-success"></span> Active
                              <?php
                              } else {
                              ?>
                                <span class="status-icon bg-danger"></span> Inactive
                              <?php
                              } ?>
                            </td>
                            <td><?php echo date("d F Y", strtotime($row['timestamp'])); ?></td>
                            <td class="text-right">
                              <!-- <a class="icon" href="delete_exam.php?id=<?php echo $row['quiz_id']; ?>">
                                <i class="fe fe-trash text-danger"></i>
                              </a> -->
                              <a class="icon" href="#" onclick="$('#deleteURL').attr('href', 'delete_exam.php?id=<?php echo $row['quiz_id']; ?>')" data-toggle="modal" data-target="#exampleModal">
                                <i class="fe fe-trash text-danger"></i>
                              </a>
                            </td>
                            <td>
                              <a class="icon" href="edit_exam.php?id=<?php echo $row['quiz_id']; ?>">
                                <i class="fe fe-edit text-primary"></i>
                              </a>
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
                    <p class="text-capitalize">no exams created. <a href="create_exam.php">create an exam.</a></p>
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

  <div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Quiz?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          Do you really want to delete this quiz? This action cannot be undone. Please proceed with caution!
        </div>
        <div class="modal-footer">
          <a id="deleteURL" href="" class="btn btn-secondary">Yes, delete.</a>
          <button type="button" class="btn btn-primary" data-dismiss="modal">No, don't delete.</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<?php
$conn->close();
?>