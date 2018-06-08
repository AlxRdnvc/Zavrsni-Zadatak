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

    $title = $_POST['title'];
    $author = $_POST['author'];
    $text = $_POST['body'];

    if (empty($title) || empty($author) || empty($text) ) {
        header('Location: ../create-post.php?error=1');
        die;
    }

    $sql = "INSERT INTO posts(Title, Author, Body) VALUES ('$title','$author','$text')";

    $statement = $connection->prepare($sql);
    $statement->execute();



?>