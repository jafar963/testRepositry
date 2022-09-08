<body class="body-register">
    <header>
        <!--NAVIGATION-->
        <nav>
            <div id="logo"><span class="logo">Q</span>uiz Maker</div>
            <div class="links-header">
                <ul>
                    <li> <a href="<?php echo URL; ?>home/home-page.php"> HOME</a></li>
                    <li> <a href="<?php echo URL; ?>about/index.php"> ABOUT</a></li>
                    <li> <a href="<?php echo URL; ?>contact/index.php"> CONTACT US</a></li>
                    <li> <a href="<?php echo URL; ?>login/index.php"> LOGIN</a></li>
                    <li> <a href="<?php echo URL; ?>register/index.php"> SIGN UP</a></li>
                </ul>
            </div>
        </nav>
        <!-- END OF NAVIGATION-->
        <div class="parent">
            <div id="left-section">
                <h1> Get started with our online quiz maker Rapid Refresh </h1>
                <h4> Reinforce learning and check your team’s understanding from meetings, onboarding, training, and more.</h4>
                <img src="<?php echo URL; ?>public/images/quiz.jpeg" id="quiz-register" />
                <img src="<?php echo URL; ?>public/images/3.jfif" id="more-about-us" />
                <div>“What I really like about this, is beyond just using it for our learners, it really helps our leadership team see if we are conveying the message that we want them to receive.”</div>
            </div>
            <div id="sign-up-form">
                <form id="signup" action="<?php echo URL; ?>register/checkRegister" method="POST" onsubmit="return validateSignUp();">
                    <span>
                        Have an account ?
                        <a href="<?php echo URL; ?>login/index.php"> Log in</a>
                    </span>
                    <h2>Create your free account today!</h2>
                    <br>
                    <h3>Work email&nbsp; <strong class="note">(Required)</strong></h3>
                    <input type="email" id="email" name="email" placeholder=" E.g. David.Beckham@gmail.com " />
                    <br>
                    <small class="err"></small>
                    <div class="word-display">
                        <h3 id="first_name "> First name &nbsp; <strong class="note">(Required)</strong></h3>
                        <h3 id="last_name "> Last name &nbsp; <strong class="note">(Required)</strong></h3>
                    </div>
                    <div class="block-display">
                        <input type="text " id="firstName" name="firstName" class="firstName" placeholder="E.g David " />
                        <input type="text " id="lastName" name="lastName" class="lastName" placeholder="E.g Beckham " />
                    </div>
                    <div class="word-display">
                        <small class="err"></small>
                        <small class="err"></small>
                    </div>
                    <div class="word-display">
                        <h3 id="password "> Password &nbsp; <strong class="note">(Required)</strong></h3>
                        <h3 id="confirm-password "> Confirm &nbsp; <strong class="note">(Required)</strong></h3>
                    </div>
                    <div class="block-display">
                        <input type="password" name="password" id="password" placeholder="password " />
                        <input type="password" id="confirm" name="confirm" placeholder="******** " />
                    </div>
                    <div class="word-display">
                        <small class="err"></small>
                        <small class="err"></small>
                    </div>
                    <br>
                    <h3> Phone &nbsp; <strong class="note">(Required)</strong></h3>
                    <input type="text" id="phone" name="phone" placeholder="E.g. xxx-xxx-xxxx" />
                    <br>
                    <small class="err"></small>
                    <br>
                    <br>
                    <h3> choose your image</h3>
                    <input type="file" name="image" id="image" accept="image/png, image/gif, image/jpeg " />
                    <button type="submit" name="submit-register">Get started for FREE </button>
                </form>
            </div>