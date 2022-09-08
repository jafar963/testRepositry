<?php

class Test_center_admin_managmentModel
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
  function addcenter($id, $name, $address, $mobile, $user_name)
  {
    $user_name = strip_tags($user_name);
    $Full_Name = explode(" ", $user_name);
    $f = $Full_Name[0];
    $l = $Full_Name[1];
    $user = "SELECT * from user WHERE firstName=\"$f\" AND lastName=\"$l\"";
    $query = $this->db->prepare($user);
    $query->execute();
    $res_id = $query->fetchAll();
    $user_id = $res_id[0]->id;
    $id = strip_tags($id);
    $name = strip_tags($name);
    $address = strip_tags($address);
    $mobile = strip_tags($mobile);
    $user_id = strip_tags($user_id);
    $sql = "INSERT  INTO test_center (id,name,address,mobile,user_id) VALUES (NULL,:name,:address,:mobile,:user_id)";
    $query = $this->db->prepare($sql);
    $query->execute(array(':name' => $name, ':address' => $address, ':mobile' => $mobile, ':user_id' => $user_id));
  }
  //show
  function showcenters()
  {
    $sql = "SELECT test_center.id, test_center.name ,test_center.address , test_center.mobile , concat(user.firstName,' ',user.lastName) as FullName
      FROM user  join test_center on (user.id= test_center.user_id )";
    $query = $this->db->prepare($sql);
    $query->execute();
    return  $query->fetchAll();
  }
  //delete
  function deletecenter($id)
  {
    $sql = "DELETE FROM test_center WHERE id = :id";
    $query = $this->db->prepare($sql);
    $query->execute(array(':id' => $id));
  }
  //edit 
  function editcenter($id, $newAdmin, $name)
  {
    $id = strip_tags($id);
    $user_name = strip_tags($newAdmin);
    $Full_Name = explode(" ", $user_name);
    $f = $Full_Name[0];
    $l = $Full_Name[1];
    $user = "SELECT id from user WHERE firstName=\"$f\" AND lastName=\"$l\"";
    $query = $this->db->prepare($user);
    $query->execute();
    $res_user_id = $query->fetchAll();
    $user_id = $res_user_id[0]->id;
    $user_id = strip_tags($user_id);
    $sql = "UPDATE test_center SET name = :name , user_id =:user_id
    WHERE id = :id";
    $query = $this->db->prepare($sql);
    $query->execute(array(':id' => $id, ':name' => $name, ':user_id' => $user_id));
  }
  public function showSubjects($id)
  {
    $sql = "SELECT  test_id from test_center_has_test where test_center_id=$id";
    $query = $this->db->prepare($sql);
    $query->execute();
    $tests_id = $query->fetchAll();
    $test_id_arr = array();
    $count = 0;
    foreach ($tests_id as $test) {
      $test_id_arr[$count] = $test->test_id;
      $count++;
    }
    $sql = 'SELECT  distinct subject_id FROM test WHERE id IN ("' . implode('","', $test_id_arr) . '")';
    $query = $this->db->prepare($sql);
    $query->execute();
    $subject_id = $query->fetchAll();
    $subject_id_arr = array();
    $counter = 0;
    foreach ($subject_id as $subject) {
      $subject_id_arr[$counter] = $subject->subject_id;
      $counter++;
    }
    $sql = 'SELECT  distinct name FROM subject WHERE id IN ("' . implode('","', $subject_id_arr) . '")';
    $query = $this->db->prepare($sql);
    $query->execute();
    $subject_name = $query->fetchAll();
    $subject_name_arr = array();
    $counter1 = 0;
    foreach ($subject_name as $subject) {
      $subject_name_arr[$counter1] = $subject->name;
      $counter1++;
    }
    return $subject_name_arr;
  }
  function showExams($id)
  {
    $sql = "SELECT distinct  id
  FROM test_center where user_id=$id";
    $query = $this->db->prepare($sql);
    $query->execute();
    $center_id = $query->fetchAll();
    $center_idd = $center_id[0]->id;
    $sql = "SELECT test_center_has_test.id as center_id,test_center_has_test.test_id as test_id , test.examDuration as examDuration ,subject.name as subjectName
    FROM test_center_has_test join test on (test_center_has_test.test_id=test.id) join subject on(test.subject_id = subject.id) where test_center_has_test.test_center_id= $center_idd";
    $query = $this->db->prepare($sql);
    $query->execute(array());
    return $query->fetchAll();
  }
  function showMarksStudentINCenter($id)
  {
    $sql = "SELECT distinct  id
  FROM test_center where user_id=$id";
    $query = $this->db->prepare($sql);
    $query->execute();
    $center_id = $query->fetchAll();
    $center_idd = $center_id[0]->id;
    $sql = "SELECT test.id as id ,subject.name as subjectName,test_details.total_mark_obtain as mark,concat(user.firstName,' ',user.LastName) as name , test_details.date_exam as date from test_details JOIN user on (user.id=test_details.user_id)  join  test on (test_details.test_id= test.id) join subject on (test.subject_id=subject.id)  join test_center_has_test on(test_center_has_test.test_id=test_details.test_id)where test_center_has_test.test_center_id=$center_idd";
    $query = $this->db->prepare($sql);
    $query->execute(array());
    return  $query->fetchAll();
  }
  function getAllTestCenter()
  {
    $sql = "SELECT * 
    FROM test_center";
    $query = $this->db->prepare($sql);
    $query->execute();
    return $query->fetchAll();
  }
  function deleteexam($id)
  {
    $sql = "DELETE FROM test_center_has_test WHERE test_id = :id";
    $query = $this->db->prepare($sql);
    $query->execute(array(':id' => $id));
  }

  function getAllExams($id)
  {
    $sql = "SELECT *
    FROM test_center where user_id=$id";
    $query = $this->db->prepare($sql);
    $query->execute();
    $center_id = $query->fetchAll();
    $sql = "SELECT * 
    FROM test_center_has_test";
    $query = $this->db->prepare($sql);
    $query->execute();
  }
  function getNumberStudent($id){
    $sql = "SELECT distinct  id
    FROM test_center where user_id=$id";
    $query = $this->db->prepare($sql);
    $query->execute();
    $center_id = $query->fetchAll();
    $center_idd = $center_id[0]->id;
    $sql = "SELECT distinct COUNT(*) from test_details JOIN user on (user.id=test_details.user_id)  join  test on (test_details.test_id= test.id) join subject on (test.subject_id=subject.id)  join test_center_has_test on(test_center_has_test.test_id=test_details.test_id)where test_center_has_test.test_center_id=$center_idd";
    $query = $this->db->prepare($sql);
    $query->execute();
    $count = $query->fetchColumn();
    return $count;

}
  function getNumberSubject($id) {
    $sql = "SELECT distinct  id
    FROM test_center where user_id=$id";
    $query = $this->db->prepare($sql);
    $query->execute();
    $center_id = $query->fetchAll();
    $center_idd = $center_id[0]->id;

    $sql = "SELECT distinct subject_id from test_center_has_test JOIN test on (test_center_has_test.test_id=test.id) where test_center_has_test.test_center_id=$center_idd";
    $query = $this->db->prepare($sql);
    $query->execute();
    $count = $query->fetchColumn();
    return $count;
  }
  function getNumberTest ($id) {
  $sql = "SELECT distinct  id
  FROM test_center where user_id=$id";
  $query = $this->db->prepare($sql);
  $query->execute();
  $center_id = $query->fetchAll();
  $center_idd = $center_id[0]->id;

  $sql = "SELECT COUNT(test_id) FROM test_center_has_test where test_center_has_test.test_center_id=$center_idd";
  $query = $this->db->prepare($sql);
  $query->execute();
  $count = $query->fetchColumn();
  return $count;
 }
 function getNumberQuestion($id) {
  $sql = "SELECT distinct  id
  FROM test_center where user_id=$id";
  $query = $this->db->prepare($sql);
  $query->execute();
  $center_id = $query->fetchAll();
  $center_idd = $center_id[0]->id;

  $sql = "SELECT distinct Question_id FROM test_center_has_test join test_has_question on (test_center_has_test.test_id = test_has_question.test_id) where test_center_has_test.test_center_id=$center_idd";
  $query = $this->db->prepare($sql);
  $query->execute();
  $questions=$query->fetchAll();
  return count($questions);
 }
 public function getAllSubjectAvailable(){

  $sql = "SELECT distinct subject.name from subject join  test on(test.subject_id=subject.id)";
  $query = $this->db->prepare($sql);
  $query->execute();
  return $query->fetchAll();
}
}
