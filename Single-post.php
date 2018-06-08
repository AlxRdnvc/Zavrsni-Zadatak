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
 $sql = "SELECT posts.Id as postId, posts.Title, posts.Body, posts.Author as postAuthor, posts.Created_at, comments.Id as commentId, comments.Author as commentAuthor, comments.Text, comments.Post_id 
 FROM posts LEFT JOIN comments ON posts.Id = comments.Post_id
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


            <h5>Dodaj komentar:</h5>
                <form method="POST" action="create-comment.php">
                    <input type='hidden' name='Id' value='<?php echo $id;?>'>
                    <p>Name:</p><input type='text' name="name" value='<?php echo $name;?>'>
                    <span class="error"><?php echo $nameErr;?></span>
                    <p>Comment:</p><textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea></br>
                    <span class="error"><?php echo $commentErr;?></span>
                    <button type='submit' name='submit' class="btn btn-default"><p>Send comment!</p></button>
                </form>

                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert-danger">All fields are requried!</div> 
                <?php } ?>
            </div>

            <?php if (isset($_GET['message'])) { ?>
                 <div class="alert-danger">Comment has been successfully deleted</div></br>
            <?php } ?>

            <div>
                <button class="btn btn-default" id="button"><p>Hide comments!</p></button>
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
                            <p><b><?php echo($comment["commentAuthor"]) ?></b></p>
                            <p><?php echo($comment["Text"]) ?></p>
                            <form method="POST" action="delete-comments.php">
                                <input type='hidden' name="postId" value='<?php echo($comment["postId"]) ;?>'>
                                <input type='hidden' name="commentId" value='<?php echo($comment["commentId"]) ;?>'>
                                <button type="submit" name="delete" class="btn btn-default">Delete comment</button><hr>
                            </form>
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