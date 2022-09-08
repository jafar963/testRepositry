<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
?>
<?php if (isset($_SESSION['user'])  && $_SESSION['user']->role_id == "3") {
  $test_detail = $this->loadModel('student_has_exam_Model');
  $test_all = $test_detail->showExams($_SESSION['user']->id); ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student</title>
    <link rel="icon" href="<?php echo URL;?> public/images/title.png">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/admin.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/error.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/register.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/profile.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/editProfile.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/register.css">
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/table.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js">
      
    </script>
    
  </head>

  <body>
    <div id="page">

      <div class="sidebar">
        
        <div class="logo-details">
          <i class='bx bxl-c-plus-plus'> <?php echo  "Student" ?>
            <hr style=" width:100%;">
          </i>
        </div>
        <ul class="nav-links" style="margin-top:10px;">
          <li>
            <a href="<?php echo URL; ?> profile/index.php">
              <i class="fa fa-user" style="width:30px;  margin-left:3px;"></i>
              <span class="links_name">Profile</span>
            </a>
          </li>
          <li>
            <a href="<?php echo URL; ?> student_centers/index.php">
              <i class="fa fa-graduation-cap" aria-hidden="true" style="width:30px;  margin-left:3px;"></i>
              <span class="links_name">Available exam centers</span>
            </a>
          </li>
          <li>
            <a href="<?php echo URL; ?> presented_exam/index.php">
              <i class="fa fa-book" aria-hidden="true" style="width:30px;  margin-left:3px;"></i>
              <span class="links_name">Presented exams</span>
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
            <span class="dashboard" style="font-weight:bold;">My page</span>
            <div id="logo"><span class="logo">Q</span>uiz Maker</div>
          </div>
          <a  class="admin_name" href="<?php echo URL;?> profile/index.php" style="text-decoration: none; color:black; font-style:italic;">

          <div class="profile-details">
              <span style="font-size:24px; font-weight:bold; margin-right:60px;">
                <?php echo $_SESSION['user']->firstName .' ' . $_SESSION['user']->lastName; ?>
              </span>
              <?php if ($_SESSION['user']->image != null) { ?>
                    <img class="admin-logo" src="<?php echo URL; ?>public/images/profile/<?php echo $_SESSION['user']->image; ?> " />
                <?php } else { ?>
                    <img class="admin-logo" src="<?php echo URL; ?>public/images/profile/user.jpg " />
                <?php } ?>
          </div>
                </a>
        </nav>
        <img src="<?php echo URL; ?>public/images/exam.jpg" width="100%" style="position:absolute ; left:0;top:0; opacity:0.7" alt="media"> 
             <?php } 
      else {
      $error_msg = "You do not have sufficient permissions to login !!";
      require 'application/views/_templates/header.php';
      require 'application/views/login/index.php';
      require 'application/views/error/index.php';
      require 'application/views/_templates/footer.php';
    } ?>

    