<?php
    include("database/topics.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home - Coding Quiz</title>
</head>
<body>

    <?php include("header.php"); ?>
    <div class="container home">
        <h1>Coding Quizes</h1>
        <p>Test your skills with Coding's Quizzes.</p>
        <h2>The Quiz</h2>
        <p>The quizes consists of questions carefully designed to help you self-assess your comprehension of the information presented on the topics covered in the module.</p>
        <p>Each question in the quizes is in multiple choice format.</p>
        <p>To submit the answer simply click on the option, the answer will be submitted automatically and each correct and incorrect response will result in appropriate feedback immediately in the screen.</p>
        <p>You cannot skip any of the questions. After responding to a question, click on the <q>Next</q> button to go to next question.</p>
        <p>Each quiz contains 10-20 questions, you get 1 point for each correct answer, at the end of each quiz you get your total score and the percentage..</p>
        <p>You can retake a quiz as many times you want. But each time questions and answers will be randomized.</p>
        <p><a href="#">Sign in</a> with us to follow your progress and achievements. Otherwise no data will be collected on the website regarding your responses or how many times you take the quiz.</p>
        <button>Sign in</button>
        <h2>Quiz Topics</h2>
        <div class="cards">

            <?php 
                foreach ($topics as $topic) {
                    echo "<div class='card'>";
                    echo "<h1>{$topic['topic_name']}</h1>";
                    echo "<p>{$topic['topic_description']}</p>";
                    echo "<a href='database/questions.php?topicid={$topic['topic_id']}'><button>Start quiz</button></a>";
                    echo "</div>";
                } 
            ?>
        </div>
        <form class="news-letter">
            <h1>News Letter</h1>
            <h3>Stay tuned for new quizes and updates!</h3>
            <input type="email" name="email" id="email" placeholder="Email address">
            <button>Subscibe</button>
        </form>
        <footer>
            Copyright 2023 by Dharshib | All rights deserved
        </footer>
    </div>
    
</body>
</html>