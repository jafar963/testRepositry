<br><br><br><br><br><br>
<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
if (isset($_SESSION['user'])) {
?>
  <div class="real-body" style="color:black; font-style:italic; position:absolute ; left:20%;top:80%; z-index: 1000;">
    <div class="profile-container">
    <?php if ($_SESSION['user']->image != null) { ?>
                <img src="<?php echo URL; ?>public/images/profile/<?php echo $_SESSION['user']->image; ?>" id="profile-pic">
                <?php } else { ?>
                    <img class="admin-logo" src="<?php echo URL; ?>public/images/user.jpg "  id="profile-pic"/>
                <?php } ?>
      <div class="name-profile">
        <span class="username">
          <?php
          echo $_SESSION['user']->firstName . " " . $_SESSION['user']->lastName;
          ?>
        </span> <br>
      </div>
      <div class="content">
        <a href="<?php echo URL; ?>profile/editProfile">
          <button class="edit" type="button">
            <i class="fa fa-edit"></i>
            Edit Profile</button>
        </a>
        <h3 style="margin-bottom:10px; margin-top:10px;  color:brown">phone:</h3>
        <i class="fa fa-phone" aria-hidden="true" style=" font-size:24px; margin-right: 10px; color:brown;"></i>
        <span style="font-size:20px; font-weight: bold;">+
          <?php
          echo $_SESSION['user']->Mobile;
          ?>
        </span>
        <br><br><br>
        <h3 style="margin-bottom:10px; margin-top:10px;  color:brown">Email:</h3>
        <i class="fa fa-envelope" aria-hidden="true" style=" font-size:24px; margin-right: 10px; color:brown;"></i>
        <span style="font-size:20px; font-weight: bold;">
          <?php
          echo $_SESSION['user']->email;
          ?>
        </span>
        <br><br><br>
        <h3 style="margin-bottom:10px; margin-top:10px; color:brown">Date created:</h3>
        <i class="fa fa-history" aria-hidden="true" style=" font-size:24px; margin-right: 10px; color:brown;"></i>
        <span style="font-size:20px; font-weight: bold;">
          <?php
          echo $_SESSION['user']->time_created;
          ?>
        </span>
        <h3 style="margin-bottom:10px; margin-top:10px; color:brown">Role:</h3>
        <i class="fa fa-user " style=" font-size:24px; margin-right: 10px; color:brown;"></i>
        <span style="font-size:20px; font-weight: bold;">
          <?php
          if ($_SESSION['user']->role_id == 1) {
            echo "Admin";
          } else if ($_SESSION['user']->role_id == 2) {
            echo "Admin Test Center";
          } else {
            echo "Student";
          }
          ?>
        </span>
        <br>
        <br>
      </div>
    </div>
  </div>
<?php } ?>