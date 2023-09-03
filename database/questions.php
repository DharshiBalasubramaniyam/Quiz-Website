<?php

    session_start();
    include("dbconnection.php");

    

    if (isset($_GET['topicid'])) {
        $_SESSION['topic_id'] = $_GET['topicid'];

        $questions = getQuestions($connection, $_SESSION['topic_id']);
        
        $_SESSION['totalquestions'] = count($questions);
        $_SESSION['topicname'] = getTopicName($connection, $_SESSION['topic_id']);

        if ($_SESSION['totalquestions']>0) {
            header("location:../startquiz.php");
        }
        else {
            echo "<script> alert('Sorry for the inconvenience. No questions available for the requested topic.');
            window.location.href = '../index.php'; </script>";
            session_destroy();
        }
    }
    
?>


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
    function getTopicName($connection, $tid) {
        $sql = "select topic_name from topics where topic_id='$tid'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['topic_name'];
    }

    


?>