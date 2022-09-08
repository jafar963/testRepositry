<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
?>
<?php if (isset($_SESSION['user'])  && $_SESSION['user']->role_id == "2" && $_SESSION['user']->isActive == "1") { ?>
    <?php
    $examModel = $this->loadModel('Test_center_admin_managmentModel');
    $subject_exam_center_available=$examModel->getAllSubjectAvailable();
    $examscenter = $examModel->showExams($_SESSION['user']->id);
    $arr_student = $examModel->showMarksStudentINCenter($_SESSION['user']->id);
    $num_students=$examModel ->getNumberStudent($_SESSION['user']->id);
    $num_subjects=$examModel ->getNumberSubject($_SESSION['user']->id);
    $num_exams=$examModel ->getNumberTest($_SESSION['user']->id);
    $num_questions=$examModel ->getNumberQuestion($_SESSION['user']->id);
    

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo URL;  ?> public/images/title.png">
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/table.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/profile.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/editProfile.css">
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/all.min.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/test center.css">
        <link rel="icon" href="<?php echo URL;?> public/images/title.png">

        <title>test center admin</title>
        <script src="<?php echo URL; ?>public/js/jquery.min.js">
        </script>
    </head>

    <body class="body-admincenter">
        <?php
        $testcentermodel = $this->loadModel('testCenterModel');
        $centers = $testcentermodel->getAllTestCenter();
        ?>
        <div class="left-side-bar">
            <div class="nav-side">
                <h1>Test Center Admin</h1>
                <br>
                <?php if ($_SESSION['user']->image != null) { ?>
                    <img class="admin-logo" src="<?php echo URL; ?>public/images/<?php echo $_SESSION['user']->image; ?> " />
                <?php } else { ?>
                    <img class="admin-logo" src="<?php echo URL; ?>public/images/user.jpg " />
                <?php } ?>
                <hr>
            </div>
            <div class="side-menu">
                <ul>
                    <li>
                        <a href="<?php echo URL; ?> profile/index.php">
                            <i class="fa fa-user" style="width:30px;  margin-left:3px;"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URL; ?>exam_Mangment_center/index.php" class="chiox">
                            <i class="fa fa-graduation-cap" aria-hidden="true" style="width:30px;  margin-left:3px;"></i>
                            <span>Exam Managment</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URL; ?> student_managment_incenter/index.php" class="chiox">
                            <i class="fa fa-users " aria-hidden="true" style="width:30px;  margin-left:3px;"></i>
                            <span> Student Mangment</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URL; ?> home/home-page.php">
                            <i class="fa fa-home" aria-hidden="true" style="width:30px;  margin-left:3px;"></i>
                            <span>Home </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo URL; ?>home/logout">
                            <i class='fas fa-sign-out-alt' style="width:30px;  margin-left:3px;"></i>
                            <span class="links_name">Log out</span>
                        </a>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <header>
                <div id="logo"><span class="logo">Q</span>uiz Maker</div>
                <div class="head-icons">
                <a  class="admin_name" href="<?php echo URL;?> profile/index.php" style="text-decoration: none; color:black; font-style:italic;">

                    <div class="profile">
                    <span style="font-size:24px; font-weight:bold; color:black; margin-right:30px;">
                            <?php echo $_SESSION['user']->firstName . ' ' . $_SESSION['user']->lastName; ?>
                        </span>
                        <?php if ($_SESSION['user']->image != null) { ?>
                            <img class="admin-profile" src="<?php echo URL; ?>public/images/<?php echo $_SESSION['user']->image; ?> " />
                        <?php } else { ?>
                            <img class="admin-profile" src="<?php echo URL; ?>public/images/user.jpg " />
                        <?php } ?>
                    </div>
                        </a>
                </div>
            </header>
            <main>
                <div class="cards1">
                    <div class="card1">
                        <div class="card-icon1 formateur1">
                            <h3>Total Student</h3>
                        </div>
                        <div class="card-icon1 formateur1">
                        <i class="fa fa-user" aria-hidden="true" style="font-size:30px;margin-bottom:10px;  margin-left:20px;"></i>    
                            <h2><?php echo  $num_students?></h2>
                        </div>
                    </div>
                    <div class="card1">
                        <div class="card-info1">
                            <h3>Total Exams</h3>
                        </div>
                        <div class="card-icon1 formateur1">
                        <i class="fa-solid fa-graduation-cap" style="font-size:30px;margin-bottom:10px; margin-left:20px;"></i>
                            <h2><?php echo  $num_exams?></h2>
                        </div>
                    </div>
                    <div class="card1">
                        <div class="card-info1">
                            <h3>Total Subjects</h3>
                        </div>
                        <div class="card-icon1 formateur1">
                        <i class="fa fa-book" aria-hidden="true"style="font-size:30px; margin-bottom:10px;  margin-left:20px;"></i>
                            <h2><?php echo  $num_subjects?></h2>
                        </div>
                    </div>
                    <div class="card1">
                        <div class="card-info1">
                            <h3>Total Questions</h3>
                        </div>
                        <div class="card-icon1 formateur1">
                        <i class="fa fa-question" aria-hidden="true"  style="font-size:30px; margin-bottom:10px;  margin-left:20px;"></i>           
                            <h2><?php echo  $num_questions?></h2>
                        </div>
                    </div>

                </div>
            </main>
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