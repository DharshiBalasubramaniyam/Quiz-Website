<?php
    session_start();


    $percentage = $_SESSION['score'] / $_SESSION['totalquestions'] * 100;

    $message = getMessage($percentage);

    if (isset($_POST['try'])) {
        unset($_SESSION['score']);
        unset($_SESSION['currentquestion']);

        header("location:startquiz.php");
    }

    if (isset($_POST['home'])) {
        session_destroy();
        header("location:index.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Quiz Results - Coding</title>
</head>
<body>

    <?php include("header.php"); ?>

    <div class="container results">
        <h1>HTML Quiz</h1><br>
        <h2>Your Results</h2> <br>
        <p>Score: <span class="correct"><?php echo "{$_SESSION['score']}"  ?></span> out of <span class="total"><?php echo "{$_SESSION['totalquestions']}"; ?></span></p><br>
       <p>Percentage: <span class="percentage"><?php echo "$percentage%" ?></span></p> <br>
        <p><span class="message"><?php echo $message; ?></span></p><br>

        <form action="results.php" method="post">
            <button type="submit" name="try">Try Again</button>
            <button type="submit" name="home">Go to Home</button>
        </form>
    </div>
    
</body>
</html>


<?php

    function getMessage($value) {

        if($value == 100) return "Perfect!!!";
        else if($value > 90 ) return "Excellent!!!";
        else if($value > 80 ) return "Well Done!!!";
        else if($value > 70 ) return "Good Work!!!";
        else if($value > 60 ) return "Not bad at all!!!";
        else return "Keep trying!!!";
    }

?>