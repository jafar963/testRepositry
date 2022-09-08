<?php
if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
class Login extends Controller
{
    public function index()
    {
        require_once 'application/views/_templates/header.php';
        require_once 'application/views/login/index.php';
        require_once 'application/views/_templates/footer.php';
    }
    public function checkLogin()
    {
        if (isset($_POST['submit_login'])) {
            $user_model = $this->loadModel('userModel');
            $res = $user_model->findUserByEmail($_POST['email']);
            $test_center=$user_model-> getUserTestCenter();
          
            $flag = false;
            $error_msg = "No such email, please try again !!";
            foreach ($res as $tmp) {
                if (md5($_POST['password']) == $tmp->Password) {
                    $flag = true;
                    $_SESSION['user'] = $tmp;
                } else {
                    $error_msg = "Wrong password, please try again !!";
                }
            }
            if ($flag) {
                foreach ($res as $tmp) {
                   
                    if ($_SESSION['user']->role_id == 1) {
                        header("location: " . URL . "admin/index.php/");
                    } 
                     else if ($_SESSION['user']->role_id == 3) {
                        header("location: " . URL . "student/index.php/");
                    }
                    else if ($_SESSION['user']->role_id == 2 &&  in_array($_SESSION['user']->id, $test_center)) {
                        header("location: " . URL . "admin_test_center/index.php/");
                    }
                    else{
                        $error_msg = "You don't have an exam center yet!!";
                        require_once 'application/views/_templates/header.php';
                        require_once 'application/views/login/index.php';
                        require_once 'application/views/error/index.php';
                        require_once 'application/views/_templates/footer.php';
                    }
                }
            } else {
                require_once 'application/views/_templates/header.php';
                require_once 'application/views/login/index.php';
                require_once 'application/views/error/index.php';
                require_once 'application/views/_templates/footer.php';
            }
        }
    }
}
