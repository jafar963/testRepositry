<?php
if (session_status() != PHP_SESSION_ACTIVE)
   session_start();
if (isset($_SESSION['user'])  && $_SESSION['user']->role_id == "3") {
   $name = $_SESSION['name'];
?>
   <!DOCTYPE html>
   <html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Introduction</title>
      <link rel="stylesheet" href="<?php echo URL; ?>public/css/introduction.css">
      <link rel="icon" href="./images/title.png">
   </head>

   <body>
      <div class="container">
         <div class="leftSide">
            <img src="<?php echo URL; ?>public/images/logo-quiz.jpeg" alt="quiz-logo" class="title">
         </div>
         <div class="rightSide">
            <h2>welcome to online quiz</h2>
            <h4 style="font-size:24px; font-weight: bold;">Features:</h4>
            <ul style="font-size:24px;">
               <li>5 Question (20 sec each)</li>
               <li>100 seconds time</li>
               <li>Random Question</li>
               <li>Get Result Any Time</li>
               <li><span  style="color:red ;">Dear student, please be careful when choosing your answers because they cannot be changed</span></li>
            </ul>
            <a href="<?php echo URL; ?> startExam/start">Let's Start Quiz</a>
         </div>
      </div>
   </body>

   </html>
<?php } else {
   $error_msg = "You do not have sufficient permissions to login !!";
   require 'application/views/_templates/header.php';
   require 'application/views/login/index.php';
   require 'application/views/error/index.php';
   require 'application/views/_templates/footer.php';
} ?>