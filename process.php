<?php

    include("database/dbconnection.php");

    session_start();


    if (!isset($_SESSION['currentquestion'])) {
        $_SESSION['currentquestion'] = 1;
        $_SESSION['score'] = 0;
        header("location:quiz.php?currentquestion=".$_SESSION['currentquestion']);
    }
    else {
        if (isset($_POST['next'])) {

            if ($_SESSION['currentquestion'] <= $_SESSION['totalquestions']) {
                $_SESSION['currentquestion']++;
                $correctOption = sanitizeMySQL($connection, getCorrectOption($connection, $_SESSION['questionid'])) ;

                if (isset($_POST['option'])) {
                    $userOption = SanitizeMySQL($connection, $_POST['option']) ;


                    if ($userOption == $correctOption) {
                        echo "<script> alert('correct') </script>";
                        $_SESSION['score']++;
                    }    
                }

                if ($_SESSION['currentquestion'] > $_SESSION['totalquestions']) {
                    header("location:results.php");
                    return;
                }
                

                header("location:quiz.php?currentquestion=".$_SESSION['currentquestion']);

            }
            
        }  
        
        if(isset($_GET['timeout'])) {
            if ($_GET['timeout']==true) {

                echo "timeout";
                $_SESSION['currentquestion']++;

                if ($_SESSION['currentquestion'] > $_SESSION['totalquestions']) {
                    header("location:results.php");
                    return;
                }

                header("location:quiz.php?currentquestion=".$_SESSION['currentquestion']);
            }
            
        }
    }

    // session_destroy();

?>


<?php

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