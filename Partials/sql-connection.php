<?php
    // ako su mysql username/password i ime baze na vasim racunarima drugaciji
    // obavezno ih ovde zamenite
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

?>

<?php

// pripremamo upit
$sql = "SELECT Id, Title, Created_at, Author, Body FROM posts ORDER BY created_at DESC LIMIT 4";
$statement = $connection->prepare($sql);

// izvrsavamo upit
$statement->execute();

// zelimo da se rezultat vrati kao asocijativni niz.
// ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
$statement->setFetchMode(PDO::FETCH_ASSOC);

// punimo promenjivu sa rezultatom upita
$posts = $statement->fetchAll();

// koristite var_dump kada god treba da proverite sadrzaj neke promenjive
    // echo '<pre>';
    // var_dump($posts);
    // echo '</pre>';

?>




