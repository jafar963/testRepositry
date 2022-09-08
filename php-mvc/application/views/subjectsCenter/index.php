
<br><br><br><br><br><br>
<br><br><br><br><br><br>

<?php
if (session_status() != PHP_SESSION_ACTIVE)
  session_start();
if (isset($_SESSION['user'])  && $_SESSION['user']->role_id == "3") { ?>

  <form id="managment" method="POST" action="<?php echo URL; ?>startExam/chooseExam"style="position:absolute ; left:15%;top:20%; z-index: 1000;">
    <div class="block-of-topics profile-container"  >
      <h2 style="font-style:italic; color:red;">Dear student, </h2><h2 style="font-style:italic; color:red;">please choose the exam you want to pass</h2>
      <br><br>
      <h2 style="font-style:italic;">Select material : </h2>
      <select style=" width:200px; height:40px;font-size:25px;border-radius: 10px;" id="selected-material" name="selected-material" class="selected-material">
        <?php
        foreach ($subjectInCenter as $tmp) {
        ?>
          <option> <?php echo $tmp; ?> </option>
        <?php  }
        ?>
      </select>
      <button id="add-topic" name="choose-exam" class="choose-exam" type="submit" style="width:200px; 
     height:40px; font-size:30px; border-radius: 10px; " > Choose Exam</button>
    </div>
  </form>

<?php } ?>