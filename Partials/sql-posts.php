<div class="row">

    <div class="col-sm-8 blog-main">

        <div class="blog-post">

            <?php
                foreach ($posts as $post) {              
            ?>
                <h2 class="simpleBlogTitle" ><a href="single-post.php?id=<?php echo($post['Id']) ?>"><?php echo($post['Title']) ?></a></h2></br>
                <p class="blog-post-meta"><?php echo($post["Created_at"]) . ' by ' . ($post["Author"]); ?></p></br>
                <p class="blog-post-meta"><?php echo($post["Body"]) ?></p></br>
            <?php 
            } 
            ?>
        </div><!-- /.blog-post -->
    </div><!-- /.blog-main -->
    <?php include "Partials/Sidebar.php" ?>
</div><!-- /.row -->

