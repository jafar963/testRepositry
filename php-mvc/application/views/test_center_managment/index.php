<?php
if (session_status()!=PHP_SESSION_ACTIVE)
session_start();
 if(isset($_SESSION['user'])){?>
<form id="managment"  method="POST" action="<?php echo URL; ?>topics_managment/addtopic">
<div class="block-of-topics"style="background: linear-gradient(to right, #f9cacb 20%, #faf8f8 80%, #faf9f9 9%);border-radius:20px;max-width:80% ;margin:auto;height:300px; ">
    <h1 style="margin:150px 250px 0px 200px; font-size:40px;" ><br>Topics managment </h1>
    <input type="text" id="name-of-topics" class="name-of-topics"  name="name-of-topics" placeholder="Enter the name of topic .."style="margin:20px 0px 0px 200px ;width:500px; 
     height:40px; font-size:25px; border-radius: 10px; text-indent:10px;">
     <br><br>
     <h3 style="margin-left:200px; margin-top:10px;" >Select material : </h3>
     <select style="margin-left:200px; margin-top:2px; width:200px; height:40px;font-size:25px;border-radius: 10px;" id ="selected-material" name="selected-material" class ="selected-material">
     <?php
            foreach ($subjects as $tmp) {
              ?>
            <option> <?php echo $tmp->name; ?> </option>
            <?php  }
          ?> 
    </select>
    <button id="add-topic" name="add-topic" class="add-topic" type="submit" style ="margin:5px 10px 0px 600px ;width:200px; 
     height:50px; font-size:30px; border-radius: 10px;" > Add Topic</button>
     </div>
</form >
<?php }?>












