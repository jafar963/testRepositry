<?php


class questionModel
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
    function showExams()
    {
        $sql = "SELECT test.id as id , test.examDuration as examDuration ,subject.name as subjectName from test JOIN subject
    on(test.subject_id = subject.id )";
        $query = $this->db->prepare($sql);
        $query->execute(array());
        return  $query->fetchAll();
    }
    public function getNumberTest()
    {
        $sql = "SELECT COUNT(*) FROM test";
        $query = $this->db->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        return $count;
    }
    function addQuestion($id, $Option1, $Option2, $Option3, $Option4, $answer, $questionText, $topic_name)
    {
        $topic = "SELECT id from topics WHERE name='$topic_name'";
        $query = $this->db->prepare($topic);
        $query->execute();
        $res_topic_id = $query->fetchAll();
        $topics_id = $res_topic_id[0]->id;
        $topics_id = strip_tags($topics_id);
        $sql = "INSERT INTO question(id,Option1,Option2,Option3,Option4,answer,questionText,topics_id) VALUES (NULL,:Option1,:Option2,:Option3,:Option4,:answer,:questionText,:topics_id)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':Option1' => $Option1, ':Option2' => $Option2, ':Option3' => $Option3, ':Option4' => $Option4, ':answer' => $answer, ':questionText' => $questionText, ':topics_id' => $topics_id));
    }
    function showQuestions()
    {
        $sql = "SELECT topics.id as topics_id, topics.name as topics_name ,question.id,subject.name as subject_name ,question.Option1,question.Option2 ,question.Option3,question.Option4,question.questionText ,question.answer
    FROM topics JOIN question on (topics.id= question.topics_id )
    JOIN subject on(topics.subject_id = subject.id)";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    public function deleteQuestion($question_id)
    {
        $sql = "DELETE FROM question WHERE id = :question_id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':question_id' => $question_id));
    }
    public function editQuestion($id, $Option1, $Option2, $Option3, $Option4, $answer, $questionText, $topic_name)
    {
        $id = strip_tags($id);
        $Option1 = strip_tags($Option1);
        $Option2 = strip_tags($Option2);
        $Option3 = strip_tags($Option3);
        $Option4 = strip_tags($Option4);
        $answer = strip_tags($answer);
        $questionText = strip_tags($questionText);
        $topic_name = strip_tags($topic_name);
        $topic = "SELECT id from topics WHERE name='$topic_name'";
        $query = $this->db->prepare($topic);
        $query->execute();
        $res_topic_id = $query->fetchAll();
        $topics_id = $res_topic_id[0]->id;
        $topics_id = strip_tags($topics_id);
        $sql = "UPDATE question
    SET Option1 = :Option1,
    Option1 = :Option1,
    Option2 = :Option2,
    Option3 = :Option3,
    Option4 = :Option4,
    answer = :answer,
    questionText = :questionText,
    topics_id = :topics_id
    WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(
                array(
                    ':id' => $id,
                    ':Option1' => $Option1,
                    ':Option2' => $Option2,
                    ':Option3' => $Option3,
                    ':Option4' => $Option4,
                    ':answer' => $answer,
                    ':questionText' => $questionText,
                    ':topics_id' => $topics_id
                )
            );
    }
    //number
    public function getNumberQuestion()
    {
        $sql = "SELECT COUNT(*) FROM question";
        $query = $this->db->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        return $count;
    }
}
