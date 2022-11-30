<?php

$posts = $result["data"]['posts'];
    
?>

<h1>Liste Des Messages Du Sujet</h1>

<?php
foreach($posts as $post){

    ?>
    <p><?=$post->getMessage()?></p>
    <p><?=$post->getDatePost()?></p>
    <?php
}