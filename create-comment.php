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

    


    $postId = intval($_POST['Id']);
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    
    if (empty($name) || empty($comment)) {
        header('Location:Single-post.php?id='.$postId.'&error=1');
    }

    $sql = "INSERT INTO comments(Post_id, Author, Text) VALUES ($postId, '$name', '$comment')";


    $statement = $connection->prepare($sql);
    $statement->execute();

    header('Location:Single-post.php?id='.$postId);


    ?>