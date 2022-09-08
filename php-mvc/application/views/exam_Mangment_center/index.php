<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
if (isset($_SESSION['user'])  && $_SESSION['user']->role_id == "2") {
  foreach ($centers as $tmp) {
    if ($tmp->user_id == $_SESSION['user']->id) {
      $testcenter_id = $tmp->id;
      $_SESSION['center_id'] = $testcenter_id;
    }
  }

 
?>


  <form id="managment" method="POST" action="<?php echo URL. 'admin_test_center/requireTest/'. $_SESSION['center_id']?>">
    <div class="block-of-exams" style="background: linear-gradient(to right, #f9cacb 20%, #faf8f8 80%, #faf9f9 9%);border-radius:20px;max-width:80% ;margin:auto;height:500px; ">
      <h3 style="margin-left:200px;margin-top:10px; color:black;">Select material : </h3>
      <select style="margin-left:200px; margin-top:2px; width:200px; height:40px;font-size:25px;border-radius: 10px;" id="selected-material" name="selected-material" class="selected-material">
        <?php
        foreach ($subject_exam_center_available as $tmp) {
        ?>
          <option> <?php echo $tmp->name; ?> </option>
        <?php  }
        ?>
      </select>
      <button id="add-exam" name="request-exam" class="request-exam" type="submit" style="margin:50px 10px 0px 1000px ;width:300px; 
     height:50px; font-size:30px; border-radius: 10px;"> Request Exam</button>
    </div>
    <?php
    $data = array();
    foreach ($examscenter as $row) {
      $data[] = array(
        "id" => $row->test_id,
        "subjectName" => $row->subjectName . " Exam",
        "examDuration" => $row->examDuration . " Minutes",
      );
    }
    ?>
  </form>
  <from id="info" method="POST">
    <div class="main-body" style="min-height: calc(100vh - 300px); color:black; max-width:80%; margin:auto;">
      <div class="real-body">
        <div class="exam-container">
          <table id="examtable" class="display">
            <thead>
              <tr style="background-color: #b52A2A;">
                <th style="font-size:30px;">Exam ID</th>
                <th style="font-size:30px;">Exam Name</th>
                <th style="font-size:30px;">Exam Duration</th>
                <th style="font-size:30px;">Action</th>

              </tr>
            </thead>

          </table>

        </div>
      </div>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function() {
        function create($id) {
          document.getElementById("examtable").style.opacity = 0.2;
          document.getElementById("examtable").style.zIndex = 0;
        }
        var information = JSON.parse('<?php echo json_encode($data); ?>');
        $('#examtable').DataTable({
          'processing': true,
          'serverSide': false,
          "datatype": "json",
          data: information,
          columns: [{
              data: 'id'
            },
            {
              data: 'subjectName'
            },
            {
              data: 'examDuration'
            },
            {
              "data": null,
              "render": function(data, type, row, meta) {
                return '<form action="http://127.0.0.1:81/php-mvc/exam_Mangment_center/deleteexam/' + row.id + '" method="post"><input class="btn btn-danger" type="submit"value="Delete"><form>'
              }
            }
          ],
        });
      });
    </script>
    </form>
  <?php } ?>