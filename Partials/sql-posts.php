<?php
    foreach ($posts as $post) {              
?>
    <h2 class="blog-post-title"><?php echo($post["Title"]); ?></h2></br>
    <p><?php echo($post["Created_at"]) . ' by ' . ($post["Author"]); ?></p></br>
    <p><?php echo($post["Body"]) ?></p></br>
<?php 
} 
?>