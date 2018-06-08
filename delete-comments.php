<?php
    $servername = "Localhost";
    $username = "root";
    $password = "";
    $dbname = "blog";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }

    $commId = $_POST['commentId'];
    $postId = $_POST['postId'];

    $sql = "DELETE FROM comments WHERE comments.Id = '$commId'";

    $statement = $connection->prepare($sql);
    $statement->execute();

    header('Location:Single-post.php?id='.$postId.'&message');


    ?>