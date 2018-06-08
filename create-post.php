<?php include "Partials/Header.php" ?>
<div class="row">
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
        <h5>Insert post:</h5>
                <form method="POST" action="Partials/create-post-connection.php">
                    <input type='hidden' name='Id' value=''>
                    <p>Title</p><input type='Text' name='title' value=''>
                    <input type='hidden' name='Date' value=''>
                    <p>Name</p><input type='Text' name='author' value=''>
                    <p>Insert text:</p><textarea name="body" rows="5" cols="40"></textarea></br>
                    <button type='submit' name='submit' class="btn btn-default"><p>Submit post</p></button>
                </form>

                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert-danger">All fields are requried!</div> 
                <?php } ?>
        </div><!-- /.blog-post -->
    </div><!-- /.blog-main -->
    <?php include "Partials/Sidebar.php" ?>
</div><!-- /.row -->
<?php include "Partials/Footer.php" ?>