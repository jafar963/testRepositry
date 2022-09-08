<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
?>
<?php if (isset($_SESSION['user'])  && $_SESSION['user']->role_id == "2") {
    
    
    ?>
 
    <?php
    $testcentermodel = $this->loadModel('testCenterModel');
    $centers = $testcentermodel->getAllTestCenter();
    foreach ($centers as $tmp) {
        if ($tmp->user_id == $_SESSION['user']->id) {
            $testcenter_id = $tmp->id;
        }
    }
    ?>
    <form id="managment" method="POST" action="<?php echo URL . 'admin_test_center/requireTest/' . $testcenter_id ?>">
        <div class="block-of-exams" style="background: linear-gradient(to right, #f9cacb 20%, #faf8f8 80%, #faf9f9 9%);border-radius:20px;max-width:80% ;margin:auto;height:500px; ">
            <h3 style="margin-left:200px;margin-top:10px; color:black;">Select material : </h3>
            <select style="margin-left:200px; margin-top:2px; width:200px; height:40px;font-size:25px;border-radius: 10px;" id="selected-material" name="selected-material" class="selected-material">
                <?php
                foreach ($subjects as $tmp) {
                ?>
                    <option> <?php echo $tmp->name; ?> </option>
                <?php  }
                ?>
            </select>
            <button id="add-exam" name="request-exam" class="request-exam" type="submit" style="margin:50px 10px 0px 1000px ;width:200px; 
     height:50px; font-size:30px; border-radius: 10px;"> Request Exam</button>
        </div>
        </div>
        <script src="./js/testcenter.js"></script>
        </body>

        </html>
    <?php } ?>