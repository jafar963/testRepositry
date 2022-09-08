<?php

if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
if (isset($_SESSION['user'])  && $_SESSION['user']->role_id == "2") {
  $data = array();
  foreach ($arr_student as $row) {
    $data[] = array(
      "id" => $row->id,
      "subjectName" => $row->subjectName,
      "mark" => $row->mark,
      "name" => $row->name,
      "date" => $row->date,
    );
  }
?>
  <from id="info" method="POST">
    <div class="main-body" style="min-height: calc(100vh - 300px); color:black; max-width:80%; margin:auto;">
      <div class="real-body">
        <div class="exam-container">
          <table id="examtable" class="display">
            <thead>
              <tr style="background-color: #b52A2A;">
                <th style="font-size:30px;">Exam ID</th>
                <th style="font-size:30px;">Exam Name</th>
                <th style="font-size:30px;">Mark</th>
                <th style="font-size:30px;"> Stusent Name</th>
                <th style="font-size:30px;"> Date</th>
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
              data: 'mark'
            },
            {
              data: 'name'
            },
            {
              data: 'date'
            }
          ],
        });
      });
    </script>
    </form>
  <?php } ?>