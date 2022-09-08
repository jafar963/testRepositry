<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
if (isset($_SESSION['user'])  && $_SESSION['user']->role_id == "1") {
?>
  <script>
    function openForm() {
      document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
      document.getElementById("myForm").style.display = "none";
    }

    function openFormEdit($id) {
      document.getElementById("row-id").value = $id;
      document.getElementById("myform-edit").style.display = "block";
    }

    function closeFormEdit() {
      document.getElementById("myform-edit").style.display = "none";
    }
  </script>
  <div class="main-body" style="min-height: calc(100vh - 300px);">
    <button class="open-button" onclick="openForm()">Add question</button>
    <div class="form-popup-question " id="myForm">
      <form id="addquestion" class="form-container" action="<?php echo URL; ?>question/addQuestion" method="POST">
        <br>
        <h3>Question Text &nbsp; <strong class="note">(Required)</strong></h3>
        <input type="text" id="questionText" name="questionText" />
        <br>
        <div class="word-display">
          <h3 id="option1"> option 1 &nbsp; <strong class="note">(Required)</strong></h3>
          <h3 id="option2"> option 2 &nbsp; <strong class="note">(Required)</strong></h3>
        </div>
        <div class="block-display">
          <input type="text" id="option1" name="option1" class="option1" />
          <input type="text" id="option2" name="option2" class="option2" />
        </div>
        <div class="word-display">
          <h3 id="option3"> option3 &nbsp; <strong class="note">(Required)</strong></h3>
          <h3 id="option4"> option4 &nbsp; <strong class="note">(Required)</strong></h3>
        </div>
        <div class="block-display">
          <input type="text" name="option3" id="option3" />
          <input type="text" id="option4" name="option4" />
        </div>
        <h3> choose topics</h3>
        <select name="topic_name">
          <?php
          foreach ($topics as $tmp) {
          ?>
            <option> <?php echo $tmp->topic_name; ?> </option>
          <?php  }
          ?>
        </select>
        <br>
        <h3> Answer &nbsp; <strong class="note">(Required)</strong></h3>
        <select name="answer">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
        <button type="submit" name="submit-addquestion" class="btn">Save</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
      </form>
    </div>
    <div class="form-popup" id="myform-edit">
      <form id="editquestion" class="form-container" action="<?php echo URL; ?>question/editQuestion" method="POST">
        <input id="row-id" name="id" type="hidden" />
        <br>
        <h3>Question Text &nbsp; <strong class="note">(Required)</strong></h3>
        <input type="text" id="questionText" name="questionText-edit" />
        <br>
        <div class="word-display">
          <h3 id="option1"> option 1 &nbsp; <strong class="note">(Required)</strong></h3>
          <h3 id="option2"> option 2 &nbsp; <strong class="note">(Required)</strong></h3>
        </div>
        <div class="block-display">
          <input type="text" id="option1" name="option1-edit" class="option1" />
          <input type="text" id="option2" name="option2-edit" class="option2" />
        </div>
        <div class="word-display">
          <h3 id="option3"> option3 &nbsp; <strong class="note">(Required)</strong></h3>
          <h3 id="option4"> option4 &nbsp; <strong class="note">(Required)</strong></h3>
        </div>
        <div class="block-display">
          <input type="text" name="option3-edit" id="option3" />
          <input type="text" id="option4" name="option4-edit" />
        </div>
        <h3> choose Topic</h3>
        <select name="topic_name-edit">
          <?php
          foreach ($topics as $tmp) {
          ?>
            <option> <?php echo $tmp->topic_name; ?> </option>
          <?php  }
          ?>
        </select>
        <br>
        <h3> Answer &nbsp; <strong class="note">(Required)</strong></h3>
        <select name="answer-edit">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
        <button type="submit" name="submit-editquestion" class="btn">Save</button>
        <button type="button" class="btn cancel" onclick="closeFormEdit()">Close</button>
      </form>
    </div>
    <?php
    $data = array();
    foreach ($questions as $row) {
      $data[] = array(
        "id" => $row->id,
        "Option1" => $row->Option1,
        "Option2" => $row->Option2,
        "Option3" => $row->Option3,
        "Option4" => $row->Option4,
        "answer" => $row->answer,
        "questionText" => $row->questionText,
        "subject_name" => $row->subject_name,
        "topics_name" => $row->topics_name
      );
    }
    ?>
    <from id="info" method="POST">
      <div class="main-body" style="min-height: calc(100vh - 300px);">
        <div class="real-body">
          <div class="questions-container">
            <table id="questiontable" class="display">
              <thead>
                <tr style="background-color: #b52A2A;">
                  <th style="font-size:30px;">Question Text</th>
                  <th style="font-size:30px;">Option1</th>
                  <th style="font-size:30px;">Option2</th>
                  <th style="font-size:30px;">Option3</th>
                  <th style="font-size:30px;">Option4</th>
                  <th style="font-size:30px;">Answer</th>
                  <th style="font-size:30px;">Subject_Name</th>
                  <th style="font-size:30px;">Topic_Name</th>
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
    $('#questiontable').DataTable({
      'processing': true,
      'serverSide': false,
      "datatype": "json",
      data: information,
      columns: [{
          data: 'questionText'
        },
        {
          data: 'Option1'
        },
        {
          data: 'Option2'
        },
        {
          data: 'Option3'
        },
        {
          data: 'Option4'
        },
        {
          data: 'answer'
        },
        {
          data: 'subject_name'
        },
        {
          data: 'topics_name'
        },
        {
          "data": null,
          "render": function(data, type, row, meta) {
            return '<button class="btn btn-warning" onclick="openFormEdit(' + row.id + ')">Edit</button><br> <form action="http://127.0.0.1:81/php-mvc/question/deleteQuestion/' + row.id + '" method="post"><input class="btn btn-danger" type="submit"value="Delete"></form>'
          }
        }
      ],
    });
  </script>
  </form>
<?php } ?>