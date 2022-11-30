<?php

$posts = $result["data"]['posts'];
    
?>

<h1>liste messages</h1>

<?php
foreach($posts as $post){

    ?>
    <p><?=$post->getMessage()?></p>
    <p><?=$post->getDatePost()?></p>
    <?php
}