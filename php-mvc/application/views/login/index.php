
<body class="body-login">
<!--NAVIGATION-->
<nav>
   <div id="logo"><span class="logo">Q</span>uiz Maker</div>
    <div class="links-header">
    <ul>
        <li> <a href ="<?php echo URL ;?>home/home-page.php"> HOME</a></li>
        <li> <a href ="<?php echo URL ;?>about/index.php"> ABOUT</a></li>
        <li> <a href ="<?php echo URL ;?>contact/index.php"> CONTACT US</a></li>
        <li> <a href ="<?php echo URL ;?>login/index.php" > LOGIN</a></li>
        <li> <a href ="<?php echo URL ;?>register/index.php"> SIGN UP</a></li>
    </ul>
    </div>
</nav>
<!-- END OF NAVIGATION-->
<div class="container">
<div id="login-form">
<img  id ="user_img"src="<?php echo URL ;?>/public/images/user.jpg">
<h1> Login Now </h1>
<form method="POST" action="<?php echo URL; ?>login/checkLogin" onsubmit="return validateSignIn();">
    <div class="info-form">
<input type="email" placeholder="Email" id="email" name="email" />
<small class="error"></small>
</div>
<div class="info-form">
<input type="password" placeholder="Password" name="password" id="password"/>
<small class="error"></small>
</div>
<!-- <h4 id="forget">Forget Password? <a href="#"> Click here </a></h4> -->
<h4 id="register">New User?<a href="<?php echo URL ;?>register/index.php"> Register here</a></h4>    
<button type="submit" name="submit_login">LOGIN</button>
</form>
</div>
</div>
