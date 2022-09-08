<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
if (isset($_SESSION['user'])  && $_SESSION['user']->role_id == "3") {
    $name = $_SESSION['name'];
    $examModel = $this->loadModel('examModel');
    $questions_id = $examModel->chooseExam($name);
    $questions = $examModel->getfiveQuestion($questions_id);
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
            "topics_id" => $row->topics_id
        );
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Quiz App</title>
        <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@600&family=Exo:ital,wght@1,600&display=swap" rel="stylesheet">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/startExam.css">
    </head>

    <body>
        <div id="container">
            <!--    Quiz Section    -->
            <div id="quiz">
                <div id="quiz_header">
                    <h5>Welcome to <span style=" font-weight: bold; color:#A52A2A">Quiz Maker</span></h5>
                    <div id="timer">
                        <h6>Time Left</h6>
                        <h6 id="time">20</h6>
                    </div>
                </div>
                <!--     Quiz Questions  -->
                <div id="question">
                    <h2 id="questionNo"></h2>
                    <h2 id="questionText"></h2>
                </div>
                <!--       Quiz Choices   -->
                <div id="optionList">
                    <h4 class="choice_que" id="option1"></h4>
                    <h4 class="choice_que" id="option2"></h4>
                    <h4 class="choice_que" id="option3"></h4>
                    <h4 class="choice_que" id="option4"></h4>
                </div>
                <!--  Answers Section-->
                <div id="answersSection">
                    <h3 id="total_correct">3 Of 10 Questions</h3>
                    <h3 id="next_question">Next</h3>
                </div>
            </div>
            <!--   Result Section  -->
            <div id="result">
                <i class="fas fa-trophy"></i>
                <h6>You Are Completed The Quiz</h6>
                <h6 id="points">You Got 4 Out Of 10</h6>
                <button  id="show" name="show-result" type="submit">Show Correct Answer</button>

                <form id="exams-result" method="post" action="<?php echo URL; ?> startExam/addMark/<?php echo $_SESSION['test_id'];  ?>">
                    <button id="quit" name="submit-mark" type="submit" style="margin-top:30px;">Quit Quiz</button>
            </div>
            <div id="correct"></div>
        </div>
        <script>
            var MCQS = JSON.parse('<?php echo json_encode($data); ?>');
            //Quiz Section
            let quiz = document.querySelector("#quiz");
            let time = document.querySelector("#time");
            //question Section
            let questionNo = document.querySelector("#questionNo");
            let questionText = document.querySelector("#questionText");
            //Multiple Choices Of Questions
            let option1 = document.querySelector("#option1");
            let option2 = document.querySelector("#option2");
            let option3 = document.querySelector("#option3");
            let option4 = document.querySelector("#option4");
            //correct and next Button
            let total_correct = document.querySelector("#total_correct");
            let next_question = document.querySelector("#next_question");
            //Result Section
            let result = document.querySelector("#result");
            let points = document.querySelector("#points");
            let quit = document.querySelector("#quit");
            let show = document.querySelector("#show");

            let startAgain = document.querySelector("#startAgain");
            //Get All 'H4' From Quiz Section (MCQS)
            let choice_que = document.querySelectorAll(".choice_que");
            let index = 0;
            let timer =20;
            let interval = 0;
            //total points
            let correct = 0;
            //store Answer Value
            let UserAns = undefined;
            //Creating Timer For Quiz Timer Section
            let countDown = () => {
                if (timer === 0) {
                    clearInterval(interval);
                    next_question.click();
                } else {
                    timer--;
                    time.innerText = timer;
                }
            }
            //setInterval(countDown,1000);
            let loadData = () => {
                questionNo.innerText = index + 1 + ". ";
                questionText.innerText = MCQS[index].questionText;
                option1.innerText = MCQS[index].Option1;
                option2.innerText = MCQS[index].Option2;
                option3.innerText = MCQS[index].Option3;
                option4.innerText = MCQS[index].Option4;
                //    timer start
                timer = 21;
            }
            loadData();
            //what happen when 'Continue' Button Will Click
            quiz.style.display = "block";
            interval = setInterval(countDown, 1000);
            loadData();
            //    remove All Active Classes When Continue Button Will Click
            choice_que.forEach(removeActive => {
                removeActive.classList.remove("active");
            })
            total_correct.innerHTML = `${correct = 0} Out Of ${MCQS.length} Questions`;
            choice_que.forEach((choices, choiceNo) => {
                choiceNo = choiceNo + 1;
                choices.addEventListener("click", () => {
                    choices.classList.add("active");
                    //check answer
                    if (choiceNo == MCQS[index].answer) {
                        correct++;
                    } else {
                        correct += 0;
                    }
                    //stop Counter
                    clearInterval(interval);
                    //disable All Options When User Select An Option
                    for (i = 0; i <= 3; i++) {
                        choice_que[i].classList.add("disabled");
                    }
                })
            });
            //what happen when 'Next' Button Will Click
            next_question.addEventListener("click", () => {
                //    if index is less then MCQS.length
                if (index !== MCQS.length - 1) {
                    index++;
                    choice_que.forEach(removeActive => {
                        removeActive.classList.remove("active");
                    })
                    //question
                    loadData();
                    //result
                    total_correct.style.display = "block";
                    total_correct.innerHTML = `${correct} Out Of ${MCQS.length} Questions`;
                    clearInterval(interval);
                    interval = setInterval(countDown, 1000);
                } else {
                    index = 0;
                    //when Quiz Question Complete Display Result Section
                    clearInterval(interval);
                    quiz.style.display = "none";
                    var perc = (correct * 100) / 5;
                    points.innerHTML = `You Got ${correct} Out Of ${MCQS.length}<br> ${perc}%`;
                    result.style.display = "block";
                    var element1 = document.createElement("input");
                    element1.type = "hidden";
                    element1.value = perc;
                    element1.name = "mark";
                    document.getElementById("exams-result").appendChild(element1);
                }
                for (i = 0; i <= 3; i++) {
                    choice_que[i].classList.remove("disabled");
                }
            })
            show.addEventListener("click", () => {
              for (var i=0 ; i<MCQS.length ; i++) {
        
                  document.getElementById('correct').innerHTML+=`<h1>Question ${[i+1]}</h1><h2 style="color:red;">${MCQS[i].questionText}</h2><br> `;
                  var x="";
                  x="Option"+MCQS[i].answer ;
                  if(x=="Option1"){
                    document.getElementById('correct').innerHTML+=`Correct Answer for this Question is :` ;
                    document.getElementById('correct').innerHTML+= `<h4 > <bold><mark style="color:green;">${MCQS[i].Option1}</mark></bold></h4><br> `;
                  }
                  else if (x== "Option2"){
                    document.getElementById('correct').innerHTML+=`Correct Answer for this Question is :`
                    document.getElementById('correct').innerHTML+= `<h4 > <bold><mark style="color:green;"> ${MCQS[i].Option2}</mark></bold></h4><br> `;
                } 
                else if (x== "Option3") {
                    document.getElementById('correct').innerHTML+=`Correct Answer for this Question is :`
                    document.getElementById('correct').innerHTML+= `<h4 > <bold><mark style="color:green;"> ${MCQS[i].Option3}</mark></bold></h4><br> `;
                }
                else {
                    document.getElementById('correct').innerHTML+=`Correct Answer for this Question is :`
                    document.getElementById('correct').innerHTML+=`<h4 > <bold><mark style="color:green;">${MCQS[i].Option4}</mark></bold></h4><br> `;
                }

              }
              document.getElementById('correct').style.display='block';
             const button= document.getElementById('show');

             button.disabled=true;
            })

      </script>
        <script type="text/javascript">
    window.onbeforeunload = function() {
        return "Dude, are you sure you want to leave? Think of the kittens!";
    }
 </script>
 <script type="text/javascript">
function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82 ||(e.data.url===window.location.href)) e.preventDefault(); };

$(document).ready(function(){
     $(document).on("keydown", disableF5);
});
var bc = new BroadcastChannel('test_channel');

bc.onmessage = function (ev) { 
    if(ev.data && ev.data.url===window.location.href){
       alert('You cannot open the same page in 2 tabs');
    }
}

bc.postMessage(window.location.href);
</script>
<script>
document.getElementById("myAnchor").addEventListener("click", function(event){
  event.preventDefault()
});
</script>

    </body>

    </html>
<?php } else {
    $error_msg = "You do not have sufficient permissions to login !!";
    require 'application/views/_templates/header.php';
    require 'application/views/login/index.php';
    require 'application/views/error/index.php';
    require 'application/views/_templates/footer.php';
} ?>