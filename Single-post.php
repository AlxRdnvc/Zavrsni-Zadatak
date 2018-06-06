<?php include "Partials/Header.php" ?>

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

?>

<?php
 //uzimamo id iz url-a
 $id = $_GET['id'];

 // pripremamo upit
 $sql = "SELECT posts.Id, posts.Title, posts.Body, posts.Author as postAuthor, posts.Created_at, comments.Id, comments.Author as commentAuthor, comments.Text, comments.Post_id 
 FROM posts INNER JOIN comments ON posts.Id = comments.Post_id
 WHERE posts.Id=$id";
 $statement = $connection->prepare($sql);

 // izvrsavamo upit
 $statement->execute();

 // zelimo da se rezultat vrati kao asocijativni niz.
 // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
 $statement->setFetchMode(PDO::FETCH_ASSOC);

 // punimo promenjivu sa rezultatom upita
 $join = $statement->fetchAll();

 // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
      /*
     echo '<pre>';
     var_dump($posts);
     echo '</pre>';
     */


?>

<div class="col-sm-8 blog-main">
    <h2><?php echo $join[0]["Title"] ?></h2>
    <p><?php echo($join[0]["Created_at"]) . ' by ' . ($join[0]["postAuthor"]); ?></p></br>
    <p><?php echo($join[0]["Body"]) ?></p>

    <?php
        foreach ($join as $comment) {              
    ?>
        <ul>
            <li>
                <p><?php echo($comment["commentAuthor"]) ?></br>
                <p><?php echo($comment["Text"]) ?></p>
            </li>
        </ul>
    <?php 
    } 
    ?>

</div>
<?php include "Partials/Footer.php" ?>
