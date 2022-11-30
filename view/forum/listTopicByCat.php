<?php

$topics = $result["data"]['topics'];
    
?>

<h1>Liste Des Sujets De La Categorie</h1>

<?php
foreach($topics as $topic){

    ?>
    <p><a href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>"><?=$topic->getTitle()?></a></p>
    <?php
}
