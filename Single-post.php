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
<div class="row">
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div>
                <h2><?php echo $join[0]["Title"] ?></h2>
                <p  class="blog-post-meta"><?php echo($join[0]["Created_at"]) . ' by ' . ($join[0]["postAuthor"]); ?></p>
                <p  class="blog-post-meta"><?php echo($join[0]["Body"]) ?></p></br>
            </div> 
            <div>
            <h2>PHP Form Validation Example</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <p  class="blog-post-meta">Name:</p></br><input type="text" name="name" value="<?php echo $name;?>"></br></br>
                    <span class="error"><?php echo $nameErr;?></span>
                    <p  class="blog-post-meta">Comment:</p></br><textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
                    <br><br>
                </form>
            </div>
            <div>
                <button class="btn btn-default" id="button">Hide comments!</button>
            </div> 
            <div id="commentsDiv">
                <script>
                    var btn = document.getElementById('button');

                    btn.addEventListener('click',function(){
                        var x = document.getElementById("commentsDiv");
                        var y = document.getElementById("button");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                            } 
                        if (y.innerHTML === "Hide comments!") {
                            y.innerHTML = "Show comments!";
                        } 
                    })
                </script>
                <?php
                    foreach ($join as $comment) {              
                ?>
                    <ul>
                        <li>
                            <p><?php echo($comment["commentAuthor"]) ?></br>
                            <p><?php echo($comment["Text"]) ?></p><hr>
                        </li>
                    </ul>
                <?php 
                } 
                ?>
            </div> <!-- comentsDiv -->
        </div> <!-- blog-post -->
    </div>  <!-- blog-main -->
<?php include "Partials/Sidebar.php" ?>
</div><!-- /.row -->
<?php include "Partials/Footer.php" ?>
