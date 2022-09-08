
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
class topics_managment extends Controller
{
    public function index()
    {
        require_once 'application/views/_templates/header-admin.php';
        require_once 'application/views/topics_managment/index.php';
    }
    public function addtopic()
    {
        if (isset($_POST["add-topic"])) {
            $name_topic=validate($_POST['name-of-topics']);
            if ($name_topic != "") {
                $topicModel = $this->loadModel('topicModel');
                $topicModel->addtopic(NULL, $_POST['selected-material'], $name_topic);
                header("location: " . URL . "topics_managment/index.php/");

            }
            else{
                $error_msg = "Incorrect entry information !!";
                require_once 'application/views/_templates/header-admin.php';
                require_once 'application/views/topics_managment/index.php'; 
                require_once 'application/views/error/index.php'; 

            }
        }
    }
    public function deletetopic($id)
    {
        if (isset($id)) {
            $topicModel = $this->loadModel('topicModel');
            $topicModel->deletetopic($id);
        }
        header("location: " . URL . "topics_managment/index.php/");
    }
    public function edittopic()
    {
        if(isset($_POST['edit-topic'])){
        $edittopic = validate($_POST['edittopic']);
        $id = validate($_POST['id']);
        if ($edittopic != "") {
            $topicModel = $this->loadModel('topicModel');
            $topicModel->edittopic($id, $edittopic);
            header("location: " . URL . "topics_managment/index.php/");
        } else {
            $error_msg = "Incorrect entry information !!";
            require_once 'application/views/_templates/header-admin.php';
            require_once 'application/views/topics_managment/index.php'; 
            require_once 'application/views/error/index.php';         }
    }
}
}