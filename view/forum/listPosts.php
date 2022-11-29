<?php

$messages = $result["data"]['posts'];
    
?>

<h1>liste messages</h1>

<?php
foreach($posts as $post){

    ?>
    <p><?=$post->getTopic()?></p>
    <p><?=$post->getUser()?></p>
    <p><?=$post->getMessage()?></p>
    <p><?=$post->getDatePost()?></p>
    <?php
}