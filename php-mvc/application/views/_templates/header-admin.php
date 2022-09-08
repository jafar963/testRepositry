<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
$userModel = $this->loadModel('userModel');
$subjectModel = $this->loadModel('subjectModel');
$topicModel = $this->loadModel('topicModel');
$questionModel = $this->loadModel('questionModel');
$centerModel = $this->loadModel('Test_center_admin_managmentModel');

$num_student = $userModel->getNumberStudent();
$num_users = $userModel->getNumberUsers();
$num_admin = $userModel->getNumberAdmin();
$admin_test = $userModel->getNumberAdminTestCenter();
$num_students = $userModel->getNumberStudent();

$num_questions = $questionModel->getNumberQuestion();
$num_topic = $topicModel->getNumberTopic();
$num_subject = $subjectModel->getNumberSubject();
$num_exam = $questionModel->getNumberTest();

$users_without_center = $userModel->getUserTestCenterAvailable();
$users = $userModel->getAllUsers();
$topics = $topicModel->showtopics();
$subjects = $subjectModel->showmaterial();
$exams = $questionModel->showExams();
$questions = $questionModel->showQuestions();
$centers = $centerModel->showcenters();
?>
<?php if (isset($_SESSION['user'])  && $_SESSION['user']->role_id == "1" && $_SESSION['user']->isActive == "1") { ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/admin.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/error.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/register.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/allusers.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/profile.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/editProfile.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/table.css">
    <link rel="icon" href="<?php echo URL; ?> public/images/title.png">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/all.min.css" />
    <script src="<?php echo URL; ?>public/js/jquery.min.js">
    </script>
  </head>

  <body>
    <div id="page">
      <div class="sidebar">
        <div class="logo-details">
          <i class='bx bxl-c-plus-plus'> <?php echo  "Admin" ?>
            <hr style=" width:100%;">
          </i>
        </div>
        <ul class="nav-links">
          <li>
            <a href="<?php echo URL; ?> profile/index.php">
              <i class="fa fa-user" style="width:30px;  margin-left:3px;"></i>
              <span class="links_name">Profile</span>
            </a>
          </li>
          <li>
            <a href="<?php echo URL; ?> managment_materials/index.php">
              <i class="fa fa-book" aria-hidden="true" style="width:30px;  margin-left:3px;"></i>
              <span class="links_name">Materials management</span>
            </a>
          </li>
          <li>
            <a href="<?php echo URL; ?> Test_center_admin_managment/index.php">
              <i class="fa fa-university" aria-hidden="true" style="width:30px;  margin-left:3px;"></i>
              <span class="links_name">Test Center management</span>
            </a>
          </li>
          <li>
            <a href="<?php echo URL; ?> topics_managment/index.php">
              <i class="fa fa-clipboard" aria-hidden="true" style="width:30px;  margin-left:3px;"></i>
              <span class="links_name">Topics management</span>
            </a>
          </li>
          <li>
            <a href="<?php echo URL; ?> question/index">
              <i class="fa fa-question" aria-hidden="true" style="width:30px;  margin-left:3px;"></i>
              <span class="links_name">Questions management</span>
            </a>
          </li>
          <li>
            <a href="<?php echo URL; ?> exam_managment/index.php">
              <i class="fa fa-graduation-cap" aria-hidden="true" style="width:30px;  margin-left:3px;"></i>
              <span class="links_name">Exam management</span>
            </a>
          </li>
          <li>
            <a href="<?php echo URL; ?> all_users/index.php">
              <i class="fa fa-users " aria-hidden="true" style="width:30px;  margin-left:3px;"></i>
              <span class="links_name">Users management</span>
            </a>
          </li>
          <li>
            <a href="<?php echo URL; ?> home/home-page.php">
              <i class="fa fa-home" aria-hidden="true" style="width:30px;  margin-left:3px;"></i>
              <span class="links_name">Home</span>
            </a>
          </li>
          <li>
            <a href="<?php echo URL; ?>home/logout">
              <i class='fas fa-sign-out-alt' style="width:30px;  margin-left:3px;"></i>
              <span class="links_name">Log out</span>
            </a>
          </li>
        </ul>
      </div>
      <section class="home-section">
        <nav>
          <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Dashboard</span>
            <div id="logo"><span class="logo">Q</span>uiz Maker</div>
          </div>
          <div class="profile-details">

            <a class="admin_name" href="<?php echo URL; ?> profile/index.php">

              <span style="font-size:24px; font-weight:bold; margin-right:60px;">
                <?php if (isset($_SESSION['user'])) {
                  echo $_SESSION['user']->firstName . ' ' . $_SESSION['user']->lastName;
                } ?>
              </span>
            </a>
            <?php if ($_SESSION['user']->image != null) { ?>
              <img class="admin-logo" src="<?php echo URL; ?>public/images/profile/<?php echo $_SESSION['user']->image; ?> " />
            <?php } else { ?>
              <img class="admin-logo" src="<?php echo URL; ?>public/images/profile/user.jpg " />
            <?php } ?>
          </div>
        </nav>
        <div class="home-content">
          <div class="overview-boxes">
            <div class="box">
              <div class="right-side">
                <div class="box-topic">Total Students</div>
                <div class="number"><?php
                                    echo  $num_students ?></div>
              </div>
              <i class="fa fa-user" aria-hidden="true" style="font-size:30px;  margin-left:20px;"></i>
            </div>
            <div class="box">
              <div class="right-side">
                <div class="box-topic">Total Users</div>
                <div class="number"><?php
                                    echo  $num_users ?></div>
              </div>
              <i class="fa fa-users " aria-hidden="true" style="font-size:30px;  margin-left:20px;"></i>
            </div>
            <div class="box">
              <div class="right-side">
                <div class="box-topic">Total Admin</div>
                <div class="number"><?php
                                    echo  $num_admin ?></div>
              </div>
              <i class="fa fa-user" aria-hidden="true" style="font-size:30px;  margin-left:20px;"></i>
            </div>
            <div class="box">
              <div class="right-side">
                <div class="box-topic">Total Admin test center</div>
                <div class="number"><?php
                                    echo  $admin_test ?></div>
              </div>
              <i class="fa fa-university" aria-hidden="true" style="font-size:30px;  margin-left:20px;"></i>
            </div>
          </div>
          <div class="overview-boxes">
            <div class="box">
              <div class="right-side">
                <div class="box-topic">Total Exams</div>
                <div class="number"><?php
                                    echo  $num_exam ?></div>
              </div>
              <i class="fa-solid fa-graduation-cap" style="font-size:30px; margin-left:20px;"></i>
            </div>
            <div class="box">
              <div class="right-side">
                <div class="box-topic">Total Questions</div>
                <div class="number"><?php
                                    echo  $num_questions ?></div>
              </div>
              <i class="fa fa-question" aria-hidden="true" style="font-size:30px;  margin-left:20px;"></i>
            </div>
            <div class="box">
              <div class="right-side">
                <div class="box-topic">Total Subjects</div>
                <div class="number"><?php
                                    echo   $num_subject ?></div>
              </div>
              <i class="fa fa-book" aria-hidden="true" style="font-size:30px;  margin-left:20px;"></i>
            </div>
            <div class="box">
              <div class="right-side">
                <div class="box-topic">Total Topics</div>
                <div class="number"><?php
                                    echo   $num_topic ?></div>
              </div>
              <i class="fa fa-clipboard" aria-hidden="true" style="font-size:30px;  margin-left:20px;"></i>
            </div>
          </div>
        <?php } else {
        if (isset($_SESSION['user'])) {
          if ($_SESSION['user']->isActive == "0") {
            $error_msg = "Your account has been deactivated !!";
          }
        } else {
          $error_msg = "You do not have sufficient permissions to login !!";
        }
        require 'application/views/_templates/header.php';
        require 'application/views/login/index.php';
        require 'application/views/error/index.php';
        require 'application/views/_templates/footer.php';
      } ?>