function isEmptySignUp(smalls, email, first_name,last_name, password, confirm_password, phone)
{
    var flag = false;
    if(email == "")
    {
        smalls[0].innerHTML="This field is required.";
        flag = true;
    }
	else
	{
		smalls[0].innerHTML="";
	}
    if(first_name == "")
    {
        smalls[1].innerHTML="This field is required.";
        flag = true;
    }
	else
	{
		smalls[1].innerHTML="";
	}
    if(last_name == "")
    {
        smalls[2].innerHTML="This field is required.";
        flag = true;
    }
	else
	{
		smalls[2].innerHTML="";
	}
    
    if(password == "")
    {
        smalls[3].innerHTML="This field is required.";
        flag = true;
    }
	else
	{
		smalls[3].innerHTML="";
	}
    if(confirm_password == "")
    {
        smalls[4].innerHTML="This field is required.";
        flag = true;
    }
	else
	{
		smalls[4].innerHTML="";
	}
    return flag;
}

function validateSignUp()
{

    var flag = true;
    var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
    var smalls = document.getElementsByClassName("err"); // n = 6
    var email = document.getElementById('email').value;
    var firstname = document.getElementById("firstName").value;
    var lastname = document.getElementById("lastName").value;
    var password = document.getElementById('password').value;
    var confirm_password = document.getElementById('confirm').value;
    var phone = document.getElementById("phone");

    if(isEmptySignUp(smalls, email, firstname,lastname, password, confirm_password ,phone))
    {
        flag = false;
    }
    smalls[5].innerHTML ="";
    if(!(/(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email)))
    {
        smalls[0].innerHTML="Invalid email address.";
        flag = false;
    }
    if(/[0-9]+/g.test(firstname))
    {
        smalls[1].innerHTML="Invalid name given.";
        flag = false;
    }
    if(/[0-9]+/g.test(lastname))
    {
        smalls[2].innerHTML="Invalid name given.";
        flag = false;
    }

    if((password.length < 8) && password!="")
    {
        smalls[3].innerHTML="Password can't be less than 8 characters.";
        flag = false;
    }
    if(password != confirm_password)
    {
        smalls[4].innerHTML="Password do not match.";
        flag = false;
    }
  if(!(phone.value.match(phoneno)))
        {
      smalls[5].innerHTML="Not a valid Phone Number.";
      flag = false;

}
    return flag;
}