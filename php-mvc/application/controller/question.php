<?php

if (session_status() != PHP_SESSION_ACTIVE)
    session_start();

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
class Question extends Controller
{
    public function index()
    {

        require_once 'application/views/_templates/header-admin.php';
        require_once 'application/views/all_questions/index.php';
    }
    public function addQuestion()
    {

        if (isset($_POST["submit-addquestion"])) {
        $option1 = validate($_POST['option1']);
        $option2 = validate($_POST['option2']);
        $option3 = validate($_POST['option3']);
        $option4 = validate($_POST['option4']);
        $answer = validate($_POST['answer']);
        $question_text = validate($_POST['questionText']);
        $topic_name = validate($_POST['topic_name']);

        if (

            $option1 != ''
            && $option2 != ''
            && $option3 != ''
            && $option4 != ''
            &&  $answer != ''
            && $question_text != ''
            && $topic_name != ''
        ) {
            $questions = $this->loadModel('questionModel');
            $questions->addQuestion(NULL, $option1, $option2, $option3, $option4, $answer, $question_text, $topic_name);
            header('location: ' . URL . 'question/index.php');

        }
         else {
            $error_msg = "All input fields must be filled out !!";

            require_once 'application/views/_templates/header-admin.php';
            require_once 'application/views/all_questions/index.php';
            require_once 'application/views/error/index.php';
        }
    }
    }

    public function deleteQuestion($question_id)
    {
        if (isset($question_id)) {
            $questionModel = $this->loadModel('questionModel');
            $questionModel->deleteQuestion($question_id);
        }
        header('location: ' . URL . 'question/index.php');
    }
    public function editQuestion()
    {

        if (isset($_POST["submit-editquestion"])) {

            $option1 = validate($_POST['option1-edit']);
            $option2 = validate($_POST['option2-edit']);
            $option3 = validate($_POST['option3-edit']);
            $option4 = validate($_POST['option4-edit']);
            $answer = validate($_POST['answer-edit']);
            $question_text = validate($_POST['questionText-edit']);
            $topic_name = validate($_POST['topic_name-edit']);
            $id = validate($_POST['id']);

            if (

                $option1 != ''
                && $option2 != ''
                && $option3 != ''
                && $option4 != ''
                &&  $answer != ''
                && $question_text != ''
                && $topic_name != ''
            ) {
                $questions = $this->loadModel('questionModel');

                $questions->editQuestion($id, $option1, $option2, $option3, $option4, $answer, $question_text, $topic_name);
                header('location: ' . URL . 'question/index.php');

            } else {
                $error_msg = "All input fields must be filled out !!";

                require_once 'application/views/_templates/header-admin.php';
                require_once 'application/views/all_questions/index.php';
                require_once 'application/views/error/index.php';
            }
        }
    }
}
