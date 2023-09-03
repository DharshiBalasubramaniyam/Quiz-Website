<?php
    session_start();
    include("database/dbconnection.php");


    if (isset($_GET['currentquestion'])) {
        $currentquestion = $_GET['currentquestion'];

        $topicid = $_SESSION['topic_id'];

        $questionArray = getQuestions($connection, $topicid);

        $totalquestions = count($questionArray);

        $_SESSION['questionid'] = $questionArray[$currentquestion-1]['question_id'];

        $question = sanitizeMySQL($connection, $questionArray[$currentquestion-1]['question_text']);

        $options = getOptions($connection, $_SESSION['questionid']);

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - Coding</title>
</head>
<body>

    <?php
        include("header.php");
    ?>
    <div class="container quiz">
        <?php
            echo "<h1>{$_SESSION['topicname']} Quiz</h1>";
            echo "<h2>Ready to challenge yourself with {$_SESSION['topicname']} quiz questions?</h2>"
        ?>
        <div class="content quiz-content">
            <div class="top">
                <span>Question <span class="current-question"><?php echo $currentquestion; ?></span> of <span class="all-questions"><?php echo $totalquestions; ?></span></span>
                <span class="time">Time Left: 00:<span class="seconds">15</span></span>
            </div>
            <form class="question-data" action="process.php" method="post">
                <div class="question"><?php echo $question; ?></div>

                <?php
                    for($i = 0; $i < count($options); $i++) {
                        echo "<div class='option'><input type='radio' name='option' id='{$i}' value = '{$options[$i]}'><label for='{$i}'>$options[$i]</label></div>";
                    }
                ?>
                
                <div class="btn"> <button type="submit" class="next" name="next" value="next">Next</button></div>
            </form>
            
        </div>
        
    </div>


    <script>
        const time = document.querySelector(".seconds");

        timeleft = 15;

        setInterval(() => {
            timeleft = --timeleft;
            time.textContent = timeleft<10 ? '0' + timeleft : timeleft;
            if (timeleft==0) {
                window.location.href = "process.php?timeout=true";
            }
        }, 1000);
    </script>
    
</body>
</html>


<?php

    function getQuestions($connection, $tid) {
        $sql = "select * from questions where topic_id='$tid'";
        $questions = array();

        $result = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $questions[] = $row;
        }
        return $questions;

    }

    function getOptions($connection , $qid) {
        $sql = "select * from answers where question_id='$qid'";
        $result = mysqli_query($connection, $sql);
        
        $options = array();

        while($row = mysqli_fetch_assoc($result)) {
            $options[] = sanitizeMySQL($connection, $row['answer_text']) ;
        }
        return $options;
    }

    function getCorrectOption($connection , $qid) {
        $sql = "select * from answers where question_id='$qid' and is_correct=1";
        $result = mysqli_query($connection, $sql);
        
        $row = mysqli_fetch_assoc($result);

        return $row['answer_text'];
    }

    function sanitizeString($var) {
        $var = stripslashes($var);
        $var = htmlentities($var);
        return $var;
    }
    function sanitizeMySQL($connection, $var){ 
        $var = mysqli_real_escape_string($connection, $var);
        $var = sanitizeString($var);
        return $var;
    }

?>