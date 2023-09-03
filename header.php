<?php
    include("database/topics.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/c732ec9339.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Header</title>
</head>
<body>
    <header>
        <div class="nav-bar">
            <div class="navlinks">
                <i class="fa fa-bars menu" aria-hidden="true"></i>
                <a href="#" class="logo">#Coding.</a>
                <a href="#">Home</a>
                <a href="#">Topics</a>
                <a href="#">About</a>
                <a href="#">Contact</a>
            </div>
            <div class="btns"><button class="active">Log in</button><button>Sign up</button></div>
        </div>
        <div class="quiz-links">
            <?php 
                for ($i = 0; $i < 7; $i++) {
                    echo "<a href='database/questions.php?topicid={$topics[$i]['topic_id']}'>{$topics[$i]['topic_name']}</a>";
                } 
            ?>
        </div>
    </header>

    <div class="sidebar">
        <h1>Online quizes</h1>
        <?php 
            foreach ($topics as $topic) {
                echo "<a href='database/questions.php?topicid={$topic['topic_id']}'>Quiz&nbsp&nbsp{$topic['topic_name']}</a>";
            } 
        ?>
    </div>

    <script>
        const sidebar = document.querySelector(".sidebar");
        const menu = document.querySelector(".menu");

        menu.addEventListener('click', ()=> {
            if (sidebar.classList.contains('active')) {
                sidebar.classList.remove('active')
            }
            else {
                sidebar.classList.add('active')
            }
        })
        

    </script>
    
</body>
</html>