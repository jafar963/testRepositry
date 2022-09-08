<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
if (isset($_SESSION['user'])  && $_SESSION['user']->role_id == "1") {
  $active = 1;
  $deactive = 0;
  $data = array();
  foreach ($users as $row) {
    $image = '';
    if ($row->isActive == 1) {
      $row->isActive = "Active_Status";
    } else if ($row->isActive == 0) {
      $row->isActive = "Deactive_Status";
    }
    if ($row->image != "") {
      $row->image = "http://127.0.0.1:81/php-mvc/public/images/profile/" . $row->image;
    } else {
      // $row->image = "http://127.0.0.1:81/php-mvc/public/images/profile/user.jpg" ;
      // calss="img-thumbnail" width="100px" height="100px"/>';
    }
    $data[] = array(
      "id" => $row->user_id,
      "firstName" => $row->firstName,
      "lastName" => $row->lastName,
      "email" => $row->email,
      "Mobile" => $row->Mobile,
      "image" => $row->image,
      "time_created" => $row->time_created,
      "isActive" => $row->isActive,
      "role_name" => $row->role_name,
    );
  }
?>
  <script>
    function openForm() {
      document.getElementById("myForm").style.display = "block";
    }

    function openFormEdit($id) {
      document.getElementById("row-id").value = $id;
      document.getElementById("myForm-edit").style.display = "block";
    }

    function closeFormEdit() {
      document.getElementById("myForm-edit").style.display = "none";
    }

    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }
  </script>
  <div class="main-body" style="min-height: calc(100vh - 300px);">
    <button class="open-button" onclick="openForm()">Add user</button>
    <div class="form-popup" id="myForm">
      <form id="signup" class="form-container" action="<?php echo URL; ?>all_users/addUser" method="POST" onsubmit="return validateSignUp();">
        <br>
        <h3>Work email&nbsp; <strong class="note">(Required)</strong></h3>
        <input type="email" id="email" name="email" placeholder=" E.g. David.Beckham@gmail.com " />
        <br>
        <small class="err" style="color:red; font-size:16px;"></small>
        <div class="word-display">
          <h3 id="first_name "> First name &nbsp; <strong class="note">(Required)</strong></h3>
          <h3 id="last_name "> Last name &nbsp; <strong class="note">(Required)</strong></h3>
        </div>
        <div class="block-display">
          <input type="text " id="firstName" name="firstName" class="firstName" placeholder="E.g David " />
          <input type="text " id="lastName" name="lastName" class="lastName" placeholder="E.g Beckham " />
        </div>
        <div class="word-display">
          <small class="err" style="color:red; font-size:16px;"></small>
          <small class="err" style="color:red; font-size:16px;"></small>
        </div>
        <div class="word-display">
          <h3 id="password "> Password &nbsp; <strong class="note">(Required)</strong></h3>
          <h3 id="confirm-password "> Confirm &nbsp; <strong class="note">(Required)</strong></h3>
        </div>
        <div class="block-display">
          <input type="password" name="password" id="password" placeholder="password " />
          <input type="password" id="confirm" name="confirm" placeholder="******** " />
        </div>
        <div class="word-display">
          <small class="err" style="color:red; font-size:16px;"></small>
          <small class="err" style="color:red; font-size:16px;"></small>
        </div>
        <br>
        <h3> Phone &nbsp; <strong class="note">(Required)</strong></h3>
        <input type="text" id="phone" name="phone" placeholder="0934 184 503" pattern="[0-9]{10}">
        <br>
        <small class="err" style="color:red; font-size:16px;"></small>
        <br>
        <br>
        <h3> choose your image</h3>
        <input type="file" name="image" id="image" accept="image/png, image/gif, image/jpeg " />
        <small class="err" style="color:red; font-size:16px;"></small>
        <h3>Account type </h3>
        <select name="role">
          <option value="admin">admin</option>
          <option value="admin test center">admin test center</option>
          <option value="student">student</option>
        </select>
        <button type="submit" name="submit-adduser" class="btn">Save</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
      </form>
    </div>
    <from id="info" method="POST">
      <div class="main-body" style="min-height: calc(100vh - 300px);">
        <div class="real-body">
          <div class="user-container">
            <table id="usertable" class="display">
              <thead>
                <tr style="background-color: #b52A2A;">
                  <th style="font-size:30px;">First Name</th>
                  <th style="font-size:30px;">Last Name</th>
                  <th style="font-size:30px;">Email</th>
                  <th style="font-size:30px;">Status</th>
                  <th style="font-size:30px;">Mobile</th>
                  <th style="font-size:30px;">Image</th>
                  <th style="font-size:30px;">Time Created</th>
                  <th style="font-size:30px;">Role_Name</th>
                  <th style="font-size:30px;">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
  </div>
  </section>
  </div>
  <script src="<?php echo URL ?>public/js/register.js"></script>
  <script src="<?php echo URL ?>public/js/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script>
    var information = JSON.parse('<?php echo json_encode($data); ?>');
    $('#usertable').DataTable({
      'processing': true,
      'serverSide': false,
      "datatype": "json",
      data: information,
      columns: [{
          data: 'firstName'
        },
        {
          data: 'lastName'
        },
        {
          data: 'email'
        },
        {
          data: 'isActive'
        },
        {
          data: 'Mobile'
        },
        {
          "data": 'image',
          "render": function getImg(data, type, row, meta) {
            return '<img src="' + data + '" border="0" widht="100" style ="border-radius:50%;"height="100" />';
          }
        },
        {
          data: 'time_created'
        },
        {
          data: 'role_name'
        },
        {
          "data": null,
          "render": function(data, type, row, meta) {
            if(row.role_name!="admin"){
           
              return '<form action="http://127.0.0.1:81/php-mvc/all_users/deleteUser/' + row.id + '" method="post"><input class="btn btn-danger" type="submit"value="Delete"></form><br><form action="http://127.0.0.1:81/php-mvc/all_users/Active/' + row.id + '/1" method="post"><input class="btn btn-success" type="submit"value="Activate"></form><br><form action="http://127.0.0.1:81/php-mvc/all_users/Active/' + row.id + '/0" method="post"><input class="btn btn-primary" type="submit"value="deactivate"></form>'
              }
              else{
                return '<h2 style="color:red; font-style:italic;" >'+"can't be edited"+"</h2>";
              }
              }
        }
      ],
    });
  </script>
  </form>
  </body>

  </html>
<?php } ?>