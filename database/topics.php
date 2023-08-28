<?php
    include("dbconnection.php");

    $sql = "select * from topics";
    $topics = array();

    $result = mysqli_query($connection, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $topics[] = $row;
    }

?>