<?php

$topics = (!$result["data"]['topics']) ? [] : $result["data"]['topics'];

    
?>

<h1>Liste Des Sujets</h1>

<?php

foreach($topics as $topic){

?>

    <p><a href="index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>"><?=$topic->getTitle()?></a></p>

    <p><?=$topic->getcreationDate()?></p>
    
<?php

}

?>




  
