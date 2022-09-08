<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
if (isset($_SESSION['user'])  && $_SESSION['user']->role_id == "1") { ?>
  <form id="managment" method="POST" action="<?php echo URL; ?>Test_center_admin_managment/addAdminCenter" onsubmit="return check();">
    <div class="block-of-centers" style="background: linear-gradient(to right, #f9cacb 20%, #faf8f8 80%, #faf9f9 9%);border-radius:20px;max-width:80% ;margin:auto;height:500px; ">
      <h1 style="margin:150px 250px 0px 200px; font-size:40px;"><br>Admin_center managment </h1>
      <h3 style="margin-left:200px; margin-top:10px;">Select Admin : </h3>
      <select style="margin-left:200px; margin-top:2px; width:200px; height:40px;font-size:25px;border-radius: 10px;" id="selected-admin" name="selected-admin" class="selected-admin">
        <?php
        foreach ($users_without_center as $tmp) {
          if ($tmp->role_id== "2") {
        ?>
            <option> <?php echo $tmp->firstName . " " .  $tmp->lastName; ?> </option>
        <?php  }
        }
        ?>
      </select>
      <br>
      <input type="text" id="name-of-center" class="name-of-center" name="name-of-center" placeholder="Enter the name of center.." style="margin:20px 0px 0px 200px ;width:400px; 
     height:40px; font-size:25px; border-radius: 10px; text-indent:10px;">
      <small class="err" style="color:red ; font-size:20px ;"></small>
      <br>
      <input type="text" id="address" class="address" name="address" placeholder="Enter address of center .." style="margin:20px 0px 0px 200px ;width:400px; 
     height:40px; font-size:25px; border-radius: 10px; text-indent:10px;">
      <small class="err" style="color:red ; font-size:20px ;"></small>
      <br>
      <input type="text" id="Moblie" class="Moblie" name="Moblie" placeholder="Enter Mobile of center .." style="margin:20px 0px 0px 200px ;width:400px; 
     height:40px; font-size:25px; border-radius: 10px; text-indent:10px;">
      <small class="err" style="color:red ; font-size:20px ;"></small>
      <br>
      <button id="add-Admin" name="add-Admin" class="add-Admin" type="submit" style="margin:5px 10px 0px 650px ;width:200px; 
     height:50px; font-size:30px; border-radius: 10px;"> Add Center</button>
    </div>
  </form>
  <?php
  $data = array();
  foreach ($centers as $row) {
    $data[] = array(
      "id" => $row->id,
      "name" => $row->name,
      "address" => $row->address,
      "mobile" => $row->mobile,
      "FullName" => $row->FullName,
    );
  }
  ?>
  </div>
  </form>
  <from id="info" method="POST">
    <div class="main-body" style="min-height: calc(100vh - 300px); max-width:80% ;margin:auto;">
      <div class="real-body">
        <div class="center-container">
          <table id="centertable" class="display">
            <thead>
              <tr style="background-color: #b52A2A;">
                <th style="font-size:30px;">Admin name</th>
                <th style="font-size:30px;">Center name</th>
                <th style="font-size:30px;">Adress</th>
                <th style="font-size:30px;">Moblie</th>
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
          document.getElementById("centertable").style.opacity = 0.2;
          document.getElementById("managment").style.opacity = 0.2;
          document.getElementById("managment").style.zIndex = 0;
          document.getElementById("centertable").style.zIndex = 0;
          document.getElementById("edited-row-id").value = $id;
          bg = document.getElementById("managment").style.backgroundColor;
          document.getElementById("managment").style.backgroundColor = "ddd";
          document.getElementById("msg").style.display = "block";
          document.getElementById("msg").style.position = "absolute";
          document.getElementById("msg").style.top = "340px";

        }
        var information = JSON.parse('<?php echo json_encode($data); ?>');
        $('#centertable').DataTable({
          'processing': true,
          'serverSide': false,
          "datatype": "json",
          data: information,
          columns: [{
              data: 'FullName'
            },
            {
              data: 'name'
            },
            {
              data: 'address'
            },
            {
              data: 'mobile'
            },
            {
              "data": null,
              "render": function(data, type, row, meta) {
                return '<button class="btn btn-warning" onclick="create(' + row.id + ')">Edit</button><br> <form action="http://127.0.0.1:81/php-mvc/Test_center_admin_managment/deleteAdminCenter/' + row.id + '" method="post"><input class="btn btn-danger" type="submit"value="Delete"><form>'
              }
            }
          ],
        });
      });

      function hideMsg() {
        document.getElementById("msg").style.display = "none";
        document.getElementById("managment").style.opacity = 1;
        document.getElementById("managment").style.backgroundColor = bg;
      }

      function create($id) {
        document.getElementById("centertable").style.opacity = 0.2;
        document.getElementById("managment").style.opacity = 0.2;
        document.getElementById("managment").style.zIndex = 0;
        document.getElementById("centertable").style.zIndex = 0;
        document.getElementById("edited-row-id").value = $id;
        bg = document.getElementById("managment").style.backgroundColor;
        document.getElementById("managment").style.backgroundColor = "ddd";
        document.getElementById("msg").style.display = "block";
        document.getElementById("msg").style.position = "absolute";
        document.getElementById("msg").style.top = "420px";
      }
      function isEmpty(smalls, center_name, address, mobile) {
        var flag = false;
        if (center_name == "") {
          smalls[0].innerHTML = "This field is required.";
          flag = true;
        } else {
          smalls[0].innerHTML = "";
        }
        if (address == "") {
          smalls[1].innerHTML = "This field is required.";
          flag = true;
        } else {
          smalls[1].innerHTML = "";
        }
        return flag;
      }

      function check() {
        var center_name = document.getElementById("name-of-center").value;
        var address = document.getElementById("address").value;
        var mobile = document.getElementById("Moblie").value;
        var flag = true;
        var smalls = document.getElementsByClassName("err"); // n = 3
        var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if (isEmpty(smalls, center_name, address, mobile)) {
          flag = false;
        }
        smalls[2].innerHTML = "";

        if (/[0-9]+/g.test(center_name)) {
          smalls[0].innerHTML = "Invalid center_name given.";
          flag = false;
        }
        if (/[0-9]+/g.test(address)) {
          smalls[1].innerHTML = "Invalid address given.";
          flag = false;
        }
        if (!(mobile.match(phoneno))) {
          smalls[2].innerHTML = "Not a valid Phone Number.";
          flag = false;

        }
        return flag;
      }
    </script>
    </form>
    <form method="POST" action="http://127.0.0.1:81/php-mvc/Test_center_admin_managment/editCenterInfo">
      <div id="msg" style="background: linear-gradient(to right, #f9cacb 20%, #faf8f8 80%, #faf9f9 9%);border-radius:20px;width:100%;height:450px; display:none;">
        <h1 style='font-size:40px;margin-left:200px;'><br>Center Edit </h1>
        <select style="margin-left:200px; margin-top:2px; width:200px; height:40px;font-size:25px;border-radius: 10px;" id="selected-admin-edit" name="selected-admin-edit" class="selected-admin-edit">
          <?php
          foreach ($users as $tmp) {
            if ($tmp->role_name == "admin test center") {
          ?>
              <option> <?php echo $tmp->firstName . " " .  $tmp->lastName; ?> </option>
          <?php  }
          }
          ?>
        </select>
        <br><br>
        <input type='text' id='editCenterInformation' class='editCenterInformation' name='editCenterInformation' placeholder='Edit the name of Center ..' style='margin:20px 0px 0px 200px ;width:500px; height:40px; font-size:25px; border-radius: 10px; text-indent:10px;' />
        <br>
        <input id="edited-row-id" name="id" type="hidden" />
        <br>
        <button id='edit-center' name='edit' class='edit-center' type='submit' style='margin:20px 10px 0px 800px ;width:200px; height:50px; font-size:30px; border-radius: 10px;' onclick='hideMsg();'>
          Edit Now!
        </button>
      </div>
    </form>
  <?php } ?>