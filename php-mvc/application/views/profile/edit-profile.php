<br><br><br><br><br><br>
<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
if (isset($_SESSION['user'])) {
?>
    <div class="real-body" style="color:black; font-style:italic; position:absolute ;  left:20%;top:80%; z-index: 1000;">
        <div class="edit-profile-container">
            <div class="profile-container">
            <?php if ($_SESSION['user']->image != null) { ?>
                <img src="<?php echo URL; ?>public/images/profile/<?php echo $_SESSION['user']->image; ?>" id="profile-pic">
                <?php } else { ?>
                    <img class="admin-logo" src="<?php echo URL; ?>public/images/user.jpg "  id="profile-pic"/>
                <?php } ?>
                <form method="POST" action="<?php echo URL; ?>profile/updateProfile">
                    <div class="profile-chooser">
                        <input type="file" id="file-reader" value="<?php echo $_SESSION['user']->image; ?>" name="img_url">
                        <i class=" fa fa-camera" style="padding-left:1px;"></i>
                    </div>
                    <div class="profile-data">
                        <label for="">Fisrt Name</label>
                        <input type="text" name="first_name" value="<?php echo $_SESSION['user']->firstName; ?>" id="firstName">
                        <small class="error" style="color:red ; font-weight:bold ;"></small>
                        <br><br>
                        <label for="">Last Name</label>
                        <input type="text" name="last_name" value="<?php echo $_SESSION['user']->lastName; ?>" id="lastName">
                        <small class="error" style="color:red ; font-weight:bold ;"></small>
                        <br><br>
                        <label for="">Mobile Number</label>
                        <input type="text" name="mobile_number" value="<?php echo $_SESSION['user']->Mobile; ?>" id="phone">
                        <small class="error" style="color:red ; font-weight:bold ;"></small>
                        <br><br>
                        <input herf="" type="submit" name="submit-edit" value="Save Changes" onclick ="return validate();">
                    </div>
                </form>
            </div>
        </div>
        <script>

    function isEmptySignUp(smalls, first_name,last_name, phone)
{
    var flag = false;
    
    if(first_name == "")
    {
        smalls[0].innerHTML="This field is required.";
        flag = true;
    }
	else
	{
		smalls[0].innerHTML="";
	}
    if(last_name == "")
    {
        smalls[1].innerHTML="This field is required.";
        flag = true;
    }
	else
	{
		smalls[1].innerHTML="";
	}
    return flag;
}

        
function validate()
{

    var flag = true;
    var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    var smalls = document.getElementsByClassName("error"); // n = 3
    var firstname = document.getElementById("firstName").value;
    var lastname = document.getElementById("lastName").value;
    var phone = document.getElementById("phone");

    if(isEmptySignUp(smalls,firstname,lastname,phone))
    {
        flag = false;
    }
    smalls[2].innerHTML ="";
    
    if(/[0-9]+/g.test(firstname))
    {
        smalls[0].innerHTML="Invalid name given.";
        flag = false;
    }
    if(/[0-9]+/g.test(lastname))
    {
        smalls[1].innerHTML="Invalid name given.";
        flag = false;
    }
  if(!(phone.value.match(phoneno)))
        {
      smalls[2].innerHTML="Not a valid Phone Number.";
      flag = false;

}
    return flag;
}
        </script>
    </div>
<?php } ?>
  