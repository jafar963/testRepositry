<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
if (isset($_SESSION['user'])  && $_SESSION['user']->role_id == "1") { ?>
  <form id="managment" method="POST" action="<?php echo URL; ?>managment_materials/addSubject">
    <div class="block-of-materials" style="background: linear-gradient(to right, #f9cacb 20%, #faf8f8 80%, #faf9f9 9%);border-radius:20px;max-width:80% ;margin:auto;height:280px; ">
      <h1 style="margin:150px 250px 0px 200px; font-size:40px;"><br>Materials managment </h1>
      <input type="text" id="name-of-materials" class="name-of-materials" name="name-of-materials" placeholder="Enter the name of subject .." style="margin:20px 0px 0px 200px ;width:500px; 
     height:40px; font-size:25px; border-radius: 10px; text-indent:10px;">
      <br>
      <button id="add-material" name="add-material" class="add-material" type="submit" style="margin:30px 10px 0px 800px ;width:200px; 
     height:50px; font-size:30px; border-radius: 10px;"> Add material</button>
      <?php
      $data = array();
      foreach ($subjects as $row) {
        $data[] = array(
          "id" => $row->id,
          "name" => $row->name

        );
      }
      ?>
    </div>
  </form>
  <from id="info" method="POST">
    <div class="main-body" style="min-height: calc(100vh - 300px); max-width:80% ;margin:auto;">
      <div class="real-body">
        <div class="subject-container all-subject">
          <table id="subjecttable" class="display">
            <thead>
              <tr style="background-color: #b52A2A;">
                <th style="font-size:30px;">name</th>
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
          document.getElementById("subjecttable").style.opacity = 0.2;
          document.getElementById("managment").style.opacity = 0.2;
          document.getElementById("managment").style.zIndex = 0;
          document.getElementById("subjecttable").style.zIndex = 0;
          document.getElementById("edited-row-id").value = $id;
          bg = document.getElementById("managment").style.backgroundColor;
          document.getElementById("managment").style.backgroundColor = "ddd";
          document.getElementById("msg").style.display = "block";
          document.getElementById("msg").style.position = "absolute";
          document.getElementById("msg").style.top = "340px";
        }
        var information = JSON.parse('<?php echo json_encode($data); ?>');
        $('#subjecttable').DataTable({
          'processing': true,
          'serverSide': false,
          "datatype": "json",
          data: information,
          columns: [{
              data: 'name'
            },
            {
              "data": null,
              "render": function(data, type, row, meta) {
                return '<button class="btn btn-warning" onclick="create(' + row.id + ')">Edit</button><br> <form action="http://127.0.0.1:81/php-mvc/managment_materials/deleteSubject/' + row.id + '" method="post"><input class="btn btn-danger" type="submit"value="Delete"><form>'
              }
            }
          ],
        });
      });

      function hideMsg() {
        document.getElementById("msg").style.display = "none";
        document.getElementById("managment").style.opacity = 1;
        document.getElementById("subjecttable").style.opacity = 1;
        document.getElementById("managment").style.backgroundColor = bg;
      }

      function create($id) {
        document.getElementById("subjecttable").style.opacity = 0.2;
        document.getElementById("managment").style.opacity = 0.2;
        document.getElementById("managment").style.zIndex = 0;
        document.getElementById("subjecttable").style.zIndex = 0;
        document.getElementById("edited-row-id").value = $id;
        bg = document.getElementById("managment").style.backgroundColor;
        document.getElementById("managment").style.backgroundColor = "ddd";
        document.getElementById("msg").style.display = "block";
        document.getElementById("msg").style.position = "absolute";
        document.getElementById("msg").style.top = "420px";
      }
    </script>
    </form>
    <form method="POST" action="<?php echo URL; ?>managment_materials/editSubject">
      <div id="msg" style="background: linear-gradient(to right, #f9cacb 20%, #faf8f8 80%, #faf9f9 9%);border-radius:20px;width:80%;height:350px; display:none;">
        <h1 style='font-size:40px;margin-left:200px;'><br>Edit Materials </h1>
        <input type='text' id='editmaterial' class='editmaterial' name='editmaterial' placeholder='Edit the name of subject ..' style='margin:20px 0px 0px 200px ;width:500px; height:40px; font-size:25px; border-radius: 10px; text-indent:10px;' />
        <br>
        <input id="edited-row-id" name="id" type="hidden" />
        <button id='edit-material' name='edit-material' class='edit-material' type='submit' style='margin:20px 10px 0px 800px ;width:200px; height:50px; font-size:30px; border-radius: 10px;' onclick='hideMsg();'>
          Edit Now!
        </button>
      </div>
    </form>
  <?php } ?>