
<?php
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
class All_users extends Controller
{
    public function index()
    {
        require_once 'application/views/_templates/header-admin.php';
        require_once 'application/views/all_users/index.php';
    }
    public function deleteUser($user_id)
    {
        if (isset($user_id)) {
            $users_model = $this->loadModel('userModel');
            $users_model->deleteUser($user_id);
        }
        header('location: ' . URL . 'all_users/index');
    }
    public function Active($user_id, $isactive)
    {
        if (isset($user_id)) {
            $users_model = $this->loadModel('userModel');
            $users_model->Active($user_id, $isactive);
            header('location: ' . URL . 'all_users/index');
        }
    }
    public function addUser()
    {
        $email = validate($_POST['email']);
        $password = validate($_POST['password']);
        $confirm = validate($_POST['confirm']);
        $firstname = validate($_POST['firstName']);
        $lastname = validate($_POST['lastName']);
        $phone = validate($_POST['phone']);
        if (isset($_POST["submit-adduser"])) {
            $userModel = $this->loadModel('userModel');
            $users =   $userModel->findUserByEmail($_POST['email']);
            $phonenumber = $userModel->findUserByPhone($_POST['phone']);
            $user = null;
            $flag = false;
            if (
                preg_match("/[A-Za-z]+/", $firstname)
                && strlen($firstname) >= 3
                && preg_match("/[A-Za-z]+/", $lastname)
                && strlen($lastname) >= 3
                && (strlen($password) > 8)
                && (strlen($phone) == 10)
                && preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)
            ) {
                $error_msg = "email already exists, try another!";
                foreach ($users as $tmp) {
                    $flag = true;
                    $users = $userModel->getAllUsers();
                    // require 'application/views/_templates/header-admin.php';
                    // require 'application/views/error/index.php';
                    // require 'application/views/all_users/index.php';
                }
                $error_msg = "mobile number already exists, try another!";
                foreach ($phonenumber as $tmp) {
                    $flag = true;
                    $users = $userModel->getAllUsers();
                    // require 'application/views/_templates/header-admin.php';
                    // require 'application/views/error/index.php';
                    // require 'application/views/all_users/index.php';
                }
                if ($flag === false) {
                    $date = date('Y-m-d');
                    if ($_POST['role'] == 'admin test center') {
                        $userModel->addUser(
                            NULL,
                            $firstname,
                            $lastname,
                            $email,
                            md5($password),
                            $phone,
                            $_POST['image'],
                            $date,
                            1,
                            2
                        );
                    } else if ($_POST['role'] == 'admin') {
                        $userModel->addUser(
                            NULL,
                            $_POST['firstName'],
                            $_POST['lastName'],
                            $_POST['email'],
                            md5($_POST['password']),
                            $_POST['phone'],
                            $_POST['image'],
                            $date,
                            1,
                            1
                        );
                    } else {
                        $userModel->addUser(
                            NULL,
                            $_POST['firstName'],
                            $_POST['lastName'],
                            $_POST['email'],
                            md5($_POST['password']),
                            $_POST['phone'],
                            $_POST['image'],
                            $date,
                            1,
                            3
                        );
                    }
                    $users =  $userModel->findUserByEmail($_POST["email"]);
                }
                header('location: ' . URL . 'all_users/index');
            } else {
                $users = $userModel->getAllUsers();
                $error_msg = "Please fill all the information properly !!!";
                // require 'application/views/_templates/header-admin.php';
                // require 'application/views/all_users/index.php';
                // require 'application/views/error/index.php';
            }
        }
    }
}
