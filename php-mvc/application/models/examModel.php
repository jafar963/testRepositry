<?php
if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();
class examModel
{
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    //add
    function addexam($id, $examDuration, $subject_name)
    {

        $id = strip_tags($id);
        $subject_name = strip_tags($subject_name);
        $examDuration = strip_tags($examDuration);
        $arr_time = explode("minutes", $examDuration);
        $subject = "SELECT id from subject WHERE name='$subject_name'";
        $query1 = $this->db->prepare($subject);
        $query1->execute();
        $res_subject_id = $query1->fetchAll();
        $subject_id = $res_subject_id[0]->id;
        $subject_id = strip_tags($subject_id);
        $sql = "SELECT distinct topics.id FROM subject  join topics  on (subject.id=topics.subject_id)  where topics.subject_id=$subject_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        $count = 0;
        $arr_topics_id = array();
        $topics_arr = $query->fetchAll();
        foreach ($topics_arr as $topic) {
            $arr_topics_id[$count] = $topic->id;
            $count++;
        }
        $sql = "INSERT  INTO test (id,examDuration,subject_id) VALUES (NULL,$arr_time[0],$subject_id)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':examDuration' => $examDuration, ':subject_id' => $subject_id));
        $last_id = $this->db->lastInsertId();
        $sql = 'SELECT id FROM question WHERE topics_id IN ( ' . implode(',', $arr_topics_id) . ' );';
        $query2 = $this->db->prepare($sql);
        $query2->execute();
        $question = $query2->fetchAll();
        $counter = 0;
        $questions_id = array();
        foreach ($question as $question) {
            $questions_id[$counter] = $question->id;
            $counter++;
        }
        $keys = array_rand($questions_id, 5);
        for ($i = 0; $i < 5; $i++) {
            $x = $keys[$i];
            $sql = "INSERT  INTO test_has_question (id,Test_id,Question_id) VALUES (NULL,$last_id, $questions_id[$x])";
            $query = $this->db->prepare($sql);
            $query->execute(array(':Test_id' => $last_id, ':Question_id' => $questions_id[$x]));
        }
    }

    // check question 

function checkQuestion( $subject_name){
    $subject = "SELECT id from subject WHERE name='$subject_name'";
    $query1 = $this->db->prepare($subject);
    $query1->execute();
    $res_subject_id = $query1->fetchAll();
    $subject_id = $res_subject_id[0]->id;
    $subject_id = strip_tags($subject_id);

    $sql = "SELECT COUNT(question.id )FROM subject  join topics  on (subject.id=topics.subject_id) join question on (question.topics_id=topics.id) where subject.id=$subject_id";
    $query = $this->db->prepare($sql);
    $query->execute();
    $count = $query->fetchColumn();
     
    if($count>=5){
        return true;
    }
    else{
        return false;
    }
}





    
    //show
   
    //delete
    function deleteexam($id)
    {
        $sql = "DELETE FROM test_has_question WHERE test_id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
        $sql = "DELETE FROM test WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));
    }
   
    public function chooseExam($name)
    {
        $subject_name = strip_tags($name);
        $subject = "SELECT id from subject WHERE name='$subject_name'";
        $query1 = $this->db->prepare($subject);
        $query1->execute();
        $res_subject_id = $query1->fetchAll();
        $subject_id = $res_subject_id[0]->id;
        $subject_id = strip_tags($subject_id);
        $sql = "SELECT id FROM test where subject_id=$subject_id ORDER BY RAND() LIMIT 1;";
        $query = $this->db->prepare($sql);
        $query->execute();
        $one_test_random = $query->fetchAll();
        $test_id_random = $one_test_random[0]->id;
        $sql = "SELECT Question_id FROM test_has_question where test_id=$test_id_random ORDER BY RAND() LIMIT 5;";
        $query = $this->db->prepare($sql);
        $query->execute();
        $questions = $query->fetchAll();
        $questions_id = array();
        $counter = 0;
        foreach ($questions as $question) {
            $questions_id[$counter] = $question->Question_id;
            $counter++;
        }
        $_SESSION['test_id'] = $test_id_random;
        return  $questions_id;
    }
    public function getfiveQuestion($id_arr)
    {
        $sql = 'SELECT * FROM question where id IN ( ' . implode(',', $id_arr) . ' );';
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }


    public function requestexam($id, $subject_name)
    {

        $subject = "SELECT id from subject WHERE name='$subject_name'";
        $query1 = $this->db->prepare($subject);
        $query1->execute();
        $res_subject_id = $query1->fetchAll();
        $subject_id = $res_subject_id[0]->id;
        $subject_id = strip_tags($subject_id);
        $sql = "SELECT id from test WHERE subject_id='$subject_id'";
        $query = $this->db->prepare($sql);
        $query->execute();
        $test_id = $query->fetchAll();
        $tests_id = array();
        $c = 0;
        foreach ($test_id as $test) {
            $tests_id[$c] = $test->id;
            $c++;
        }
        $sql = "SELECT test_id from test_center_has_test";
        $query = $this->db->prepare($sql);
        $query->execute();
        $find_test = $query->fetchAll();
        $find_tests = array();
        $d = 0;
        foreach ($find_test as $find) {
            $find_tests[$d] = $find->test_id;
            $d++;
        }
        for ($i = 0; $i < count($tests_id); $i++) {
            if (!in_array($tests_id[$i], $find_tests)) {
                $sql = "INSERT  INTO test_center_has_test (test_center_id,test_id,id) VALUES ( $id,$tests_id[$i],NULL)";
                $query = $this->db->prepare($sql);
                $query->execute(array(':test_center_id' => $id, ':test_id' => $tests_id[$i]));
                break;
            }
        }

    }
 
}
