<?php
class student_has_exam_Model
{
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
    function addmark($id, $test_id, $user_id, $total_mark_obtain, $date_exam)
    {
        $id = strip_tags($id);
        $test_id = strip_tags($test_id);
        $user_id = strip_tags($user_id);
        $total_mark_obtain = strip_tags($total_mark_obtain);
        $sql = " INSERT INTO test_details (id,test_id,user_id,total_mark_obtain,date_exam) VALUES (NULL,:test_id,:user_id,:total_mark_obtain,:date_exam)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':test_id' => $test_id, ':user_id' => $user_id, ':total_mark_obtain' => $total_mark_obtain, ':date_exam' => $date_exam));
    }
    function showExams($id)
    {
        $sql = "SELECT test.id as id ,subject.name as subjectName,total_mark_obtain as mark, date_exam as date from test_details JOIN user on (user.id=test_details.user_id)  join  test on (test_details.test_id= test.id) join subject on (test.subject_id=subject.id) where user.id=$id";
        $query = $this->db->prepare($sql);
        $query->execute(array());
        return  $query->fetchAll();
    }
}
