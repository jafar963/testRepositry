function validateSignIn()
{
    var flag = true;
    var smalls = document.getElementsByClassName('error'); // n = 2
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if(email == "")
    {
      smalls[0].innerHTML="This field is required";
        flag = false;
    }
    else
    {
      smalls[0].innerHTML="";

    }
    if(password == "")
    {
      smalls[1].innerHTML="This field is required";
        flag = false;
    }
    else
    {
      smalls[1].innerHTML="";
    }
    return flag;

}

