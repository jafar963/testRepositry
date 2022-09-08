<?php
if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();
class profile extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user'])) {

            if ($_SESSION['user']->role_id == 1) {
                require_once 'application/views/_templates/header-admin.php';

                require_once 'application/views/profile/index.php';
            } else if ($_SESSION['user']->role_id == 2) {
                require_once 'application/views/_templates/admin_test_center_header.php';

                require_once 'application/views/profile/index.php';
            } else {
                require_once 'application/views/_templates/header-student.php';

                require_once 'application/views/profile/index.php';
            }
        } else {
            $error_msg = "You do not have sufficient permissions to login !!";
            require_once 'application/views/_templates/header.php';
            require_once 'application/views/login/index.php';
            require_once 'application/views/error/index.php';

            require_once 'application/views/_templates/footer.php';
        }
    }
    public function editProfile()
    {
        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']->role_id == 1) {
                require_once 'application/views/_templates/header-admin.php';

                require_once 'application/views/profile/edit-profile.php';
            } else if ($_SESSION['user']->role_id == 3) {
                require_once 'application/views/_templates/header-student.php';

                require_once 'application/views/profile/edit-profile.php';
            } else {
                require_once 'application/views/_templates/admin_test_center_header.php';
                require_once 'application/views/profile/edit-profile.php';
            }
        } else {
            $error_msg = "You do not have sufficient permissions to login !!";
            require_once 'application/views/_templates/header.php';
            require_once 'application/views/login/index.php';
            require_once 'application/views/error/index.php';
            require_once 'application/views/_templates/footer.php';
        }
    }
    public function updateProfile()
    {
        if (isset($_POST['submit-edit'])) {
            $user_first_name = "";
            $user_first_name = $_POST['first_name'];
            $user_last_name = "";
            $user_last_name = $_POST['last_name'];
            $user_email = "";
            $user_email = $_POST['email'];
            $user_img_url = "";
            $user_img_url = $_POST['img_url'];
            if ($user_img_url == "")
                $user_img_url = $_SESSION['user']->image;
            $user_mobile_number = "";
            $user_mobile_number = $_POST['mobile_number'];
            if (strlen($user_first_name) >= 3 && preg_match("/[A-Za-z]+/", $_POST['first_name'])) {
                $userModel = $this->loadModel('userModel');
                $user = $userModel->findUserById($_SESSION['user']->id);
                foreach ($user as $tmp) {
                    $_SESSION['user']->firstName =  $tmp->firstName = $_POST['first_name'];
                    $_SESSION['user']->lastName = $tmp->lastName = $_POST['last_name'];
                    $_SESSION['user']->image = $tmp->image = ($_POST['img_url'] == "" ? $_SESSION['user']->image : $_POST['img_url']);
                    $_SESSION['user']->Mobile = $tmp->Mobile = $_POST['mobile_number'];
                    $userModel->editProfile($_SESSION['user']->id, $tmp->firstName,$tmp->lastName,$tmp->image, $tmp->Mobile);
                }
                header('location: ' . URL . 'profile/index/');
            } else {
                $error_msg = "invalid data !!, first name must be longer than 3 characters and contains letters only";
                if ($_SESSION['user']->role_id == 1) {
                    require_once 'application/views/_templates/header-admin.php';
                    require_once "application/views/profile/edit-profile.php";
                    require_once "application/views/error/index.php";
                }
                if ($_SESSION['user']->role_id == 2) {
                    require_once 'application/views/_templates/admin_test_center_header.php';
                    require_once "application/views/profile/edit-profile.php";
                    require_once "application/views/error/index.php";
                } else {
                    require_once 'application/views/_templates/header-student.php';
                    require_once "application/views/profile/edit-profile.php";
                    require_once "application/views/error/index.php";
                }
            }
        }
    }
}
