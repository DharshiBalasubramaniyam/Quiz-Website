<?php

    session_start();
    if (isset($_POST['start'])) {
        header('location:process.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <div class="content start-quiz">
            <p style="font-size:20px;">No of questions: <?php echo $_SESSION['totalquestions']; ?> <br><br>Best of luck for your quiz!</p>
            <form action="startquiz.php" method="post">
                <button style="margin-top: 25px;" class="start-btn" name="start">Start quiz Now</button>
            </form>           
        </div>
        
    </div>
</body>
</html>